<?php

include('view/protect.php');

protegePagina()

?>
<style>

</style>
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
    <a href="index.php?acao=listarFuncionarios"><button class="btnListarFuncionarios">Funcionarios</button></a> 
    <a href="index.php?acao=listarFornecedores"><button class="btnListarFuncionarios">Fornecedores</button></a> <br><br>

    <a href="index.php?acao=logout"><button class="btnSair">Sair</button></a>
    <br><br>
   
    <table border="5%" style="width: 70%; border-color:rgb(149, 149, 234);">
    <tr style="color: white;background-color: #760d0d;">
        <th>Total Preço Custo</th>   
        <th>Total Vendas</th>
        <Th>Lucro Liquido</Th>
        <th>Pedidos Concluidos</th>
    </tr>
    <tr>
        <td><?php echo  number_format($totalPrecoCusto, 2, ',', '.');?></td>
        <td><?php echo number_format($totalVendas, 2, ',', '.'); ?></td>
        <td><?php echo number_format($totalLiquido, 2, ',','.'); ?></td>
        <td><?php echo ($quantPedidos [0]["COUNT(*)"]); ?></td>
    </tr>
    </table>

    <table border="5%" style="width: 70%; border-color:rgb(149, 149, 234);">

        <tr style="color: white;background-color: #760d0d; ">
            <th>Código</th>
            <th>*</th>
            <th>Nome do Produto</th>
            <th>Preço custo</th>
            <th>Preço Varejo</th>
            <th>QT estoque</th>
            <th>Categoria</th>
            <th>Fornecedor</th>
            <th>Receita?</th>
            <th>Data de Fabricação</th>
            <th>Data de Validade</th>
           
            <th colspan="3">Ação</th>
        </tr>
        <?php foreach($produtos as $produto): ?>
            <tr style="text-align: center;">
                <td><?php echo $produto['codigo'] ?></td>
                <td class="product"><img src="view/imgs/<?= htmlspecialchars($produto['imagem']) ?>" alt="<?= htmlspecialchars($produto['nome']) ?>"></td>
                <td><?php echo $produto['nome'] ?></td>
                
                <td><?php echo number_format($produto['preco_custo'],2,',','.'); ?></td>
                <td><?php echo number_format($produto['preco'],2,',','.'); ?></td>
                <td><?php echo $produto['quantidade_estoque'] ?></td>
                <td><?php  foreach($categorias as $ct){
                if (isset($produto['cod_categoria']) && $produto['cod_categoria'] == $ct['codigo']) {
                    echo $ct['categoria']; 
                }
            }?></td>
              
                <td><?php foreach($fornecedores as $fr){
                 if (isset($produto['cod_fornecedor']) && $produto['cod_fornecedor'] == $fr['codigo']) {
                echo $fr['nome_fantasia'];
            }
                }?></td>
                <td>
                <?php  foreach($prescricao as $rc){
                if (isset($produto['cod_prescricao']) && $produto['cod_prescricao'] == $rc['codigo']) {
                    echo $rc['prescricao']; 
                }
            }?>
                </td>
                 
                
                <td><?php 
                    $data_F = new DateTime($produto['data_F']);
                    echo date_format($data_F, "d/m/Y"); 
                    ?>
                </td>
                <td><?php 
                    $data_V = new DateTime($produto['data_V']);
                    echo date_format($data_V, "d/m/Y"); 
                    ?>
                </td>
                <td><a href="index.php?acao=paginaalterar&codigo=<?php echo $produto['codigo'] ?>" class="alterar"><i class="fa-regular fa-pen-to-square"></i>ALTERAR</a></td>

                        <td>
            <?= $produto['status'] == 1 ? 'Ativo' : 'Inativo' ?><br>
            <a 
                href="index.php?acao=alterarStatus&codigo=<?= $produto['codigo'] ?>&status=<?= $produto['status'] == 1 ? 0 : 1 ?>" 
                class="<?= $produto['status'] == 1 ? 'inativar' : 'ativar' ?>" 
                onclick="return confirm('Tem certeza que deseja <?= $produto['status'] == 1 ? 'inativar' : 'ativar' ?> este produto?');">
                <?= $produto['status'] == 1 ? 'Inativar' : 'Ativar' ?>
            </a>
        </td>

                <td><a href="index.php?acao=excluir&codigo=<?php echo $produto['codigo'] ?>" class="excluir" onclick="return confirm('Tem certeza que deseja excluir este Produto?');">EXCLUIR</a></td>
            </tr>
        <?php endforeach; ?>
    </table> <br>
  

</body>
</html>