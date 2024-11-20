<?php 

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Estilos/categoria.css">
    <title>Document</title>
</head>
<body>

<div class="container">
       <h1>Cadastrar Categoria de Produtos</h1>
       <form action="index.php?acao=cadastrarCategoria" method="POST">
       <div class="inputs">
              <div class="input_label">
                     <label for="txtcodigoCategoria">Código da Categoria:</label>
                     <input type="number" id="txtcodigoCategoria" name="txtcodigoCategoria" value="<?php echo isset($categorias ['codigo']) ? $categorias ['codigo'] : ''; ?>" required readonly><br><br>
              </div>
       </div>
       <div class="inputs">
              <div class="input_label">
                     <label for="txtcategoria">Nome da categoria:</label>
                     <input type="text" id="txtcategoria" name="txtcategoria" value="<?php echo isset($categorias ['categoria']) ? $categorias ['categoria'] : ''; ?>" required><br><br>
              </div>
       </div>
       
       <div class="submits"><button type="submit" class="submit">Salvar </button></div>
</div>

</body>
</html>