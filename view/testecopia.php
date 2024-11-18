<?php
/*
include('protect.php');




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($produtoData['codigo']) ? "Alteração do Produto" : "Cadastro do Produto"; ?></title>
</head>
<body>

    <h1><?php echo isset($produtoData['codigo']) ? "Alteração do Produto" : "Cadastro do Produto"; ?></h1>

    <form action="index.php" method="POST">
        <label for="txtcodigo">Código:</label>
        <input type="text" id="txtcodigo" name="txtcodigo" value="<?php echo isset($produtoData['codigo']) ? $produtoData['codigo'] : ''; ?>" readonly required><br><br>
        
        <label for="txtproduto">Nome do Produto:</label>
        <input type="text" id="txtproduto" name="txtproduto" value="<?php echo isset($produtoData['nome']) ? $produtoData['nome'] : ''; ?>" required><br><br>
        
        <label for="txtpreco_custo">Preço Custo:</label>
        <input type="number" id="txtpreco_custo" step="0.010" name="txtpreco_custo" value="<?php echo isset($produtoData['preco_custo']) ? $produtoData['preco_custo'] : ''; ?>" required><br><br>
        
        <label for="txtprecounitario">Preço Varejo:</label>
        <input type="number" id="txtprecounitario" step="0.010" name="txtprecounitario" value="<?php echo isset($produtoData['preco']) ? $produtoData['preco'] : ''; ?>" required><br><br>
        
        <label for="txtquantidade_estoque">Quantidade Estoque:</label>  
        <input type="number"  id="txtquantidade_estoque" name="txtquantidade_estoque" value="<?php echo isset($produtoData['quantidade_estoque']) ? $produtoData['quantidade_estoque'] : ''; ?>" required><br><br>
        
        <label for="txtdescricao_produto">Descrição do produto:</label>
        <input type="text" id="txtdescricao_produto" name="txtdescricao_produto" value="<?php echo isset($produtoData['descricao_produto']) ? $produtoData['descricao_produto'] : ''; ?>" required><br><br>

        <label for="txtdatafabricacao"> Data de Fabricação: </label> 
        <input type="date" name="txtdatafabricacao" value="<?php echo isset($produtoData['data_f'])?$produtoData['data_f']:'' ?>" required><br><br>
        
        <label for="txtdatavalidade"> Data de Validade: </label>
        <input type="date" name="txtdatavalidade" value="<?php echo isset($produtoData['data_V'])?$produtoData['data_V']:'' ?>" required><br><br>
        
        <label for="categoria_produto">Categoria:</label>
        <select id="categoria_produto" name="categoria_produto" required>
            <?php 
            foreach ($categorias as $categoria) { 
                $selected = (isset($produtoData['cod_categoria']) && $produtoData['cod_categoria'] == $categoria['codigo']) ? "selected" : "";
                echo "<option value='" . $categoria['codigo'] . "' $selected>" . $categoria['categoria'] . "</option>";
            } 
            ?>
        </select><br><br>
        
        <label for="fornecedor_produto">Fornecedor:</label>
        <select id="fornecedor_produto" name="fornecedor_produto" required>
            <?php 
            foreach ($fornecedores as $fornecedor) { 
                $selected = (isset($produtoData['cod_fornecedor']) && $produtoData['cod_fornecedor'] == $fornecedor['codigo']) ? "selected" : "";
                echo "<option value='" . $fornecedor['codigo'] . "' $selected>" . $fornecedor['nome_fantasia'] . "</option>";
            } 
            ?>
        </select><br><br>

        <label for="prescricao_produto">Contem Prescrição médica?:</label>
        <select id="prescricao_produto" name="prescricao_produto" required>
            <?php 
            foreach ($prescricao as $pr) { 
                $selected = (isset($produtoData['cod_prescricao']) && $produtoData['cod_prescricao'] == $pr['codigo']) ? "selected" : "";
                echo "<option value='" . $pr['codigo'] . "' $selected>" .  $pr['prescricao'] . "</option>";
            } 
            ?>
        </select><br><br>

        <input type="hidden" name="acao" value="<?php echo isset($produtoData['codigo']) ? "alterar" : "cadastrar"; ?>">
        <input type="submit" value="<?php echo isset($produtoData['codigo']) ? "Alterar Produto" : "Cadastrar Produto"; ?>">
    </form>

</body>
</html>

<?php

if (!isset($_SESSION['funcionarioAutenticado'])) {
    // Redireciona para a página de login se não estiver autenticado
    header("Location: C:\xampp\htdocs\php2\view\loginFuncionario.php");
    exit;
}

// Processa a ação solicitada na URL ou formulário
if (isset($_GET['acao']) && $_GET['acao'] === 'paginacadastrar') {
    $controller->mostrarPaginaCadastro();
} elseif (isset($_POST['acao']) && $_POST['acao'] === 'cadastrar') {
    $controller->cadastrar();
} elseif (isset($_GET['acao']) && $_GET['acao'] === 'excluir') {
    $controller->excluir();
} elseif (isset($_GET['acao']) && $_GET['acao'] === 'paginaalterar') {
    $controller->mostrarPaginaAlterar();
} elseif (isset($_POST['acao']) && $_POST['acao'] === 'alterar') {
    $controller->alterar();
} elseif (isset($_GET['acao']) && $_GET['acao'] === 'logout') {
    // Finaliza a sessão e redireciona para a página de login
    session_unset();
    session_destroy();
    header("Location: C:\xampp\htdocs\php2\view\loginFuncionario.php");
    exit;
} else {
    $controller->listarProdutos();
}

session_start();
if (isset($_POST['acao']) && $_POST['acao'] === 'login') {
    $login = $_POST['txtloginfuncionario'];
    $senha = $_POST['txtsenhafuncionario'];

    // Conexão com o banco de dados
	$pdo = Conexao::obterConexao();    
    // Consulta usando consulta preparada para evitar injeção de SQL
    $stmt = $pdo->prepare("SELECT * FROM funcionario WHERE login = :login ");
    $stmt->bindParam(':login', $login);
    $stmt->execute();
    $funcionario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($funcionario && password_verify($senha, $funcionario['senha'])) {
        // Senha está correta, inicia a sessão do usuário
        $_SESSION['codigo'] = $funcionario['codigo'];
        $_SESSION['nome'] = $funcionario['nome'];
        
        header("Location: C:/xampp/htdocs/php2\view\index.php");
        exit;
    } else {
        // Login ou senha inválidos
        echo "Login ou senha incorretos.";
		var_dump($login, $senha);
    }
}<div class="search-container">
<h1>Buscar Produto</h1>
<form action="" method="GET" onsubmit="return validateSearch()">
    <input type="text" name="search" id="search" placeholder="Digite o nome do produto" aria-label="Campo de busca">
    <button type="submit">Pesquisar</button>
</form>
</div>

<div class="results">
<?php
// Inclui a classe Conexao
require_once __DIR__ . '/../model/Conexao.php';

// Conecta ao banco de dados
$conn = Conexao::obterConexao();

// Verifica se há uma pesquisa e se o campo não está vazio
if (isset($_GET['search']) && !empty(trim($_GET['search']))) {
    $search = $_GET['search'];
    $sql = "SELECT * FROM produtos WHERE nome LIKE :search";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
} else {
    // Se o campo de pesquisa estiver vazio, busca todos os produtos
    $sql = "SELECT * FROM produtos";
    $stmt = $conn->prepare($sql);
}

// Executa a consulta
$stmt->execute();
?>

<table border="1" style="width: 70%;">
    <tr style="color: white;background-color: black;">
        <th>Código</th>
        <th>Produto</th>
        <th>Preço Custo</th>
        <th>Preço Varejo</th>
        <th>Quantidade em Estoque</th>
        <th>Data de Fabricação</th>
        <th>Data de Validade</th>
        <th colspan="2">Ação</th>
    </tr>

    <?php
    // Verifica se há resultados na consulta
    if ($stmt->rowCount() > 0) {
        // Itera sobre os resultados e preenche a tabela
        while ($produto = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
            <tr>
                <td><?php echo htmlspecialchars($produto['codigo']); ?></td>
                <td><?php echo htmlspecialchars($produto['nome']); ?></td>
                <td><?php echo number_format($produto['preco_custo'], 2, ',', '.'); ?></td>
                <td><?php echo number_format($produto['preco'], 2, ',', '.'); ?></td>
                <td><?php echo htmlspecialchars($produto['quantidade_estoque']); ?></td>
                <td><?php 
                    $data_F = new DateTime($produto['data_f']);
                    echo date_format($data_F, "d/m/Y"); 
                ?></td>
                <td><?php 
                    $data_V = new DateTime($produto['data_V']);
                    echo date_format($data_V, "d/m/Y"); 
                ?></td>
                <td><a href="index.php?acao=paginaalterar&codigo=<?php echo htmlspecialchars($produto['codigo']); ?>">ALTERAR</a></td>
                <td><a href="index.php?acao=excluir&codigo=<?php echo htmlspecialchars($produto['codigo']); ?>">EXCLUIR</a></td>
            </tr>
        <?php endwhile;
    } else {
        echo "<tr><td colspan='9'>Nenhum resultado encontrado.</td></tr>";
    }
    ?>
</table>
</div>

<script>
// Função de validação do campo de pesquisa
function validateSearch() {
    const searchInput = document.getElementById('search').value.trim();
    return searchInput !== "";  // Permite pesquisa em branco para exibir todos os produtos
}
</script>






 */?>