<?php

class Cliente{
    private $codigoCliente;
    private $nomeCliente;
    private $codEndereco;
    private $emailCliente;
    private $senhaCliente;
    private $telefoneCliente;
    private $cpfCliente;
    private $codGenero;
    private $dataNascimento;

    public function __construct($codigoCliente,$nomeCliente,$codEndereco,$emailCliente,$senhaCliente,$telefoneCliente,$cpfCliente,$codGenero,$dataNascimento)
    {
        $this->codigoCliente = $codigoCliente;
        $this->nomeCliente = $nomeCliente;
        $this->codEndereco = $codEndereco;
        $this->emailCliente = $emailCliente;
        $this->senhaCliente = $senhaCliente;
        $this->telefoneCliente = $telefoneCliente;
        $this->cpfCliente = $cpfCliente;
        $this->codGenero = $codGenero;
        $this->dataNascimento = $dataNascimento;
        
    }

    public function getCodigoCliente() {
        return $this->codigoCliente;
    }

    public function getNomeCliente() {
        return $this->nomeCliente;
    }

    public function getCodEndereco() {
        return $this->codEndereco;
    }

    public function getEmailCliente() {
        return $this->emailCliente;
    }

    public function getSenhaCliente() {
        return $this->senhaCliente;
    }

    public function getTelefoneCliente() {
        return $this->telefoneCliente;
    }

    public function getCpfCliente() {
        return $this->cpfCliente;
    }

    public function getCodGenero() {
        return $this->codGenero;
    }

    public function getDataNascimento() {
        return $this->dataNascimento;
    }

}