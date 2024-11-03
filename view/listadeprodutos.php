<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Produtos</title>
</head>
<body>

    <h1>Lista de Produtos</h1>

    <a href="index.php?acao=paginacadastrar"><button>Cadastrar Produto</button></a><br><br>

    <table border="1" style="width: 70%;">
        <tr style="color: white;background-color: black;">
            <th>Código</th>
            <th>Produto</th>
            <th>Preço Unitário</th>
            <th>QT estoque</th>
            <th colspan="2">Ação</th>
        </tr>
        <?php foreach($produtos as $produto): ?>
            <tr>
                <td><?php echo $produto['codigo'] ?></td>
                <td><?php echo $produto['nome'] ?></td>
                <td><?php echo number_format($produto['preco'],2,',','.'); ?></td>
                <td><?php echo $produto['quantidade_estoque'] ?></td>
                <td><a href="index.php?acao=paginaalterar&codigo=<?php echo $produto['codigo'] ?>">ALTERAR</a></td>
                <td><a href="index.php?acao=excluir&codigo=<?php echo $produto['codigo'] ?>">EXCLUIR</a></td>
            </tr>
        <?php endforeach; ?>
    </table> <br>
  

</body>
</html>