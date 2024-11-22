<?php

require_once __DIR__ ."/../model/ProdutoDao.php";
require_once __DIR__ . "/../model/Produto.php";
require_once __DIR__ . "/../model/FuncionarioDao.php";
require_once __DIR__ . "/../model/Categorias.php";

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
        require_once __DIR__ . "/../view/cadastrar/produto.php";

    }
    public function mostrarPaginaCadastroCategoria(){
        
        $categoriaDao = new ProdutoDao();
        $categorias = $categoriaDao->buscarTodasCategorias();
        require_once __DIR__ . "/../view/cadastrar/categoria.php";

    }


    public function mostrarPaginaAlterar(){

        if(isset($_GET['codigo'])){

            $codigo = $_GET['codigo'];

            // Instancia o ProdutoDao
            $produtoDao = new ProdutoDao();
    
            // Busca os dados do produto pelo código
        $produtoData = $produtoDao->buscarProdutoPorCodigo($codigo);
        $fornecedorDao = new FornecedorDao();
        $fornecedores = $fornecedorDao->buscarTodosFornecedores();
        $categoriaDao = new ProdutoDao();
        $categorias = $categoriaDao->buscarTodasCategorias();
        $prescricaoDao = new ProdutoDao();
        $prescricao = $prescricaoDao->arrayPrescricao();

            include __DIR__ . "/../view/cadastrarproduto.php";

        }
    } /** DADASDASIDOJASDOASIHDFOASFJBASEDIKFJIKOHADSKFOLPASJHOLIKFSAIKLJASDFKLHAZX */

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
        $imagem = $_POST['imagem_produto'];
        
        $objProduto = new Produto($codigo,$nomeProduto,$precoCusto,$preco,$quantidade_estoque,$cod_categoria,$cod_forncedor,$cod_prescricao,$data_F,$data_V,$descricaoProduto,$imagem);
        
        $produtoDao = new ProdutoDao();
        $produtoDao->cadastrar($objProduto);

        header("Location: index.php?acao=listarProdutos");
        exit();
    }

    public function excluir(){

        if(isset($_GET['codigo'])){
            
            $codigo = $_GET['codigo'];
            
            $objProduto = new Produto($codigo,null,null,null,null,null,null,null,null,null,null,null);

            $produtoDao = new ProdutoDao();
            $produtoDao->excluir($objProduto);

            header("Location: index.php?acao=listarProdutos");
            exit();

        }

    }

    

    public function alterar(){
        $codigo = $_POST['txtcodigo'];
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
        $imagem = $_POST['imagem_produto'];

        $produtoDao = new ProdutoDao();

        $objProduto = new Produto($codigo,$nomeProduto,$precoCusto,$preco,$quantidade_estoque,$cod_categoria,$cod_forncedor,$cod_prescricao,$data_F,$data_V,$descricaoProduto, $imagem);
        $produtoDao->alterar($objProduto);

        header("Location: index.php?acao=listarProdutos");
        exit();

    }

    public function cadastrarCategoria(){
        $codigo = $_POST['txtcodigoCategoria'];
        $categoria = $_POST['txtcategoria'];

        $categoriaDao = new ProdutoDao();

        $objCategoria = new Categorias($codigo,$categoria);
        $categoriaDao->cadastrarCategoria($objCategoria);

        header("Location: index.php?acao=listarProdutos");
        exit();

    }
    public function listarProdutosPorCategoria($codCategoria) {
        // Validação do ID da categoria
        if (!is_numeric($codCategoria)) {
            echo "Codigo de categoria inválido.";
            return;
        }

        // Chamar o modelo para buscar os produtos
        $produtoDao = new ProdutoDao();
        $produtos = $produtoDao->buscarPorCategoria($codCategoria);
        $dao = new ClienteDao();
        $generos = $dao->generos();
        $produtoDao = new ProdutoDao();
        $categorias = $produtoDao->buscarTodasCategorias();

        // Exibir os produtos (pode ser em uma view separada)
        require_once __DIR__ . "/../view/catalogoDeProdutos.php";
    }

}


