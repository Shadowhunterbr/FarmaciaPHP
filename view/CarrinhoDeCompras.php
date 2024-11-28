<?php

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Estilos/carrinho.css">
    <title>Carrinho de Compras</title>
</head>
<body>
    
        <div class="title">
            <h1>Carrinho de Compras</h1>
        </div>
        <?php if (empty($produtos)): ?>
            <div class="carrinhoVazio">
                <p>Seu carrinho está vazio.</p>
            </div>
            <div class="containerButton">
                <div class="catalogoProduto">
                    <a href="?acao=catalogoDeProdutos">Voltar ao Catálogo</a>
                </div>
            </div>
        <?php else: ?>
            <div class="table">
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
                                        <div class="submit_button"><button type="submit">Remover</button></div>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="containerButton">
                <div class="catalogoProduto"><a href="?acao=catalogoDeProdutos">Continuar Comprando</a></div>
            </div>
    
    <?php endif; ?>
</body>
</html>