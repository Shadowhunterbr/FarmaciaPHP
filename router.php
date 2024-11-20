<?php

require_once __DIR__ . "/controller/FuncionarioController.php";
require_once __DIR__ . "/controller/ProdutoController.php";
require_once __DIR__ . "/controller/ClienteController.php";


$clienteController = new ClienteController();
$funcionarioController = new FuncionarioController();
$produtoController = new ProdutoController();

$acao = $_GET['acao'] ?? 'autenticarCliente';

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
    
        //cliente    
    
    case 'loginCliente':
        $clienteController->mostrarPaginaLogin();
        break;
    case 'autenticarCliente': 
         $clienteController->login();
        break;
    case 'cadastrarCliente':
        $clienteController->cadastrarCliente();
        break;    
    case 'catalogoDeProdutos':
        $clienteController->catalogoDeProdutos();
        break;
    case 'listarProdutosPorCategoria':
            $codCategoria = $_GET['cod_categoria'] ?? null;
        
            if ($codCategoria) {
                $produtoController->listarProdutosPorCategoria($codCategoria);
            } else {
                echo "Categoria não selecionada ou inválida.";
            }
    break;

    default:
    header("Location: index.php?acao=loginCliente");
        break;
}