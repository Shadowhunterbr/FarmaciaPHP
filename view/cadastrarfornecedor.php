<?php


?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Fornecedor</title>
</head>
<body>
    <h1>Alteração de Fornecedor</h1>
    <form action="index.php?acao=cadastrarFornecedor" method="POST">
        <label for="txtcodigofornecedor">Código do Fornecedor:</label>
        <input type="text" id="txtcodigofornecedor" name="txtcodigofornecedor" 
               value="<?php echo isset($fornecedor['codigo']) ? $fornecedor['codigo'] : ''; ?>" readonly><br><br>

        <label for="txtrazaoSocial">Razão Social:</label>
        <input type="text" id="txtrazaoSocial" name="txtrazaoSocial" 
               value="<?php echo isset($fornecedor['razao_social']) ? $fornecedor['razao_social'] : ''; ?>"><br><br>

        <label for="txtnomeFantasia">Nome Fantasia:</label>
        <input type="text" id="txtnomeFantasia" name="txtnomeFantasia" 
               value="<?php echo isset($fornecedor['nome_fantasia']) ? $fornecedor['nome_fantasia'] : ''; ?>"><br><br>

        <label for="txtcnpj">CNPJ:</label>
        <input type="text" id="txtcnpj" name="txtcnpj" 
               value="<?php echo isset($fornecedor['cnpj']) ? $fornecedor['cnpj'] : ''; ?>"><br><br>

        <label for="txtendereco">Endereço:</label>
        <input type="text" id="txtendereco" name="txtendereco" 
               value="<?php echo isset($fornecedor['endereco']) ? $fornecedor['endereco'] : ''; ?>"><br><br>

        <label for="txtcidade">Cidade:</label>
        <input type="text" id="txtcidade" name="txtcidade" 
               value="<?php echo isset($fornecedor['cidade']) ? $fornecedor['cidade'] : ''; ?>"><br><br>

        <label for="txtcep">CEP:</label>
        <input type="text" id="txtcep" name="txtcep" 
               value="<?php echo isset($fornecedor['cep']) ? $fornecedor['cep'] : ''; ?>"><br><br>

        <label for="txtpessoaContato">Pessoa de Contato:</label>
        <input type="text" id="txtpessoaContato" name="txtpessoaContato" 
               value="<?php echo isset($fornecedor['pessoa_contato']) ? $fornecedor['pessoa_contato'] : ''; ?>"><br><br>

        <label for="txttelefone">Telefone:</label>
        <input type="text" id="txttelefone" name="txttelefone" 
               value="<?php echo isset($fornecedor['telefone']) ? $fornecedor['telefone'] : ''; ?>"><br><br>

        <button type="submit">Salvar</button>
    </form>
</body>
</html>