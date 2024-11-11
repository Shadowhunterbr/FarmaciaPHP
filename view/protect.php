<?php 

// isso aqui previni que usuarios acessem paginas sem estarem LOGADOS

if(!isset($_SESSION)) {
    session_start();
}

if(!isset($_SESSION['funcionarioAutenticado'])) {
    die("Você não pode acessar esta página porque não está logado.<p><a href=\"index.php\">Entrar</a></p>");
}


?>