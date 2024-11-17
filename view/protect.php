<?php 

// este arquivo contem as funções para protger as paginas de acordo com o nivel do usuario

// Inicia a sessão, se ainda não estiver iniciada
if(!isset($_SESSION)) {
    session_start();
}

// Verifica se o usuário é um funcionário autenticado
if(!isset($_SESSION['funcionarioAutenticado']) && !isset($_SESSION['gerenteAutenticado']) && !isset($_SESSION['clienteAutenticado'])) {
    die("Você não pode acessar esta página porque não está logado.<p><a href=\"index.php\">Entrar</a></p>");
}


function protegePaginaGerente() {
    if(!isset($_SESSION['gerenteAutenticado'])) {
        die("Acesso restrito a gerentes.<p><a href=\"index.php\">Entrar como gerente</a></p>");
    }
}
?>