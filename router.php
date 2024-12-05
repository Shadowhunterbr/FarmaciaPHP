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
         
        //produtos:   
    case 'listarProdutos':
        $produtoController->listarProdutos();
        break;
    case 'cadastrar': // atenção aqui
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
    case 'paginacadastrarcategoria':
        $produtoController->mostrarPaginaCadastroCategoria();
        break;
    case 'cadastrarCategoria':
        $produtoController->cadastrarCategoria();
        break;
    case 'uploadImagem':
     $produtoController->salvarImagem();
        break;    
    
        //cliente    
    
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
            echo ($_POST['codProd']);
            echo(isset($_POST['codProd']));
            $codCliente = $_SESSION['codCliente'] ?? null;
        
            if ($codCliente && $codProd) {
                $clienteController->removerProduto($codCliente, $codProd);
            }
            header("Location: index.php?acao=mostrarCarrinho");
            break;
            case 'finalizarPedido':
                // Garantir que o codCliente esteja na sessão
                $codCliente = $_SESSION['codCliente'] ?? null;
                if ($codCliente) {
                    $clienteController->finalizarPedido($codCliente); // Passar o codCliente como argumento
                } else {
                    // Caso o cliente não esteja logado, redirecionar para o login
                    header("Location: index.php?acao=loginCliente");
                    exit();
                }
                break;      

        case 'paginaalterarfuncionario':
            $funcionarioController->mostrarPaginaAlterar();
            break;
            
        case 'alterarFuncionario':
            $funcionarioController->alterarFuncionario();
            break;
        case 'mostrarPedidos':
            $clienteController->mostrarPedidos();
            break; 
            case 'processarUploadReceita':
                echo "Processando upload de receita..."; // Para depuração
                $codCliente = $_POST['codCliente'] ?? null;
                if ($codCliente && isset($_FILES['receita'])) {
                    $uploadDir = 'view/receitas/';
                    $uploadFile = $uploadDir . basename($_FILES['receita']['name']);
                    
                    if (move_uploaded_file($_FILES['receita']['tmp_name'], $uploadFile)) {
                        echo "<script>alert('Receita enviada com sucesso!');</script>";
                        header("Location: index.php?acao=finalizarPedido");
                        exit; // Importante
                    } else {
                        echo "<script>alert('Erro ao enviar a receita. Tente novamente.');</script>";
                        header("Location: index.php?acao=mostrarCarrinho");
                        exit; // Importante
                    }
                }
                break;
                
                 
    default:
    header("Location: index.php?acao=loginCliente");
        break;
}