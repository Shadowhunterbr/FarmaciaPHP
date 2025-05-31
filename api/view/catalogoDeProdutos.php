<?php
if(!isset($_SESSION)) {
    session_start();
}   
include('view/protect.php');
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
           position: relative;
       }

       .header-buttons {
           position: absolute;
           top: 50%;
           right: 20px;
           transform: translateY(-50%);
       }

       .header-buttons a button {
           background-color: #ffffff;
           color: #a50000;
           border: none;
           border-radius: 4px;
           padding: 8px 12px;
           cursor: pointer;
           font-size: 14px;
           margin-left: 10px;
       }

       .header-buttons a button:hover {
           background-color: #d9d9d9;
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
           font-size: 30px;
           transition: color 0.3s ease;
       }

       .menu li a:hover {
        color: #6b7fed; /* Cor ao passar o mouse */
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
           justify-content: flex-start;
           margin-bottom: 20px;
           width: 650px;
           align-items: center;
       }
        .search-bar form {
            display: flex;
            align-items: center;
            width: 100%;
        }       

       .search-bar input {
           width: 200%;
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
           width: 28%;
           margin: 1%;
           text-align: center;
           background: white;
           padding: 15px;
           box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
           border-radius: 8px;
       }

       .product img {
           max-height: 200px;
           object-fit: cover;
           border-radius: 5px;
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

       .products ul {
            display: flex;
            flex-wrap: wrap;
            padding: 0;
            margin: 0;
            list-style: none;
            justify-content: flex-start;
       }

       
    </style>
</head>
<body>
    <header>
        FARMÁCIA
        <div class="header-buttons">
            <a href="index.php?acao=logoutCliente"><button>Sair</button></a>
            <a href="index.php?acao=mostrarCarrinho"><button>Carrinho</button></a>
            <a href="index.php?acao=mostrarInfoCliente&codCliente=<?php echo $codCliente ?>"><button>Minha Conta</button></a>
            <a href="index.php?acao=mostrarPedidos"><button>Pedidos</button></a>
        </div>
    </header>
    <div class="container">
        <aside class="menu">
            <ul>
                <li><a href="?acao=catalogoDeProdutos">Todos os Produtos</a></li>
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
                                <img src="view/imgs/<?= htmlspecialchars($produto['imagem']) ?>" alt="<?= htmlspecialchars($produto['nome']) ?>">
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