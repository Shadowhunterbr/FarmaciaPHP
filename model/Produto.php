<?php
namespace model;


class Produto {
    private $codigo;
    private $nomeProduto;
    private $cod_categoria;
    private $cod_fornecedor;
    private $cod_prescricao;
    private $data_F;
    private $data_V;
    private $preco;
    private $quantidade_estoque;
    private $descricaoProduto;
    private $precoCusto;
    private $imagem;
    private $status; // Adicionando status como uma variável privada
// 9 variaveis

//melancia

    // Construtor da classe Produto
    public function __construct( $codigo,$nomeProduto, $precoCusto, $preco, $quantidade_estoque, $cod_categoria, $cod_fornecedor, $cod_prescricao,$data_F,$data_V,$descricaoProduto,$imagem,$status) {
        $this->codigo = $codigo;
        $this->nomeProduto = $nomeProduto;
        $this->precoCusto = $precoCusto;
        $this->preco = $preco;
        $this->quantidade_estoque = $quantidade_estoque;
        $this->cod_categoria = $cod_categoria;
        $this->cod_fornecedor = $cod_fornecedor;
        $this->cod_prescricao = $cod_prescricao;
        $this->data_F = $data_F;
        $this->data_V = $data_V;
        $this->descricaoProduto = $descricaoProduto;
        $this->imagem = $imagem;
        $this->status = $status; // Inicializando o status como 'ativo'

   
    }

    // Getters e Setters
    public function getCodigo() {
        return $this->codigo;
    }

    public function getDescricaoProduto() {
        return $this->descricaoProduto;
    }

    public function getPrecoCusto() {
        return $this->precoCusto;
    }


    public function getNomeProduto() {
        return $this->nomeProduto;
    }

    public function setNome($nomeProduto) {
        $this->nomeProduto = $nomeProduto;
    }

    public function getCodCategoria() {
        return $this->cod_categoria;
    }

    public function setCodCategoria($cod_categoria) {
        $this->cod_categoria = $cod_categoria;
    }

    public function getCodFornecedor() {
        return $this->cod_fornecedor;
    }

    public function setCodFornecedor($cod_fornecedor) {
        $this->cod_fornecedor = $cod_fornecedor;
    }

    public function getCodPrescricao() {
        return $this->cod_prescricao;
    }

    public function setCodPrescricao($cod_prescricao) {
        $this->cod_prescricao = $cod_prescricao;
    }

    public function getDataF() {
        return $this->data_F;
    }

    public function setDataF($data_F) {
        $this->data_F = $data_F;
    }

    public function getDataV() {
        return $this->data_V;
    }

    public function setDataV($data_V) {
        $this->data_V = $data_V;
    }

    public function getPreco() {
        return $this->preco;
    }

    public function setPreco($preco) {
        $this->preco = $preco;
    }

    public function getQuantidadeEstoque() {
        return $this->quantidade_estoque;
    }

    public function setQuantidadeEstoque($quantidade_estoque) {
        $this->quantidade_estoque = $quantidade_estoque;
    }
    public function getImagem(){
        return $this->imagem;
    }
    public function setImagem($imagem) {
        $this->imagem = $imagem;
        
    }

    public function getStatus() {
        return $this->status;
    }
    public function setStatus($status) {
        $this->status = $status;
    }
}