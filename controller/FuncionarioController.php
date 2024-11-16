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
    
            if ($funcionario->getCargoFuncionario() === 'Gerente') {
                $_SESSION['gerenteAutenticado'] = $funcionario;
            } else {
                $_SESSION['funcionarioAutenticado'] = $funcionario;
            }
    
            header("Location: index.php?acao=listarProdutos");
            exit();
        } else {
            header("Location: index.php?acao=login"); 
            exit();
        }
    }

    public function mostrarPaginaCadastro(){
        $funcionarioDao = new FuncionarioDao();
        $funcionarios = $funcionarioDao->buscarTodosFuncionarios();
        $generos = $funcionarioDao->generos();

        require_once __DIR__ . "/../view/cadastrafuncionario.php";
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header("Location:  index.php?acao=login"); // podemos redirecionar para outra pagina antes do login
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
    public function cadastrarFuncionario() {
        // Captura os dados do formulário
        $codigo = null;
        $nome = $_POST['txtnomefuncionario'];
        $email = $_POST['txtemailfuncionario'];
        $login = $_POST['txtloginfuncionario'];
        $senha = $_POST['txtsenhafuncionario'];
        $telefone = $_POST['txttelefonefuncionario'];
        $cpf = $_POST['txtcpffuncionario'];
        $cargo = $_POST['txtcargofuncionario'];
        $cod_genero = $_POST['generofuncionario'];
        
        // Cria uma instância de Funcionario com os dados capturados
        $objFuncionario = new Funcionario($codigo, $nome, $email, $login, $senha, $telefone, $cpf, $cargo, $cod_genero);
    
        // Instancia FuncionarioDao e cadastra o funcionário
        $funcionarioDao = new GerenteDao();
        $funcionarioDao->cadastrarFuncionario($objFuncionario);
    
        // Redireciona para a página de listagem de funcionários
        header("Location: index.php?acao=listarFuncionarios");
        exit();
    }


    public function cadastrarFornecedor(){

   


        
    }

   

}