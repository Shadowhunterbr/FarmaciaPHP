<?php
include('protect.php');
 // Inicie a sessão para acessar variáveis de sessão

// Obter o código do cliente da sessão
$codCliente = $_SESSION['codCliente'] ?? null;

// Verificar se o cliente está logado
if (!$codCliente) {
    echo "Erro: cliente não autenticado. Faça login novamente.";
    exit;
}

$pedidoDao = new PedidoDao();
$pedidos = $pedidoDao->buscarPedidos($codCliente);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Pedidos</title>
</head>
<body>
    <h1>Meus Pedidos</h1>
    <?php if (empty($pedidos)): ?>
        <p>Você ainda não realizou nenhum pedido.</p>
        <a href="?acao=catalogoDeProdutos"><Button>Catalago de Produtos</Button></a>
    <?php else: ?>
        <table border="1">
            <thead>
                <tr>
                    <th>Código do Pedido</th>
                    <th>Nome do Cliente</th>
                    <th>Total da Compra</th>
                    <th>Data do Pedido</th>
                    <th>CEP</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pedidos as $pedido): ?>
                    <tr>
                        <td><?= htmlspecialchars($pedido['cod_ped']) ?></td>
                        <td><?= htmlspecialchars($pedido['nome_cliente']) ?></td>
                        <td>R$ <?= number_format($pedido['total'], 2, ',', '.') ?></td>
                        <td><?php echo date_format(new DateTime($pedido['data_pedidos']), "d/m/Y"); ?></td>
                        <td><?= htmlspecialchars($pedido['cep'] ?? 'N/A') ?></td>
                        <td>Concluido</td>
                    </tr>
                <?php endforeach; ?>
                <a href="?acao=catalogoDeProdutos"><Button>Catalago de Produtos</Button></a>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>