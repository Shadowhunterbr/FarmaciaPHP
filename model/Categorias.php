<?php

class Categorias{
    private $criaCategoria; //è o codigo com outro nome
    private $nomeCategoria;

    public function __construct($criaCategoria,$nomeCategoria){
        $this->criaCategoria = $criaCategoria;
        $this->nomeCategoria = $nomeCategoria;   
    }

    public function getCriarCategoria() {
        return $this->criaCategoria;
    }

    public function getNomeCategoria() {
        return $this->nomeCategoria;
    }
}
    