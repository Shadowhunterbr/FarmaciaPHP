<?php

include('view/protect.php');

protegePaginaGerente();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="view\Estilos\listaFuncionarios.css">
    <title>Lista de Funcionarios</title>
</head>
<body>
    <h1 class="titulo1">Lista de Funcionarios</h1>

   <!-- <a href="index.php?acao=cadastrarFuncionario"></a> -->
    <a href="index.php?acao=listarProdutos"><button class="btnProdutos">Produtos</button></a>
    <a href="index.php?acao=paginacadastrarfuncionario"><button class="btnCadastrarFuncionario">Cadastrar funcionario</button></a>
    <a href="index.php?acao=logout"><button class="btnSair">Sair</button></a><br><br>
    
    
  <style>  
.hidetext { -webkit-text-security: disc; /* Default */ }
</style> 
   <table border="5%" style="width: 70%; border-color:rgb(149, 149, 234);">
        <tr style="color: white;background-color: #760d0d;">
            <th>Codigo</th>
            <th>Nome</th>
            <th>email</th>
            <th>login</th>
            <th>senha</th>
            <th>telefone</th>
            <th>CPF</th>
            <th>cargo</th>
            <th colspan="2">ação</th>
        </tr>
        <?php foreach($funcionarios as $funcionario): ?>
        <tr>
            <td><?php echo $funcionario['codigo'] ?></td>
            <td><?php echo $funcionario['nome'] ?></td>
            <td><?php echo $funcionario['email'] ?></td>
            <td><?php echo $funcionario['login'] ?></td>
            <td class="hidetext"><?php echo $funcionario['senha'] ?></td>
            <td><?php echo $funcionario['telefone'] ?></td>
            <td><?php echo $funcionario['cpf'] ?></td>
            <td><?php echo $funcionario['cargo'] ?></td>

            <td><a href="index.php?acao=excluirFuncionario&codigo=<?php echo $funcionario['codigo'] ?>">EXCLUIR</a></td>
            <td><a href="index.php?acao=paginaalterarfuncionario&codigo=<?php echo $funcionario['codigo']; ?>">ALTERAR</a></td>

        </tr>
        <?php endforeach; ?>   
    </table>
    
</body>
</html>