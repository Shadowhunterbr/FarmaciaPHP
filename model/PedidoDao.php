<?php

require_once __DIR__ . "/Conexao.php";

class PedidoDao
{
    

    
    public function salvarPedido($codCliente, $total, $produtos) {
        $pdo = Conexao::obterConexao();
        
        // Salvar o pedido (não incluir o campo 'codigo' na instrução)
        $sqlPedido = "INSERT INTO pedidos (cod_cliente, data_pedidos, total) VALUES (:codCliente, NOW(), :total)";
        $stmt = $pdo->prepare($sqlPedido);
        $stmt->execute([':codCliente' => $codCliente, ':total' => $total]);
    
        // Pegar o código do pedido gerado automaticamente
        $codPedido = $pdo->lastInsertId();
    
        // Salvar os itens do pedido
        $sqlItem = "INSERT INTO itens_pedido (cod_prod, cod_ped, quantidade, subtotal) VALUES (:codProd, :codPed, :quantidade, :subtotal)";
        $stmtItem = $pdo->prepare($sqlItem);
    
        foreach ($produtos as $produto) {
            $stmtItem->execute([
                ':codProd' => $produto['cod_prod'],
                ':codPed' => $codPedido,  // Usando o código do pedido gerado
                ':quantidade' => $produto['quantidade'],
                ':subtotal' => $produto['subtotal']
            ]);
        }
    }

    public function buscarPedidos($codCliente) {
        $pdo = Conexao::obterConexao();
        $sql = "SELECT 
                    p.codigo AS cod_ped, 
                    c.nome AS nome_cliente, 
                    p.total, 
                    ec.rua, 
                    ec.numero, 
                    ec.bairro, 
                    ec.cidade, 
                    ec.cep, 
                    ec.UF
                FROM pedidos p
                JOIN cliente c ON p.cod_cliente = c.codigo
                LEFT JOIN endereco_cliente ec ON c.cod_endereco = ec.codigo
                WHERE p.cod_cliente = :codCliente";
    
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':codCliente' => $codCliente]);
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}  