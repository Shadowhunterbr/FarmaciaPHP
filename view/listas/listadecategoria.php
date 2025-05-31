<?php

include('protect.php');
require_once __DIR__ . '/../model/ProdutoDao.php';

$produtoDao = new ProdutoDao();
$categorias = $produtoDao->buscarTodasCategorias();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Categorias</title>
</head>
<body>

    <h1>Lista de Categorias</h1>

    <a href="index.php?acao=paginacadastrar"><button>Cadastrar Produtos</button></a>
    <br><br>
    <a href="index.php?acao=paginacadastrarcategoria"><button>Cadastrar Categorias</button></a>
    <a href="index.php?acao=listarProdutos"><button>Produtos</button></a>
    <a href="index.php?acao=paginaCadastrarFornecedor"><button>Cadastrar Fornecedor</button></a>
    <a href="index.php?acao=listarFuncionarios"><button>Funcionários</button></a><br><br>
    <a href="index.php?acao=logout"><button>Logout</button></a>

    <table border="1" style="width: 70%;">
        <tr style="color: white; background-color: black;">
            <th>Código</th>
            <th>Nome da Categoria</th>
            <th colspan="2">Ação</th>
        </tr>
        <?php foreach ($categorias as $categoria): ?>
            <tr>
                <td><?php echo $categoria['codigo']; ?></td>
                <td><?php echo $categoria['categoria']; ?></td>
                <td><a href="index.php?acao=paginaalterarcategoria&codigo=<?php echo $categoria['codigo']; ?>">ALTERAR</a></td>
                <td><a href="index.php?acao=excluircategoria&codigo=<?php echo $categoria['codigo']; ?>">EXCLUIR</a></td>
            </tr>
        <?php endforeach; ?>
    </table> <br>

</body>
</html>
