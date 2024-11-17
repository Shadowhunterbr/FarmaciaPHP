<?php 

class Fornecedor {
    
    private $codigoFornecedor;
    private $razaoSocial;
    private $nomeFantasia;
    private $cnpj;                         
    private $endereco;
    private $cidade;
    private $cep;
    private $pessoaContato;
    private $telefone;

    // Construtor
    public function __construct(
        $codigoFornecedor,
        $razaoSocial,
        $nomeFantasia,
        $cnpj,
        $endereco,
        $cidade,
        $cep,
        $pessoaContato,
        $telefone
    ) {
        $this->codigoFornecedor = $codigoFornecedor;
        $this->razaoSocial = $razaoSocial;
        $this->nomeFantasia = $nomeFantasia;
        $this->cnpj = $cnpj;
        $this->endereco = $endereco;
        $this->cidade = $cidade;
        $this->cep = $cep;
        $this->pessoaContato = $pessoaContato;
        $this->telefone = $telefone;
    }

    // Getters
    public function getCodigoFornecedor() {
        return $this->codigoFornecedor;
    }

    public function getRazaoSocial() {
        return $this->razaoSocial;
    }

    public function getNomeFantasia() {
        return $this->nomeFantasia;
    }

    public function getCnpj() {
        return $this->cnpj;
    }

    public function getEndereco() {
        return $this->endereco;
    }

    public function getCidade() {
        return $this->cidade;
    }

    public function getCep() {
        return $this->cep;
    }

    public function getPessoaContato() {
        return $this->pessoaContato;
    }

    public function getTelefone() {
        return $this->telefone;
    }
}

?>