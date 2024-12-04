<?php

require_once __DIR__ . "/controller/FuncionarioController.php";
require_once __DIR__ . "/controller/ProdutoController.php";
require_once __DIR__ . "/controller/ClienteController.php";

$is_dev = true;

function debug() {
    global $is_dev;

    if ($is_dev) {
        $debug_arr = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
        $line = $debug_arr[0]['line'];
        $file = $debug_arr[0]['file'];

        header('Content-Type: text/plain');

        echo "linha: $line\n";
        echo "arquivo: $file\n\n";
        print_r(array('GET' => $_GET, 'POST' => $_POST, 'SERVER' => $_SERVER));
        exit;
    }
}

$clienteController = new ClienteController();
$funcionarioController = new FuncionarioController();
$produtoController = new ProdutoController();

$acao = $_GET['acao'] ?? 'loginCliente';

// Direciona para o controlador e ação corretos
switch ($acao) {
    // Ações para Funcionários
    case 'login':
        $funcionarioController->mostrarPaginaLogin();
        break;
    case 'autenticar':
        $funcionarioController->login();
        break;
    case 'logout':
        $funcionarioController->logout();
        break;
    case 'listarFuncionarios':
        $funcionarioController->listarFuncionarios();
        break;
    case 'excluirFuncionario':
        $funcionarioController->excluir();
        break;
    case 'paginacadastrarfuncionario':
        $funcionarioController->mostrarPaginaCadastro();
        break;
    case 'cadastrarFuncionario':
        $funcionarioController->cadastrarFuncionario();
        break;
    case 'paginaCadastrarFornecedor':
        $funcionarioController->mostrarPaginaCadastroFornecedor();
        break;
    case 'cadastrarFornecedor':
        $funcionarioController->cadastrarFornecedor();
        break;

    // Ações para Produtos
    case 'listarProdutos':
        $produtoController->listarProdutos();
        break;
    case 'cadastrar': // Cadastrar produto
        $produtoController->cadastrar();
        break;
    case 'paginacadastrar':    
        $produtoController->mostrarPaginaCadastro();
        break;
    case 'excluir':
        $produtoController->excluir();
        break;
    case 'paginaalterar':
        $produtoController->mostrarPaginaAlterar();
        break;  
    case 'alterar':
        $produtoController->alterar();
        break;
    case 'uploadImagem':
        $produtoController->salvarImagem();
        break;    

    // Ações para Categorias
    case 'paginacadastrarcategoria':
        $produtoController->mostrarPaginaCadastroCategoria();
        break;
    case 'cadastrarCategoria':  // Ação para cadastrar ou atualizar a categoria
        $produtoController->cadastrarCategoria();
        break;
    //case 'cadastrarCategoria':  // Ação para cadastrar ou atualizar a categoria
    //    $produtoController->salvarOuAtualizarCategoria();
    //    break;
    case 'listarCategorias': // Listar categorias
        $produtoController->listarCategorias();
        break;
    case 'paginaalterarcategoria': // Página para alterar categoria
        $produtoController->mostrarPaginaAlterarCategoria();
        break;
    //case 'alterarCategoria': // Ação para alterar a categoria
        //$produtoController->salvarOuAtualizarCategoria();  // Usando o método para salvar ou atualizar
        //break;
    case 'alterarCategoria':
        $produtoController->alterarCategoria();  // Método exclusivo para alterar
        break;
    case 'excluircategoria': // Excluir categoria
        $produtoController->excluirCategoria();
        break;

    // Ações para Clientes
    case 'loginCliente':
        $clienteController->mostrarPaginaLogin();
        break;
    case 'logoutCliente':
        $clienteController->logout();
        break;
    case 'autenticarCliente': 
        $clienteController->login();
        break;
    case 'cadastrarCliente':
        $clienteController->cadastrarCliente();
        break;    
    case 'catalogoDeProdutos':
        $search = $_GET['search'] ?? null; // Recebe o termo de pesquisa, se existir
        $clienteController->catalogoDeProdutos($search);
        break;
    case 'listarProdutosPorCategoria':
        $codCategoria = $_GET['cod_categoria'] ?? null;
        if ($codCategoria) {
            $produtoController->listarProdutosPorCategoria($codCategoria);
        } else {
            echo "Categoria não selecionada ou inválida.";
        }
        break;
    case 'mostrarCarrinho':
        $data = $_POST; // Ou $_GET, dependendo do caso
        $clienteController->visualizarCarrinho($data);
        break;
    case 'adicionarAoCarrinho':
        $codProd = $_POST['codProd'] ?? null; 
        $quantidade = $_POST['quantidade'] ?? 1; 
        $codCliente = $_SESSION['codCliente'] ?? null; // Certifique-se de que o cliente está autenticado    
        if ($codCliente && $codProd) {
            $clienteController->adicionarProduto($codCliente, $codProd, $quantidade);
        }
        header('Location: index.php?acao=catalogoDeProdutos');
        break;
    case 'removerProdutoCarrinho':
        $codProd = $_POST['codProd'] ?? null;
        $codCliente = $_SESSION['codCliente'] ?? null;
        if ($codCliente && $codProd) {
            $clienteController->removerProduto($codCliente, $codProd);
        }
        header("Location: index.php?acao=mostrarCarrinho");
        break;

    // Ações para Funcionário
    case 'paginaalterarfuncionario':
        $funcionarioController->mostrarPaginaAlterar();
        break;
    case 'alterarFuncionario':
        $funcionarioController->alterarFuncionario();
        break;
    
    default:
        header("Location: index.php?acao=loginCliente");
        break;

}
