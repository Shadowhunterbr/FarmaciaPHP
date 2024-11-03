<?php

require_once __DIR__ . "/Conexao.php";

class ProdutoDao{

    public function buscarTodosProdutos(){
        //Conexão com o Banco de Dados
        $pdo = Conexao::obterConexao();
        //echo "Banco de Dados Conectado com Sucesso!!!" .PHP_EOL;

        $statement = $pdo->query("SELECT * FROM Produtos");

        return $statement->fetchAll(\PDO::FETCH_ASSOC);

    }

    public function buscarTodasCategorias(){
         
        $pdo = Conexao::obterConexao();

        $statement = $pdo->query("SELECT * FROM categoria");
        return $statement->fetchAll(\PDO::FETCH_ASSOC);

    }

    public function arrayPrescricao(){

        $pdo = Conexao::obterConexao();

        $statement = $pdo->query("SELECT * FROM prescricao_medica");
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function cadastrar($objProduto){
        //Conexão com o Banco de Dados
        $pdo = Conexao::obterConexao();

        $stmt = $pdo->prepare("INSERT INTO Produtos(nome, preco, cod_fornecedor, cod_prescricao, cod_categoria,quantidade_estoque, data_F, data_V) VALUES(:nome, :preco, :cod_fornecedor, :cod_prescricao, :cod_categoria, :quantidade_estoque, :data_F, :data_V)");
        $stmt->bindParam(':nome',$objProduto->getNomeProduto());
        $stmt->bindParam(':preco',$objProduto->getPreco());
        $stmt->bindParam(':cod_fornecedor',$objProduto->getCodFornecedor());
        $stmt->bindParam(':cod_prescricao',$objProduto->getCodPrescricao());
        $stmt->bindParam(':cod_categoria',$objProduto->getCodCategoria());
        $stmt->bindParam(':quantidade_estoque',$objProduto->getQuantidadeEstoque());
        $stmt->bindParam(':data_F',$objProduto->getDataF());
        $stmt->bindparam(':data_V',$objProduto->getDataV());

        $stmt->execute();
    }

    public function excluir($objProduto){
        //Conexão com o Banco de Dados
        $pdo = Conexao::obterConexao();
        
        $stmt = $pdo->prepare("DELETE FROM Produto WHERE codigo = :codigo");
        $stmt->bindParam(':codigo',$objProduto->getCodigo());

        $stmt->execute();
    }
/*
    public function buscarProdutoPorCodigo($codigo){
        //Conexão com o Banco de Dados
        $pdo = Conexao::obterConexao();
 
        $stmt = $pdo->prepare("SELECT * FROM Produto WHERE codigo = :codigo");
        $stmt->bindParam(':codigo',$codigo);
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
        
    }

    public function alterar(){
        //Conexão com o Banco de Dados
        $pdo = Conexao::obterConexao();
        
        $stmt = $pdo->prepare("UPDATE Produto SET produto=:produto, preco_unitario=:preco_unitario WHERE codigo=:codigo");
        $stmt->bindParam(':produto',$this->produto);
        $stmt->bindParam(':preco_unitario',$this->precoUnitario);
        $stmt->bindParam(':codigo',$this->codigo);
        
        $stmt->execute();

    }
*/
}