<?php

include('view/protect.php');

protegePaginaGerente();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="view\Estilos\cadastrarFuncionario.css">
    <title><?php echo isset($funcionarios['codigo']) ? "Alteração de Funcionário" : "Cadastro de Funcionário"; ?></title>
</head>
<body>
    <div class="container">
        <h1><?php echo isset($funcionarios['codigo']) ? "Alteração de Funcionário" : "Cadastro de Funcionário"; ?></h1>
        <form action="index.php?acao=<?php echo isset($funcionarios['codigo']) ? 'alterarFuncionario' : 'cadastrarFuncionario'; ?>" method="POST">
            <div class="inputs">
                <div class="input_label">
                    <label for="txtcodigofuncionario">Código do Funcionário:</label>
                    <input type="text" id="txtcodigofuncionario" name="txtcodigofuncionario"
                           value="<?php echo isset($funcionarios['codigo']) ? $funcionarios['codigo'] : ''; ?>" readonly><br><br>
                </div>
            </div>
            <div class="inputs">
                <div class="input_label">
                    <label for="txtnomefuncionario">Nome:</label>
                    <input type="text" id="txtnomefuncionario" name="txtnomefuncionario"
                           value="<?php echo isset($funcionarios['nome']) ? $funcionarios['nome'] : ''; ?>"><br><br>
                </div>
            </div>
            <div class="inputs">
                <div class="input_label">
                    <label for="txtemailfuncionario">Email:</label>
                    <input type="email" id="txtemailfuncionario" name="txtemailfuncionario"
                           value="<?php echo isset($funcionarios['email']) ? $funcionarios['email'] : ''; ?>"><br><br>
                </div>
            </div>
            <div class="inputs">
                <div class="input_label">
                    <label for="txtloginfuncionario">Login:</label>
                    <input type="text" id="txtloginfuncionario" name="txtloginfuncionario"
                           value="<?php echo isset($funcionarios['login']) ? $funcionarios['login'] : ''; ?>"><br><br>
                </div>
            </div>
            <div class="inputs">
                <div class="input_label">
                    <label for="txtsenhafuncionario">Senha:</label>
                    <input type="password" id="txtsenhafuncionario" name="txtsenhafuncionario"
                           value="<?php echo isset($funcionarios['senha']) ? $funcionarios['senha'] : ''; ?>"><br><br>
                </div>
            </div>
            <div class="inputs">
                <div class="input_label">
                    <label for="txttelefonefuncionario">Telefone:</label>
                    <input type="text" id="txttelefonefuncionario" name="txttelefonefuncionario"
                           value="<?php echo isset($funcionarios['telefone']) ? $funcionarios['telefone'] : ''; ?>"><br><br>
                </div>
            </div>
            <div class="inputs">
                <div class="input_label">
                    <label for="txtcpffuncionario">CPF:</label>
                    <input type="text" id="txtcpffuncionario" name="txtcpffuncionario"
                           value="<?php echo isset($funcionarios['cpf']) ? $funcionarios['cpf'] : ''; ?>"><br><br>
                </div>
            </div>
            <div class="inputs">
                <div class="input_label">
                    <label for="txtcargofuncionario">Cargo:</label>
                    <input type="text" id="txtcargofuncionario" name="txtcargofuncionario"
                           value="<?php echo isset($funcionarios['cargo']) ? $funcionarios['cargo'] : ''; ?>"><br><br>
                </div>
            </div>
            <div class="inputs">
                <div class="input_label">
                    <label for="generofuncionario">Gênero:</label>
                    <select id="generofuncionario" name="generofuncionario" required>
                        <?php
                        foreach ($generos as $gr) {
                            $selected = (isset($funcionarios['cod_genero']) && $funcionarios['cod_genero'] == $gr['codigo']) ? "selected" : "";
                            echo "<option value='" . $gr['codigo'] . "' $selected>" . $gr['genero'] . "</option>";
                        }
                        ?>
                    </select><br><br>
                </div>
            </div>
            <div class="submits">
                <input type="hidden" name="acao" value="<?php echo isset($funcionarios['codigo']) ? "alterarFuncionario" : "cadastrarFuncionario"; ?>">
                <button type="submit" class="submit">
                    <?php echo isset($funcionarios['codigo']) ? "Alterar Funcionário" : "Cadastrar Funcionário"; ?>
                </button>
            </div>
        </form>
        </div>
</body>
</html>