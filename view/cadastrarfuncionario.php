<?php

include('protect.php');

protegePaginaGerente();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Funcionário</title>
</head>
<body>
    <h1>Alteração de Funcionário</h1>
    <form action="index.php?acao=cadastrarFuncionario" method="POST">
        <label for="txtcodigofuncionario">Código do Funcionário:</label>
        <input type="text" id="txtcodigofuncionario" name="txtcodigofuncionario" 
               value="<?php echo isset($funcionarios['codigo']) ? $funcionarios['codigo'] : ''; ?>" readonly><br><br>

        <label for="txtnomefuncionario">Nome:</label>
        <input type="text" id="txtnomefuncionario" name="txtnomefuncionario" 
               value="<?php echo isset($funcionarios['nome']) ? $funcionarios['nome'] : ''; ?>"><br><br>

        <label for="txtemailfuncionario">Email:</label>
        <input type="email" id="txtemailfuncionario" name="txtemailfuncionario" 
               value="<?php echo isset($funcionarios['email']) ? $funcionarios['email'] : ''; ?>"><br><br>

        <label for="txtloginfuncionario">Login:</label>
        <input type="text" id="txtloginfuncionario" name="txtloginfuncionario" 
               value="<?php echo isset($funcionarios['login']) ? $funcionarios['login'] : ''; ?>"><br><br>

        <label for="txtsenhafuncionario">Senha:</label>
        <input type="text" id="txtsenhafuncionario" name="txtsenhafuncionario" 
               value="<?php echo isset($funcionarios['senha']) ? $funcionarios['senha'] : ''; ?>"><br><br>

        <label for="txttelefonefuncionario">Telefone:</label>
        <input type="text" id="txttelefonefuncionario" name="txttelefonefuncionario" 
               value="<?php echo isset($funcionarios['telefone']) ? $funcionarios['telefone'] : ''; ?>"><br><br>
               
        <label for="txtcpffuncionario">CPF:</label>
        <input type="text" id="txtcpffuncionario" name="txtcpffuncionario" 
               value="<?php echo isset($funcionarios['cpf']) ? $funcionarios['cpf'] : ''; ?>"><br><br>
        <label for="txtcargofuncionario">cargo:</label>

        <input type="text" id="txtcargofuncionario" name="txtcargofuncionario" 
               value="<?php echo isset($funcionarios['cargo']) ? $funcionarios['cargo'] : ''; ?>"><br><br>

        <label for="generofuncionario">Gênero:</label>
        <select id="generofuncionario" name="generofuncionario" required>
            <?php 
            foreach ($generos as $gr) { 
              $selected = (isset($funcionarioData['cod_genero']) && $funcionarioData['cod_genero'] == $gr['codigo']) ? "selected" : "";
              echo "<option value='" . $gr['codigo'] . "' $selected>" .  $gr['genero'] . "</option>";
            } 
            ?>
        </select><br><br>

        <button type="submit">Salvar </button>
    </form>
</body>
</html>