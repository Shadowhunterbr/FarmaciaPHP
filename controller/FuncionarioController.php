<?php

require_once __DIR__ . "/../model/FornecedorDao.php";
require_once __DIR__ . "/../model/Funcionario.php";
require_once __DIR__ . "/../model/FuncionarioDao.php";

require_once __DIR__ ."/../model/ProdutoDao.php";
require_once __DIR__ . "/../model/Produto.php";
require_once __DIR__ . "/../model/GerenteDao.php";


class FuncionarioController{


    public function mostrarPaginaLogin() {
        require_once __DIR__ . "/../view/loginFuncionario.php";
    }

    public function login() {
        $login = $_POST['txtloginfuncionario'];
        $senha = $_POST['txtsenhafuncionario'];

        $funcionarioDao = new FuncionarioDao();
        $funcionario = $funcionarioDao->autentica($login, $senha);

        if ($funcionario !== null) {
            session_start();
            $_SESSION['funcionarioAutenticado'] = $funcionario;
            header("Location: index.php?acao=listarProdutos");
            exit();
        } else {
            header("Location: index.php?acao=login"); // fazer um alert para erro de login
            exit();
        }
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header("Location:  index.php?acao=login");
        exit();
    }

    public function listarFuncionarios(){
        
        $funcionarioDao = new FuncionarioDao();
        $funcionarios = $funcionarioDao->buscarTodosFuncionarios();

        require_once __DIR__ . "/../view/listadefuncionarios.php";
    }

    public function excluir(){

        if(isset($_GET['codigo'])){
            
            $codigo = $_GET['codigo'];
            
            $objFuncionario = new Funcionario($codigo,null,null,null,null,null,null,null,null);

            $gerenteDao = new GerenteDao();
            $gerenteDao->excluir($objFuncionario);

            header("Location: index.php?acao=listarFuncionarios");
            exit();

        }

    }

}