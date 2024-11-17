<?php

include('protect.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Cadastrar Categoria de produtos</h1>
<form action="index.php?acao=cadastrarCategoria" method="POST">
        <label for="txtcodigoCategoria">Código da Categoria:</label>
        <input type="number" id="txtcodigoCategoria" name="txtcodigoCategoria" 
               value="<?php echo isset($categorias ['codigo']) ? $categorias ['codigo'] : ''; ?>" required><br><br>

        <label for="txtcategoria">Nome da categoria:</label>
        <input type="text" id="txtcategoria" name="txtcategoria" 
               value="<?php echo isset($categorias ['categoria']) ? $categorias ['categoria'] : ''; ?>" required><br><br>

               <button type="submit">Salvar </button>
</body>
</html>