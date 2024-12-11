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
    <title><?php echo isset($fornecedor['codigo']) ? "Alteração de Fornecedor" : "Cadastro de Fornecedor"; ?></title>
</head>
<body>
    <div class="container">
        <h1><?php echo isset($fornecedor['codigo']) ? "Alteração de Fornecedor" : "Cadastro de Fornecedor"; ?></h1>
        <form action="index.php?acao=<?php echo isset($fornecedor['codigo']) ? 'alterarFornecedor' : 'cadastrarFornecedor'; ?>" method="POST">
            <div class="inputs">
                <div class="input_label">
                    <label for="txtcodigofornecedor">Código do Fornecedor:</label>
                    <input type="text" id="txtcodigofornecedor" name="txtcodigofornecedor"
                           value="<?php echo isset($fornecedor['codigo']) ? $fornecedor['codigo'] : ''; ?>" readonly><br><br>
                </div>
            </div>
            <div class="inputs">
                <div class="input_label">
                    <label for="txtrazaoSocial">Razão Social:</label>
                    <input type="text" id="txtrazaoSocial" name="txtrazaoSocial"
                           value="<?php echo isset($fornecedor['razao_social']) ? $fornecedor['razao_social'] : ''; ?>"><br><br>
                </div>
            </div>
            <div class="inputs">
                <div class="input_label">
                    <label for="txtnomeFantasia">Nome Fantasia:</label>
                    <input type="text" id="txtnomeFantasia" name="txtnomeFantasia"
                           value="<?php echo isset($fornecedor['nome_fantasia']) ? $fornecedor['nome_fantasia'] : ''; ?>"><br><br>
                </div>
            </div>
            <div class="inputs">
                <div class="input_label">
                    <label for="txtcnpj">CNPJ:</label>
                    <input type="text" id="txtcnpj" name="txtcnpj"
                           value="<?php echo isset($fornecedor['cnpj']) ? $fornecedor['cnpj'] : ''; ?>"><br><br>
                </div>
            </div>
            <div class="inputs">
                <div class="input_label">
                    <label for="txtendereco">Endereço:</label>
                    <input type="text" id="txtendereco" name="txtendereco"
                           value="<?php echo isset($fornecedor['endereco']) ? $fornecedor['endereco'] : ''; ?>"><br><br>
                </div>
            </div>
            <div class="inputs">
                <div class="input_label">
                    <label for="txtcidade">Cidade:</label>
                    <input type="text" id="txtcidade" name="txtcidade"
                           value="<?php echo isset($fornecedor['cidade']) ? $fornecedor['cidade'] : ''; ?>"><br><br>
                </div>
            </div>
            <div class="inputs">
                <div class="input_label">
                    <label for="txtcep">CEP:</label>
                    <input type="text" id="txtcep" name="txtcep"
                           value="<?php echo isset($fornecedor['cep']) ? $fornecedor['cep'] : ''; ?>"><br><br>
                </div>
            </div>
            <div class="inputs">
                <div class="input_label">
                    <label for="txtpessoaContato">Pessoa de Contato:</label>
                    <input type="text" id="txtpessoaContato" name="txtpessoaContato"
                           value="<?php echo isset($fornecedor['pessoa_contato']) ? $fornecedor['pessoa_contato'] : ''; ?>"><br><br>
                </div>
            </div>
            <div class="inputs">
                <div class="input_label">
                    <label for="txttelefone">Telefone:</label>
                    <input type="text" id="txttelefone" name="txttelefone"
                           value="<?php echo isset($fornecedor['telefone']) ? $fornecedor['telefone'] : ''; ?>"><br><br>
                </div>
            </div>
            <div class="submits">
                <input type="hidden" name="acao" value="<?php echo isset($fornecedor['codigo']) ? "alterarFornecedor" : "cadastrarFornecedor"; ?>">
                <button type="submit" class="submit">
                    <?php echo isset($fornecedor['codigo']) ? "Alterar Fornecedor" : "Cadastrar Fornecedor"; ?>
                </button>
            </div>
        </form>
    </div>
</body>
</html>