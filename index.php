<?php
// Inicia a sessão
session_start();

// Inclui os controladores com o caminho correto
require_once __DIR__ . '/controller/FuncionarioController.php';
require_once __DIR__ . '/controller/ProdutoController.php';
require_once __DIR__ . '/controller/ClienteController.php';

// Inclui o roteador que vai direcionar as requisições
require_once __DIR__ . '/router.php';