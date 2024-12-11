<?php
include('protect.php');
protegePaginaGerente();
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="view\Estilos\listaFuncionarios.css">
    <title>Lista de Fornecedores</title>
</head>
<body>
    <h1 class="titulo1">Lista de Fornecedores</h1>

    <a href="index.php?acao=listarProdutos"><button class="btnProdutos">Produtos</button></a>
    <a href="index.php?acao=paginaCadastrarFornecedor"><button class="btnCadastrarFuncionario">Cadastrar Fornecedor</button></a>
    <a href="index.php?acao=logout"><button class="btnSair">Sair</button></a><br><br>

    <table border="5%" style="width: 70%; border-color:rgb(149, 149, 234);">
        <tr style="color: white;background-color: #760d0d;">
            <th>Código</th>
            <th>Razão Social</th>
            <th>Nome Fantasia</th>
            <th>CNPJ</th>
            <th>Endereço</th>
            <th>Cidade</th>
            <th>CEP</th>
            <th>Pessoa de Contato</th>
            <th>Telefone</th>
            <th colspan="2">Ação</th>
        </tr>
        <?php foreach($fornecedores as $fornecedor): ?>
        <tr>
            <td><?php echo $fornecedor['codigo'] ?></td>
            <td><?php echo $fornecedor['razao_social'] ?></td>
            <td><?php echo $fornecedor['nome_fantasia'] ?></td>
            <td><?php echo $fornecedor['cnpj'] ?></td>
            <td><?php echo $fornecedor['endereco'] ?></td>
            <td><?php echo $fornecedor['cidade'] ?></td>
            <td><?php echo $fornecedor['cep'] ?></td>
            <td><?php echo $fornecedor['pessoa_contato'] ?></td>
            <td><?php echo $fornecedor['telefone'] ?></td>

            <td><a href="index.php?acao=excluirFornecedor&codigo=<?php echo $fornecedor['codigo'] ?>" onclick="return confirm('Tem certeza que deseja excluir este fornecedor?');">EXCLUIR</a></td>
            <td><a href="index.php?acao=paginaalterarfornecedor&codigo=<?php echo $fornecedor['codigo']; ?>">ALTERAR</a></td>

        </tr>
        <?php endforeach; ?>   
    </table>
</body>
</html>