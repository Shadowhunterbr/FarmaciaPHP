<?php 

// isso aqui previni que usuarios acessem paginas sem estarem LOGADOS

if(!isset($_SESSION)) {
    session_start();
}

if(!isset($_SESSION['gerenteAutenticado'])) {
    die("Apenas gerentes podem acessar esta pagina!!!.<p><a href=\"index.php\">Entrar</a></p>");
}


?>