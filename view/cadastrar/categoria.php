<?php

include('view/protect.php');
protegePaginaGerente(); // Restringe acesso caso necessário

require_once __DIR__ . '/../../model/ProdutoDao.php';
$produtoDao = new ProdutoDao();
$categorias = $produtoDao->buscarTodasCategorias();

// Obter categoria para alteração se "codigo" for passado na URL
$categoria = null;
if (isset($_GET['codigo'])) {
    $categoria = $produtoDao->buscarCategoriaPorCodigo($_GET['codigo']);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="view/Estilos/categoria.css">
    <title><?php echo isset($categoria) ? "Alteração de Categoria" : "Cadastro de Categoria"; ?></title>
</head>
<body>
    <div class="container">
        <h1><?php echo isset($categoria) ? "Alteração de Categoria" : "Cadastro de Categoria"; ?></h1>
        <form action="index.php?acao=<?php echo isset($categoria) ? 'alterarCategoria' : 'cadastrarCategoria'; ?>" method="POST">
            <div class="inputs">
                <div class="input_label">
                    <label for="txtcodigoCategoria">Código da Categoria:</label>
                    <input type="text" id="txtcodigoCategoria" name="txtcodigoCategoria"
                           value="<?php echo isset($categoria['codigo']) ? htmlspecialchars($categoria['codigo'], ENT_QUOTES) : ''; ?>" 
                           <?php echo isset($categoria) ? 'readonly' : ''; ?>><br><br>
                </div>
            </div>
            <div class="inputs">
                <div class="input_label">
                    <label for="txtcategoria">Nome da Categoria:</label>
                    <input type="text" id="txtcategoria" name="txtcategoria"
                           value="<?php echo isset($categoria['categoria']) ? htmlspecialchars($categoria['categoria'], ENT_QUOTES) : ''; ?>" required><br><br>
                </div>
            </div>
            <div class="submits">
                <button type="submit" class="submit">
                    <?php echo isset($categoria) ? "Alterar Categoria" : "Cadastrar Categoria"; ?>
                </button>
            </div>
        </form>

        <h2>Lista de Categorias</h2>
        <table border="1" style="width: 70%;">
            <tr style="color: white; background-color: black;">
                <th>Código</th>
                <th>Nome da Categoria</th>
                <th colspan="2">Ação</th>
            </tr>
            <?php if (!empty($categorias)) : ?>
                <?php foreach ($categorias as $cat): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($cat['codigo'], ENT_QUOTES); ?></td>
                        <td><?php echo htmlspecialchars($cat['categoria'], ENT_QUOTES); ?></td>
                        <td>
                            <a href="index.php?acao=paginaalterarcategoria&codigo=<?php echo urlencode($cat['codigo']); ?>" 
                               style="color: blue; text-decoration: none;">ALTERAR</a>
                        </td>
                        <td>
                            <a href="index.php?acao=excluircategoria&codigoCategoria=<?php echo urlencode($cat['codigo']); ?>" 
                               style="color: red; text-decoration: none;" 
                               onclick="return confirm('Tem certeza que deseja excluir esta categoria?');">EXCLUIR</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">Nenhuma categoria encontrada.</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>
</body>
</html>
