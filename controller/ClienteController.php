<?php

require_once __DIR__ . "/../model/Cliente.php";
require_once __DIR__ . "/../model/ClienteDao.php";

class ClienteController{

    public function mostrarPaginaLogin(){

        require_once __DIR__ . "/../view/logins/loginCliente.php";
    }

    public function login() {
        $email = $_POST['txtemailCliente'];
        $senha = $_POST['txtsenhaCliente'];
    
        $clienteDao = new ClienteDao();
        $cliente = $clienteDao->autentica($email, $senha);
    
        if ($cliente !== null) {
            session_start();
            $_SESSION['clienteAutenticado'] = $cliente;
           
    
            header("Location: index.php?acao=catalogoDeProdutos");
            exit();
        } else {
            header("Location: index.php?acao=loginCliente"); 
            exit();
        }
    }

    public function catalogoDeProdutos() {
        
        require_once __DIR__ . "/../view/catalogoDeProdutos.php";
    }
}