<?php

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho de Compras</title>
</head>
<body>
    <h1>Carrinho de Compras</h1>

    <?php if (empty($produtos)): ?>
        <p>Seu carrinho está vazio.</p>
        <a href="?acao=catalogoDeProdutos">Voltar ao Catálogo</a>
    <?php else: ?>
        <table border="1">
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Preço Unitário</th>
                    <th>Quantidade</th>
                    <th>Subtotal</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($produtos as $produto): ?>
                    <tr>
                        <td><?= ($produto['nome']) ?></td>
                        <td>R$ <?= number_format($produto['preco'], 2, ',', '.') ?></td>
                        <td><?= $produto['quantidade'] ?></td>
                        <td>R$ <?= number_format($produto['subtotal'], 2, ',', '.') ?></td>
                        <td>
                            <form method="post" action="?acao=removerProdutoCarrinho">
                                <input type="hidden" name="codProd" value="<?= $produto['cod_prod'] ?>">
                                <button type="submit">Remover</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="?acao=catalogoDeProdutos">Continuar Comprando</a>
    <?php endif; ?>
</body>
</html>