<?php
if(!isset($_SESSION)) {
    session_start();
}
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmácia Online</title>
    
    <style>
       body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f5f5f5;
}

header {
    background-color: #a50000;
    color: white;
    padding: 10px;
    text-align: center;
    font-size: 24px;
}

.container {
    display: flex;
}

.menu {
    width: 20%;
    background-color: #f0f0f0;
    padding: 20px;
    box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
}

.menu ul {
    list-style: none;
    padding: 0;
}

.menu li {
    margin: 10px 0;
}

.menu li a {
    text-decoration: none;
    color: #333;
    font-weight: bold;
}

.menu li a.active {
    color: #a50000;
    border-left: 4px solid #a50000;
    padding-left: 5px;
}

.content {
    width: 80%;
    padding: 20px;
}

.search-bar {
    display: flex;
    margin-bottom: 20px;
}

.search-bar input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.search-bar button {
    padding: 10px 20px;
    margin-left: 10px;
    background-color: #a50000;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.product {
    display: inline-block;
    width: 30%;
    margin: 1%;
    text-align: center;
    background: white;
    padding: 15px;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
    border-radius: 8px;
}

.product img {

    max-height: 200px; /* Altura fixa */
    object-fit: cover; /* Assegura que a imagem cubra o espaço disponível sem distorcer */
    border-radius: 5px; /* Bordas arredondadas para as imagens */
}

.product .price {
    font-size: 18px;
    color: #333;
}

.product .add-to-cart {
    display: block;
    background-color: #a50000;
    color: white;
    padding: 10px;
    text-decoration: none;
    border-radius: 4px;
    margin-top: 10px;
}

.product .discount {
    color: green;
    font-size: 14px;
}


    </style>
</head>
<body>
    <header>FARMÁCIA</header>
    <div class="container">
    <a href="index.php?acao=logoutCliente"><Button>Sair</Button></a>
    <a href="index.php?acao=mostrarCarrinho"><Button>Carrinho</Button></a>
    <aside class="menu">
    <ul>
        <li>
            <a href="?acao=catalogoDeProdutos">Todos os Produtos</a>
        </li>
        <?php foreach ($categorias as $categoria): ?>
            <li>
                <a href="?acao=listarProdutosPorCategoria&cod_categoria=<?= strtolower(str_replace(' ', '_', $categoria['codigo'])) ?>">
                    <?= htmlspecialchars($categoria['categoria']) ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</aside>
        <main class="content">
        <div class="search-bar">
        <form action="index.php" method="GET">
    <input type="hidden" name="acao" value="catalogoDeProdutos">
    <input type="text" name="search" id="search" placeholder="Busque o item">
    <button type="submit">🔍</button>
</form>    
            </div>
            <div class="products">
    <ul>
        <?php if (!empty($produtos)): ?>
            <?php foreach ($produtos as $produto): ?>
                <li class="product">
                    <h2><?= htmlspecialchars($produto['nome']) ?></h2>
                    <img src="view/imgs/<?= htmlspecialchars($produto['IMAGEM']) ?>" alt="<?= htmlspecialchars($produto['nome']) ?>">
                    <p>Preço: R$ <?= number_format($produto['preco'], 2, ',', '.') ?></p>
                    <p><?= htmlspecialchars($produto['descricao_produto']) ?></p>
                <form method="POST" action="?acao=adicionarAoCarrinho">
                    <input type="hidden" name="codProd" value="<?= htmlspecialchars($produto['codigo']) ?>">
                    <input type="number" name="quantidade" value="1" min="1" style="width: 50px;">
                    <button type="submit" class="add-to-cart">ADICIONAR</button>
                </form>
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Nenhum produto encontrado para esta categoria.</p>
        <?php endif; ?>
    </ul>
</div>
        </main>
    </div>
</body>
</html>