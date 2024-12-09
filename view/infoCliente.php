<?php 


?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alteração de Cliente e Endereço</title>
</head>
<body>
<a href="?acao=catalogoDeProdutos"><Button>Catalago de Produtos</Button></a>
    <h1>Alteração de Cliente</h1>
    <form action="index.php?acao=alterarCliente" method="POST">
        <label for="txtnome">Nome:</label>
        <input type="text" id="txtnome" name="txtnome" 
               value="<?php echo isset($cliente['nome']) ? $cliente['nome'] : ''; ?>"><br><br>

        <label for="txtemail">E-mail:</label>
        <input type="email" id="txtemail" name="txtemail" 
               value="<?php echo isset($cliente['email']) ? $cliente['email'] : ''; ?>" readonly><br><br>

        <label for="txtsenha">Senha:</label>
        <input type="password" id="txtsenha" name="txtsenha" 
               value="<?php echo isset($cliente['senha']) ? $cliente['senha'] : ''; ?>"><br><br>

        <label for="txttelefone">Telefone:</label>
        <input type="text" id="txttelefone" name="txttelefone" 
               value="<?php echo isset($cliente['telefone']) ? $cliente['telefone'] : ''; ?>"><br><br>

        <label for="txtcpf">CPF:</label>
        <input type="text" id="txtcpf" name="txtcpf" 
               value="<?php echo isset($cliente['cpf']) ? $cliente['cpf'] : ''; ?>" readonly><br><br>

        <label for="txtcodGenero">Gênero:</label>
        <select id="txtcodGenero" name="txtcodGenero">
        <?php 
            foreach ($generos as $gr) { 
                $selected = (isset($cliente['cod_genero']) && $cliente['cod_genero'] == $gr['codigo']) ? "selected" : "";
                echo "<option value='" . $gr['codigo'] . "' $selected>" . $gr['genero'] . "</option>";
            }
        ?>
    </select>
        </select><br><br>

        <label for="txtdataNascimento">Data de Nascimento:</label>
        <input type="date" id="txtdataNascimento" name="txtdataNascimento" 
               value="<?php echo isset($cliente['data_nascimento']) ? $cliente['data_nascimento'] : ''; ?>"><br><br>

        <button type="submit">Salvar Cliente</button>
    </form>

    <hr>

    <h1>Alteração de Endereço</h1>
    <form action="index.php?acao=alterarEndereco" method="POST">
        <label for="txtcodigoEndereco">Código do Endereço:</label>
        <input type="text" id="txtcodigoEndereco" name="txtcodigoEndereco" 
               value="<?php echo isset($endereco['codigo']) ? $endereco['codigo'] : ''; ?>" readonly><br><br>

        <label for="txtrua">Rua:</label>
        <input type="text" id="txtrua" name="txtrua" maxlength="50"
               value="<?php echo isset($endereco['rua']) ? $endereco['rua'] : ''; ?>"><br><br>

        <label for="txtnumero">Número:</label>
        <input type="number" id="txtnumero" name="txtnumero" 
               value="<?php echo isset($endereco['numero']) ? $endereco['numero'] : ''; ?>" required><br><br>

        <label for="txtbairro">Bairro:</label>
        <input type="text" id="txtbairro" name="txtbairro" maxlength="50"
               value="<?php echo isset($endereco['bairro']) ? $endereco['bairro'] : ''; ?>"><br><br>

        <label for="txtcidade">Cidade:</label>
        <input type="text" id="txtcidade" name="txtcidade"  maxlength="50"
               value="<?php echo isset($endereco['cidade']) ? $endereco['cidade'] : ''; ?>"><br><br>

        <label for="txtcep">CEP:</label>
        <input type="text" id="txtcep" name="txtcep"  maxlength="9"
               value="<?php echo isset($endereco['cep']) ? $endereco['cep'] : ''; ?>"><br><br>

        <label for="txtuf">UF:</label>
        <input type="text" id="txtuf" name="txtuf" maxlength="2" 
               value="<?php echo isset($endereco['UF']) ? $endereco['UF'] : ''; ?>"><br><br>

        <button type="submit">Salvar Endereço</button>
    </form>
</body>
</html>