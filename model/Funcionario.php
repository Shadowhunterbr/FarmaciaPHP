<?php

class Funcionario{
    private $codigoFuncionario;
    private $nomeFuncionario;
    private $emailFuncionario;
    private $loginFuncionario;
    private $senhaFuncionario;
    private $telefoneFunc;
    private $cpfFuncionario;
    private $cargoFuncionario;
    private $codGenero;

    public function __construct($codigoFuncionario,$nomeFuncionario,$emailFuncionario,$loginFuncionario,$senhaFuncionario,$telefoneFunc,$cpfFuncionario,$cargoFuncionario,$codGenero)
    {
        $this->codigoFuncionario = $codigoFuncionario;
        $this->nomeFuncionario = $nomeFuncionario;
        $this->emailFuncionario = $emailFuncionario;
        $this->loginFuncionario = $loginFuncionario;
        $this->senhaFuncionario = $senhaFuncionario;
        $this->telefoneFunc = $telefoneFunc;
        $this->cpfFuncionario = $cpfFuncionario;
        $this->cargoFuncionario = $cargoFuncionario;
        $this->codGenero = $codGenero;
    }
    // Getters
    public function getCodigoFuncionario() {
        return $this->codigoFuncionario;
    }

    public function getNomeFuncionario() {
        return $this->nomeFuncionario;
    }

    public function getEmailFuncionario() {
        return $this->emailFuncionario;
    }

    public function getLoginFuncionario() {
        return $this->loginFuncionario;
    }

    public function getSenhaFuncionario() {
        return $this->senhaFuncionario;
    }

    public function getTelefoneFunc() {
        return $this->telefoneFunc;
    }

    public function getCpfFuncionario() {
        return $this->cpfFuncionario;
    }

    public function getCargoFuncionario() {
        return $this->cargoFuncionario;
    }

    public function getCodGenero() {
        return $this->codGenero;
    }

}


