<?php

require_once __DIR__ ."/../model/ProdutoDao.php";
require_once __DIR__ . "/../model/Produto.php";
require_once __DIR__ . "/../model/FuncionarioDao.php";
require_once __DIR__ . "/../model/Categorias.php";
require_once __DIR__ . "/../model/PedidoDao.php";

use \model\Produto;

class ProdutoController{

    
    public function listarProdutos(){
        
        $pedidoDao = new PedidoDao();
        $fornecedorDao = new FornecedorDao();
        $produtoDao = new ProdutoDao();
        $produtos = $produtoDao->buscarTodosProdutos();
        $categorias = $produtoDao->buscarTodasCategorias();
        $fornecedores = $fornecedorDao->buscarTodosFornecedores();
        $prescricao = $produtoDao->arrayPrescricao();
        $quantPedidos = $pedidoDao->contarPedidos(); 
       

        $totalVendas = $produtoDao->calcularTotalVendas();
        $totalPrecoCusto = $produtoDao->calcularTotalPrecoCustoVendidos();
        $totalLiquido =  $totalVendas- $totalPrecoCusto; 

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

        require_once __DIR__ . "/../view/cadastrar/produto.php";

        }
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
    

    public function salvarOuAtualizarCategoria() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Captura os dados do formulário
            $codigoCategoria = $_POST['txtcodigoCategoria'] ?? null;
            $nomeCategoria = $_POST['txtcategoria'] ?? null;
    
            // Valida os dados
            if (!$nomeCategoria) {
                echo "O nome da categoria é obrigatório!";
                exit;
            }
    
            $produtoDao = new ProdutoDao();
    
            if ($codigoCategoria) {
                // Atualizar categoria
                try {
                    $produtoDao->alterarCategoria(new Categorias($codigoCategoria, $nomeCategoria));
                    header("Location: index.php?acao=listarCategorias");
                    exit();
                } catch (Exception $e) {
                    echo "Erro ao atualizar categoria: " . $e->getMessage();
                    exit();
                }
            } else {
                // Cadastrar nova categoria
                try {
                    $produtoDao->cadastrarCategoria(new Categorias(null, $nomeCategoria));
                    header("Location: index.php?acao=listarCategorias");
                    exit();
                } catch (Exception $e) {
                    echo "Erro ao cadastrar categoria: " . $e->getMessage();
                    exit();
                }
            }
        }
    } 
    
    
    public function listarCategorias() {
        $categoriaDao = new ProdutoDao();
        $categorias = $categoriaDao->buscarTodasCategorias();
    
        require_once __DIR__ . "/../view/listadecategoria.php";
    }
    
    
    public function alterarCategoria() {
        $codigo = $_POST['txtcodigoCategoria'];
        $categoria = $_POST['txtcategoria'];
    
        $categoriaDao = new ProdutoDao();
        $categoriaDao->alterarCategoria(new Categorias($codigo, $categoria));
    
        //header("Location: index.php?acao=listarCategorias");
        header("Location: index.php?acao=listarProdutos");
        exit();
    }
    

    public function excluirCategoria() {
        if (isset($_GET['codigoCategoria'])) {
            $codigo = $_GET['codigoCategoria'];
    
            $categoriaDao = new ProdutoDao();
            try {
                // Passando um nome vazio como segundo argumento
                $categoriaDao->excluirCategoria(new Categorias($codigo, ''));
                //header("Location: index.php?acao=listarCategorias");
                header("Location: index.php?acao=listarProdutos");
                exit();
            } catch (Exception $e) {
                echo "Erro ao excluir a categoria: " . $e->getMessage();
            }
        } else {
            echo "Código da categoria não foi fornecido.";
        }
        
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

    public function mostrarPaginaAlterarCategoria()
    {
        if (isset($_GET['codigo'])) {
            $codigo = $_GET['codigo'];
            // Instancia o ProdutoDao
            $categoriaDao = new ProdutoDao();  
            // Busca os dados da categoria pelo código
            $categoria = $categoriaDao->buscarCategoriaPorCodigo($codigo);     
            // Verifica se a categoria foi encontrada
            if (!$categoria) {
                echo "Categoria não encontrada.";
                exit;
            }
    
            // Inclui a página de alteração com os dados da categoria
            require_once __DIR__ . '/../view/cadastrar/categoria.php';
        } else {
            echo "Código da categoria não fornecido.";
            exit;
        }
    }
    
    public function salvarImagem() {
        

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Verifica e processa o upload da imagem
            if (isset($_FILES['IMAGEM']) && $_FILES['IMAGEM']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = 'view/imgs/';
                $uploadFile = $uploadDir . basename($_FILES['IMAGEM']['name']);
    
                if (move_uploaded_file($_FILES['IMAGEM']['tmp_name'], $uploadFile)) {
                    echo "Arquivo enviado com sucesso: " . $uploadFile;
                } 
            } else {
                echo "Nenhum arquivo enviado ou erro no upload.";
            }
            header("Location: index.php?acao=listarProdutos");
            exit();
           }   
        } 
    
}


