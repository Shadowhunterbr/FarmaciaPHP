<?php
include('view/protect.php');
?>

<style>

</style>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="view\Estilos\carrinho.css">
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
            </div>
        <?php else: ?>
            <div class="table">
                <table border="1">
                    <thead>
                        <tr class="tituloLista">
                            <th>*</th>
                            <th>Produto</th>
                            <th>Preço Unitário</th>
                            <th>Quantidade</th>
                            <th>Contem Receita?</th>
                            <th>Subtotal</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($produtos as $produto): ?>
                            <tr>
                            <td>
            <?php if (!empty($produto['imagem'])): ?>
                <img src="view/imgs/<?= htmlspecialchars($produto['imagem']) ?>" >
            <?php else: ?>
                Sem imagem
            <?php endif; ?>
                            </td>
                <td><?= ($produto['nome']) ?></td>
                        <td>R$ <?= number_format($produto['preco'], 2, ',', '.') ?></td>
                        <td><?= $produto['quantidade'] ?></td>
                        <td>
                        <?php
                        $prescricaoExibida = "Não contém prescrição"; 
                        if (isset($produto['cod_prescricao'])) { 
                            foreach ($prescricao as $rc) {
                                if ($produto['cod_prescricao'] == $rc['codigo']) {
                                    $prescricaoExibida = htmlspecialchars($rc['prescricao']); 
                                    break; 
                                }
                            }
                        }
                        echo $prescricaoExibida; 
                        ?>
                    </td>
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
            <form action="?acao=finalizarPedido" method="POST" enctype="multipart/form-data">
            <div class="containerButton">
            <div class="catalogoProduto">
                 <br>
                 <div class="inputs">
                 <div class="total">Total: R$ <?php echo($total); ?><br></div>
                 <div class="input_label">
   
    <label for="imagem">Selecione a imagem da receita médica:</label>
    <input type="file" name="imagem" id="imagem" >
    <br>
    <div class="containerButton">
    <br>
    <br>
    <div class="submit_button">
    <button type="submit">Finalizar Pedido</button>
</div>
 
    </div>
</form>


    </div>
</div>
            </div>
            </div>
            <div class="containerButton">
        <div class="catalogoProduto">
        <a href="?acao=catalogoDeProdutos">Continuar Comprando</a>
         </div>
         </div>
    
    <?php endif; ?>

 

</body>


</html>