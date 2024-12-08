<?php

class Cliente{
    private $codigoCliente;
    private $nomeCliente;
  
    private $emailCliente;
    private $senhaCliente;
    private $telefoneCliente;
    private $cpfCliente;
    private $codGenero;
    private $dataNascimento;

    public function __construct($codigoCliente,$nomeCliente,$emailCliente,$senhaCliente,$telefoneCliente,$cpfCliente,$codGenero,$dataNascimento)
    {
        $this->codigoCliente = $codigoCliente;
        $this->nomeCliente = $nomeCliente;
       
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

    public function setCodigoCliente($codigoCliente)  {
        $this->codigoCliente = $codigoCliente;
    }

    public function getNomeCliente() {
        return $this->nomeCliente;
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

    public function setNomeCliente($nomeCliente) {
        $this->nomeCliente = $nomeCliente;
    }
    
    public function setEmailCliente($emailCliente) {
        $this->emailCliente = $emailCliente;
    }
    
    public function setSenhaCliente($senhaCliente) {
        $this->senhaCliente = $senhaCliente;
    }
    
    public function setTelefoneCliente($telefoneCliente) {
        $this->telefoneCliente = $telefoneCliente;
    }
    
    public function setCpfCliente($cpfCliente) {
        $this->cpfCliente = $cpfCliente;
    }
    
    public function setCodGenero($codGenero) {
        $this->codGenero = $codGenero;
    }
    
    public function setDataNascimento($dataNascimento) {
        $this->dataNascimento = $dataNascimento;
    }

}
class EnderecoCliente {
    private $codigo;
    private $codCliente;
    private $rua;
    private $numero;
    private $bairro;
    private $cidade;
    private $cep;
    private $uf;

    public function __construct($codigo, $codCliente ,$rua, $numero, $bairro, $cidade, $cep, $uf) {
        $this->codigo = $codigo;
        $this->codCliente = $codCliente;
        $this->rua = $rua;
        $this->numero = $numero;
        $this->bairro = $bairro;
        $this->cidade = $cidade;
        $this->cep = $cep;
        $this->uf = $uf;
    }

    public function getCodigo() {
        return $this->codigo;
    }

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function getCodCliente(){
        return $this->codCliente;
    }

    public function setCodCliente($codCliente){
        $this->codCliente = $codCliente;
    }

    public function getRua() {
        return $this->rua;
    }

    public function setRua($rua) {
        $this->rua = $rua;
    }

    public function getNumero() {
        return $this->numero;
    }

    public function setNumero($numero) {
        $this->numero = $numero;
    }

    public function getBairro() {
        return $this->bairro;
    }

    public function setBairro($bairro) {
        $this->bairro = $bairro;
    }

    public function getCidade() {
        return $this->cidade;
    }

    public function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    public function getCep() {
        return $this->cep;
    }

    public function setCep($cep) {
        $this->cep = $cep;
    }

    public function getUf() {
        return $this->uf;
    }

    public function setUf($uf) {
        $this->uf = $uf;
    }
}