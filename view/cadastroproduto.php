<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($produtoData['codigo']) ? "Alteração do Produto" : "Cadastro do Produto"; ?></title>
</head>
<body>

    <h1><?php echo isset($produtoData['codigo']) ? "Alteração do Produto" : "Cadastro do Produto"; ?></h1>

    <form action="index.php" method="POST">
        <label for="txtcodigo">Código:</label>
        <input type="text" id="txtcodigo" name="txtcodigo" value="<?php echo isset($produtoData['codigo']) ? $produtoData['codigo'] : ''; ?>" readonly required><br><br>
        
        <label for="txtproduto">Nome do Produto:</label>
        <input type="text" id="txtproduto" name="txtproduto" value="<?php echo isset($produtoData['nome']) ? $produtoData['nome'] : ''; ?>" required><br><br>
        
        <label for="txtpreco_custo">Preço Custo:</label>
        <input type="number" id="txtpreco_custo" step="0.010" name="txtpreco_custo" value="<?php echo isset($produtoData['preco_custo']) ? $produtoData['preco_custo'] : ''; ?>" required><br><br>
        
        <label for="txtprecounitario">Preço Varejo:</label>
        <input type="number" id="txtprecounitario" step="0.010" name="txtprecounitario" value="<?php echo isset($produtoData['preco']) ? $produtoData['preco'] : ''; ?>" required><br><br>
        
        <label for="txtquantidade_estoque">Quantidade Estoque:</label>
        <input type="number"  id="txtquantidade_estoque" name="txtquantidade_estoque" value="<?php echo isset($produtoData['quantidade_estoque']) ? $produtoData['quantidade_estoque'] : ''; ?>" required><br><br>
        
        <label for="txtdescricao_produto">Descrição do produto:</label>
        <input type="text" id="txtdescricao_produto" name="txtdescricao_produto" value="<?php echo isset($produtoData['descricao_produto']) ? $produtoData['descricao_produto'] : ''; ?>" required><br><br>

        Data de Fabricação: <input type="date" name="txtdatafabricacao" value="<?php echo isset($produtoData['data_f'])?$produtoData['data_f']:'' ?>" required><br><br>
        Data de Validade: <input type="date" name="txtdatavalidade" value="<?php echo isset($produtoData['data_v'])?$produtoData['data_v']:'' ?>" required><br><br>
        
        <label for="categoria_produto">Categoria:</label>
        <select id="categoria_produto" name="categoria_produto" required>
            <?php 
            foreach ($categorias as $categoria) { 
                $selected = (isset($produtoData['cod_categoria']) && $produtoData['cod_categoria'] == $categoria['codigo']) ? "selected" : "";
                echo "<option value='" . $categoria['codigo'] . "' $selected>" . $categoria['categoria'] . "</option>";
            } 
            ?>
        </select><br><br>
        
        <label for="fornecedor_produto">Fornecedor:</label>
        <select id="fornecedor_produto" name="fornecedor_produto" required>
            <?php 
            foreach ($fornecedores as $fornecedor) { 
                $selected = (isset($produtoData['cod_fornecedor']) && $produtoData['cod_fornecedor'] == $fornecedor['codigo']) ? "selected" : "";
                echo "<option value='" . $fornecedor['codigo'] . "' $selected>" . $fornecedor['nome_fantasia'] . "</option>";
            } 
            ?>
        </select><br><br>

        <label for="prescricao_produto">Contem Prescrição médica?:</label>
        <select id="prescricao_produto" name="prescricao_produto" required>
            <?php 
            foreach ($prescricao as $pr) { 
                $selected = (isset($produtoData['cod_prescricao']) && $produtoData['cod_prescricao'] == $pr['codigo']) ? "selected" : "";
                echo "<option value='" . $pr['codigo'] . "' $selected>" .  $pr['prescricao'] . "</option>";
            } 
            ?>
        </select><br><br>

        <input type="hidden" name="acao" value="<?php echo isset($produtoData['codigo']) ? "alterar" : "cadastrar"; ?>">
        <input type="submit" value="<?php echo isset($produtoData['codigo']) ? "Alterar Produto" : "Cadastrar Produto"; ?>">
    </form>

</body>
</html>