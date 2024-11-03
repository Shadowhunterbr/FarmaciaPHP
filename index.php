<?php

require_once "controller/ProdutoController.php";

$controller = new ProdutoController();

if(isset($_GET['acao']) && $_GET['acao'] === 'paginacadastrar'){
    $controller->mostrarPaginaCadastro();
}else if(isset($_POST['acao']) && $_POST['acao'] === 'cadastrar'){
    $controller->cadastrar();
}else if(isset($_GET['acao']) && $_GET['acao'] === 'excluir'){
    $controller->excluir();
}else if(isset($_GET['acao']) && $_GET['acao'] === 'paginaalterar'){
    //$controller->mostrarPaginaAlterar();
}else if(isset($_POST['acao']) && $_POST['acao'] === 'alterar'){
    //$controller->alterar();
}else{
    $controller->listarProdutos();

}

