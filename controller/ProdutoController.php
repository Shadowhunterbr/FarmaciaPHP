<?php

require_once __DIR__ ."/../model/ProdutoDao.php";
require_once __DIR__ . "/../model/Produto.php";
require_once __DIR__ . "/../model/FornecedorDao.php";

use \model\Produto;

class ProdutoController{
    public function listarProdutos(){
        
        $produtoDao = new ProdutoDao();
        $produtos = $produtoDao->buscarTodosProdutos();

        require_once __DIR__ . "/../view/listadeprodutos.php";
    }


    public function mostrarPaginaCadastro(){
        
        $fornecedorDao = new FornecedorDao();
        $fornecedores = $fornecedorDao->buscarTodosFornecedores();
        $categoriaDao = new ProdutoDao();
        $categorias = $categoriaDao->buscarTodasCategorias();
        $prescricaoDao = new ProdutoDao();
        $prescricao = $prescricaoDao->arrayPrescricao();
        require_once __DIR__ . "/../view/cadastroproduto.php";

    }

    public function cadastrar(){
        $codigo = null;
        $nomeProduto = $_POST['txtproduto'];
        $precoCusto = $_POST['txtpreco_custo'];
        $preco = $_POST['txtprecounitario'];
        $quantidade_estoque = $_POST['txtquantidade_estoque'];
        $cod_prescricao = $_POST['prescricao_produto'];
        $cod_categoria = $_POST['categoria_produto'];
        $cod_forncedor = $_POST['fornecedor_produto'];
        $data_F = $_POST['txtdatafabricacao'];
        $data_V = $_POST['txtdatavalidade'];
        $descricaoProduto = $_POST['txtdescricao_produto'];
        
                

        $objProduto = new Produto($codigo,$nomeProduto,$precoCusto,$preco,$quantidade_estoque,$cod_categoria,$cod_forncedor,$cod_prescricao,$data_F,$data_V,$descricaoProduto);
        
        $produtoDao = new ProdutoDao();
        $produtoDao->cadastrar($objProduto);

        header("Location: index.php");
        exit();
    }

    public function excluir(){

        if(isset($_GET['codigo'])){
            
            $codigo = $_GET['codigo'];
            
            $objProduto = new Produto($codigo,null,null,null,null,null,null,null,null,null,null);

            $produtoDao = new ProdutoDao();
            $produtoDao->excluir($objProduto);

            header("Location: index.php");
            exit();

        }

    }
/*
    public function mostrarPaginaAlterar(){

        if(isset($_GET['codigo'])){

            $codigo = $_GET['codigo'];

            $produtoModel = new Produto(null,null,null);
            $produtoData = $produtoModel->buscarProdutoPorCodigo($codigo);

            include __DIR__ . "/../view/cadastroproduto.php";

        }
    }

    public function alterar(){
        $codigo = $_POST['txtcodigo'];
        $produto = $_POST['txtproduto'];
        $precoUnitario = $_POST['txtprecounitario'];

        $produtoModel = new Produto($codigo,$produto,$precoUnitario);
        $produtoModel->alterar();

        header("Location: index.php");
        exit();

    }
*/
}


