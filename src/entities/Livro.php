<?php
namespace Entities;
use Doctrine\ORM\Mapping\Column; //... Demais imports

#[Entity]
#[Table(name: 'livro')]
class Livro
{
    #[Id]
    #[Column(type: "integer"), GeneratedValue]
    private $id;

    #[Column(type: "string")]
    private $titulo;
    
    #[Column(type: "string")]
    private $autor;

    #[Column(type: "float")]
    private $preco;

    public function __set($atributo, $valor) {
        $this->$atributo = $valor;
    }

    public function __get($atributo) {
        return $this->$atributo;
    }
}
?>