<?php

session_start();

require_once __DIR__ . '/cli-config.php';
use Entities\Livro;

if(isset($_POST['cadastrar'])) {
    $livro = new Livro();
    $livro->titulo = $_POST['titulo'];
    $livro->autor = $_POST['autor'];
    $livro->preco = $_POST['preco'];

    $entityManager->persist($livro);
    $entityManager->flush();

    $_SESSION["mensagem"] = "<div class='alert alert-success' role='alert'> Registro inserido com sucesso! </div>";
}

if(isset($_GET["editar"])) {
    $livro = $entityManager->find("Entities\Livro", $_GET["id"]);
}
$livroRepository = $entityManager->getRepository("Entities\Livro");
$livros = $livroRepository->findAll();

if(isset($_GET["deletar"])) {
    $id = $_GET["id"] ;
    $livro = $entityManager->find("Entities\Livro", $id);
    $entityManager->remove($livro);
    $entityManager->flush();
    $_SESSION["mensagem"] = "<div class='alert alert-danger' role='alert'> Registro deletado com sucesso! </div>";
    header("location:index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Atividade Tecweb 3</title>
</head>

<body><?php if(isset($_SESSION["mensagem"])){
        echo $_SESSION["mensagem"];
    
    }?>
    <div class="container my-5">
        <p class="fs-1">Formulário de Livro:</p>
        <form method="POST">
            <div class="mb-3">
                <label for="tituto" class="form-label">Título</label>
                <input type="text" name="titulo" class="form-control" id="titulo" aria-describedby="Título do filme">
            </div>
            <div class="mb-3">
                <label for="autor" class="form-label">Autor</label>
                <input type="text" name="autor" class="form-control" id="autor" aria-describedby="Autor do filme">
            </div>
            <div class="mb-3">
                <label for="preco" class="form-label">Preço (R$)</label>
                <input type="number" name="preco" step="0.01" class="form-control" id="preco" aria-describedby="Preço do filme">
            </div>
            <button type="submit" name="cadastrar" class="btn btn-primary">Cadastrar</button>
        </form>
    </div>
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Título</th>
                    <th scope="col">Autor</th>
                    <th scope="col">Preço</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($livros as $livro): ?>
            <tr>
                <td><?=$livro->id ?></td>
                <td><?=$livro->titulo ?></td>
                <td><?=$livro->autor ?></td>
                <td><?=$livro->preco ?></td>
                <td>
                    <a href="index.php?editar=true&id=<?= $livro->id ?>">
                        <button name="editar" class="btn btn-primary">Editar</button>
                    </a>
                    <a href="index.php?deletar=true&id=<?= $livro->id ?>">
                        <button name="deletar" class="btn btn-primary">Excluir</button>
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>