<?php

include('protect.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

 
    

    <link rel="stylesheet" href="view\Estilos\listadeProdutos.css">
    <title class="titulo">Lista de Produtos</title>

</head>
<body>

    <h1 class="titulo1">Lista de Produtos</h1>

    <a href="index.php?acao=paginacadastrar"><button class="btnCadastrarProd">Cadastrar Produtos</button></a>
    <a href="index.php?acao=paginacadastrarcategoria"><button class="btnCadastrarCategoria">Cadastrar Categorias</button></a>
    <a href="index.php?acao=paginaCadastrarFornecedor"><button class="btnCadastrarFornecedor">Cadastrar Fornecedores</button></a> <br><br>
    <a href="index.php?acao=listarFuncionarios"><button class="btnListarFuncionarios">Funcionarios</button></a> <br><br>
    <a href="index.php?acao=logout"><button class="btnSair">Sair</button></a>
    <br><br>
    <table border="5%" style="width: 70%; border-color:rgb(149, 149, 234);">
    <tr style="color: white;background-color: #760d0d;">
        <th>Total Preço Custo</th>   
        <th>Total Vendas</th>
        
    </tr>
    <tr>
        <td><?php echo  number_format($totalPrecoCusto, 2, ',', '.');?></td>
        <td><?php echo number_format($totalVendas, 2, ',', '.'); ?></td>
    </tr>
    </table>

    <table border="5%" style="width: 70%; border-color:rgb(149, 149, 234);">

        <tr style="color: white;background-color: #760d0d;">
            <th>Código</th>
            <th>Produto</th>
            <th>Preço custo</th>
            <th>Preço Varejo</th>
            <th>QT estoque</th>
            <th>data de Fabricação</th>
            <th>data de Validade</th>
            <th></th>
            <th colspan="2">Ação</th>
        </tr>
        <?php foreach($produtos as $produto): ?>
            <tr>
                <td><?php echo $produto['codigo'] ?></td>
                <td><?php echo $produto['nome'] ?></td>
                <td><?php echo number_format($produto['preco_custo'],2,',','.'); ?></td>
                <td><?php echo number_format($produto['preco'],2,',','.'); ?></td>
                <td><?php echo $produto['quantidade_estoque'] ?></td>
                <td><?php 
                    $data_F = new DateTime($produto['data_f']);
                    echo date_format($data_F, "d/m/Y"); 
                    ?>
                </td>
                <td><?php 
                    $data_V = new DateTime($produto['data_V']);
                    echo date_format($data_V, "d/m/Y"); 
                    ?>
                </td>
                <td><a href="index.php?acao=paginaalterar&codigo=<?php echo $produto['codigo'] ?>" class="alterar"><i class="fa-regular fa-pen-to-square"></i>ALTERAR</a></td>
                <td><a href="index.php?acao=excluir&codigo=<?php echo $produto['codigo'] ?>" class="excluir">EXCLUIR</a></td>
            </tr>
        <?php endforeach; ?>
    </table> <br>
  

</body>
</html>