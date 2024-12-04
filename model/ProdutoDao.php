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

    public function buscarPorCategoria($codCategoria) {

        $pdo = Conexao::obterConexao();
        
        $stmt = $pdo->prepare("SELECT * FROM produtos WHERE cod_categoria = :cod_categoria");
        $stmt->bindParam(':cod_categoria', $codCategoria, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorNome($search) {
        $pdo = Conexao::obterConexao();

        $stmt = $pdo->prepare("SELECT * FROM produtos WHERE nome LIKE :search");
        $stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function arrayPrescricao(){

        $pdo = Conexao::obterConexao();

        $statement = $pdo->query("SELECT * FROM prescricao_medica");
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function cadastrar($objProduto){
        //Conexão com o Banco de Dados
        $pdo = Conexao::obterConexao();

        $stmt = $pdo->prepare("INSERT INTO Produtos(nome, preco_custo ,preco, cod_fornecedor, cod_prescricao, cod_categoria,quantidade_estoque, data_F, data_V, descricao_produto, imagem) VALUES(:nome, :preco_custo, :preco, :cod_fornecedor, :cod_prescricao, :cod_categoria, :quantidade_estoque, :data_F, :data_V, :descricao_produto , :imagem)");
        $stmt->bindParam(':nome',$objProduto->getNomeProduto());
        $stmt->bindParam(':preco_custo', $objProduto->getPrecoCusto());
        $stmt->bindParam(':preco',$objProduto->getPreco());
        $stmt->bindParam(':cod_fornecedor',$objProduto->getCodFornecedor());
        $stmt->bindParam(':cod_prescricao',$objProduto->getCodPrescricao());
        $stmt->bindParam(':cod_categoria',$objProduto->getCodCategoria());
        $stmt->bindParam(':quantidade_estoque',$objProduto->getQuantidadeEstoque());
        $stmt->bindParam(':data_F',$objProduto->getDataF());
        $stmt->bindparam(':data_V',$objProduto->getDataV());
        $stmt->bindParam(':descricao_produto', $objProduto->getDescricaoProduto());
        $stmt->bindParam('imagem',$objProduto->getImagem());

        $stmt->execute();
    }

    public function excluir($objProduto){
        //Conexão com o Banco de Dados
        $pdo = Conexao::obterConexao();
        
        $stmt = $pdo->prepare("DELETE FROM Produtos WHERE codigo = :codigo");
        $stmt->bindParam(':codigo',$objProduto->getCodigo());

        $stmt->execute();
    }

    public function buscarProdutoPorCodigo($codigo){
        //Conexão com o Banco de Dados
        $pdo = Conexao::obterConexao();
 
        $stmt = $pdo->prepare("SELECT * FROM Produtos WHERE codigo = :codigo");
        $stmt->bindParam(':codigo',$codigo);
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
        
    }

    public function alterar($objProduto){
        //Conexão com o Banco de Dados
        $pdo = Conexao::obterConexao();
        
        $stmt = $pdo->prepare("UPDATE Produtos SET nome = :nome, preco_custo = :preco_custo, preco = :preco, cod_fornecedor = :cod_fornecedor, cod_prescricao = :cod_prescricao,
         cod_categoria = :cod_categoria, quantidade_estoque = :quantidade_estoque, data_F = :data_F, data_V = :data_V, descricao_produto = :descricao_produto , imagem = :imagem WHERE codigo = :codigo");
        $stmt->bindParam(':codigo',$objProduto->getCodigo());
        $stmt->bindParam(':nome',$objProduto->getNomeProduto());
        $stmt->bindParam(':preco_custo', $objProduto->getPrecoCusto());
        $stmt->bindParam(':preco',$objProduto->getPreco());
        $stmt->bindParam(':cod_fornecedor',$objProduto->getCodFornecedor());
        $stmt->bindParam(':cod_prescricao',$objProduto->getCodPrescricao());
        $stmt->bindParam(':cod_categoria',$objProduto->getCodCategoria());
        $stmt->bindParam(':quantidade_estoque',$objProduto->getQuantidadeEstoque());
        $stmt->bindParam(':data_F',$objProduto->getDataF());
        $stmt->bindparam(':data_V',$objProduto->getDataV());
        $stmt->bindParam(':descricao_produto', $objProduto->getDescricaoProduto());
        $stmt->bindParam('imagem',$objProduto->getImagem());
        $stmt->execute();

    }


    public function cadastrarCategoria($objCategoria) {
        try {
            $pdo = Conexao::obterConexao();
    
            $stmt = $pdo->prepare("INSERT INTO categoria (categoria) VALUES (:categoria)");
            $stmt->bindParam(':categoria', $objCategoria->getNomeCategoria());
            $stmt->execute();
    
            echo "Categoria cadastrada com sucesso!";
        } catch (PDOException $e) {
            echo "Erro ao cadastrar categoria: " . $e->getMessage();
        }
    }
    
    

    public function salvarOuAtualizarCategoria($objCategoria)
    {
        $pdo = Conexao::obterConexao();
        $codigo = $objCategoria->getCriarCategoria();
        $nomeCategoria = $objCategoria->getNomeCategoria();
    
        // Verifica se a categoria já existe no banco
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM categoria WHERE codigo = :codigo");
        $stmt->bindParam(':codigo', $codigo, PDO::PARAM_INT);
        $stmt->execute();
    
        // Se a categoria já existe, atualiza. Caso contrário, insere uma nova
        if ($stmt->fetchColumn() > 0) {
            // Categoria já existe, realiza a atualização
            $stmt = $pdo->prepare("UPDATE categoria SET categoria = :categoria WHERE codigo = :codigo");
            $stmt->bindParam(':codigo', $codigo, PDO::PARAM_INT);
            $stmt->bindParam(':categoria', $nomeCategoria, PDO::PARAM_STR);
            $stmt->execute();
    
            echo "Categoria atualizada com sucesso!";
        } else {
            // Categoria não existe, insere uma nova
            $stmt = $pdo->prepare("INSERT INTO categoria (codigo, categoria) VALUES (:codigo, :categoria)");
            $stmt->bindParam(':codigo', $codigo, PDO::PARAM_INT);
            $stmt->bindParam(':categoria', $nomeCategoria, PDO::PARAM_STR);
            $stmt->execute();
    
            echo "Categoria cadastrada com sucesso!";
        }
    }
    
    
    public function verificarCategoriaExistente($codigo)
    {
        $pdo = Conexao::obterConexao();
    
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM categoria WHERE codigo = :codigo");
        $stmt->bindParam(':codigo', $codigo);
        $stmt->execute();
    
        return $stmt->fetchColumn() > 0; // Retorna true se já existir
    }
    
    public function alterarCategoria($objCategoria) {
        try {
            $pdo = Conexao::obterConexao();
    
            $stmt = $pdo->prepare("UPDATE categoria SET categoria = :categoria WHERE codigo = :codigo");
            $stmt->bindParam(':codigo', $objCategoria->getCriarCategoria(), PDO::PARAM_INT);
            $stmt->bindParam(':categoria', $objCategoria->getNomeCategoria(), PDO::PARAM_STR);
            $stmt->execute();
    
            echo "Categoria atualizada com sucesso!";
        } catch (PDOException $e) {
            echo "Erro ao atualizar categoria: " . $e->getMessage();
        }
    }
    

    public function excluirCategoria($categoria) {
        try {
            // Obter conexão com o banco de dados
            $pdo = Conexao::obterConexao();
    
            // Preparar a query de exclusão
            $sql = "DELETE FROM categoria WHERE codigo = :codigo";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':codigo', $categoria->getCriarCategoria(), PDO::PARAM_INT);
    
            // Executar a query
            if (!$stmt->execute()) {
                throw new Exception("Erro ao excluir a categoria no banco de dados.");
            }
        } catch (Exception $e) {
            throw new Exception("Erro no método excluirCategoria: " . $e->getMessage());
        }
    }
    

    public function buscarCategoriaPorCodigo($codigo)
    {
        $pdo = Conexao::obterConexao();
    
        // Busque a categoria com o código fornecido
        $stmt = $pdo->prepare("SELECT * FROM categoria WHERE codigo = :codigo");
        $stmt->bindParam(':codigo', $codigo);
        $stmt->execute();
    
        // Retorna a categoria encontrada ou falso se não houver categoria
        return $stmt->fetch(PDO::FETCH_ASSOC);  // Retorna o array ou false se não encontrar
    }
    
    

}

