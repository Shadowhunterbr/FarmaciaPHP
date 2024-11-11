<?php



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Funcionarios</title>
</head>
<body>
    <h1>Lista de funcionario</h1>

   <!-- <a href="index.php?acao=cadastrarFuncionario"></a> -->
    <a href="index.php?acao=listarProdutos"><button>Produtos</button></a>
    <a href="index.php?acao=logout"><button>Logout</button></a><br><br>
  <style>  
.hidetext { -webkit-text-security: disc; /* Default */ }
</style> 
   <table border="1" style="width: 70%;">
        <tr style="color: white;background-color: black;">
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
        </tr>
        <?php endforeach; ?>   
    </table>
    
</body>
</html>