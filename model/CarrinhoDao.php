<?php

require_once __DIR__ . "/Conexao.php";

use model\Produto;

class CarrinhoDao{
  
    
public function criarCarrinho($codCliente) {
    $pdo = Conexao::obterConexao();
    
    $stmt = $pdo->prepare("INSERT INTO carrinho (cod_cliente) VALUES (:cod_cliente)");
    $stmt->execute([':cod_cliente' => $codCliente]);
    return $pdo->lastInsertId();
}

public function buscarCarrinho($codCliente) {
   
    $pdo = Conexao::obterConexao();
    $sql = "SELECT * FROM carrinho WHERE cod_cliente = :cod_cliente LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':cod_cliente', $codCliente, PDO::PARAM_INT);
    $stmt->execute();
    
    // Retorna o resultado ou false se não encontrar
    return $stmt->fetch(PDO::FETCH_ASSOC); // Retorna um array associativo
}
public function adicionarItem($codCarrinho, $codProd, $quantidade, $subtotal) {
    
    $pdo = Conexao::obterConexao();
    $stmt = $pdo->prepare("
        INSERT INTO itens_carrinho (cod_prod, cod_carrinho, quantidade, subtotal)
        VALUES (:cod_prod, :cod_carrinho, :quantidade, :subtotal)
        ON DUPLICATE KEY UPDATE 
            quantidade = quantidade + :quantidade,
            subtotal = subtotal + :subtotal
    ");
    $stmt->execute([
        ':cod_prod' => $codProd,
        ':cod_carrinho' => $codCarrinho,
        ':quantidade' => $quantidade,
        ':subtotal' => $subtotal
    ]);
}

public function buscarItensCarrinho($codCarrinho) {
    $pdo = Conexao::obterConexao();

    $stmt = $pdo->prepare("
        SELECT p.nome, p.preco, i.quantidade, i.subtotal , i.cod_prod, p.cod_prescricao, p.IMAGEM
        FROM itens_carrinho i
        INNER JOIN produtos p ON i.cod_prod = p.codigo
        WHERE i.cod_carrinho = :cod_carrinho
    ");
    $stmt->execute([':cod_carrinho' => $codCarrinho]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function removerItem($codCarrinho, $codProd) {
    $pdo = Conexao::obterConexao();

    var_dump($codCarrinho,$codProd);
    echo ($codCarrinho);
    echo($codProd);
    $stmt = $pdo->prepare("DELETE FROM itens_carrinho WHERE cod_carrinho = :cod_carrinho AND cod_prod = :cod_prod");
    $stmt->execute([':cod_carrinho' => $codCarrinho, ':cod_prod' => $codProd]);
    
    }

    public function calcularTotalCarrinho($codCarrinho) {
        $pdo = Conexao::obterConexao();
    
        $stmt = $pdo->prepare("
            SELECT SUM(i.quantidade * p.preco) AS total 
            FROM itens_carrinho i
            JOIN produtos p ON i.cod_prod = p.codigo
            WHERE i.cod_carrinho = :cod_carrinho
        ");
    
        $stmt->execute([':cod_carrinho' => $codCarrinho]);
    
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] ?? 0; 
    }

    public function limparCarrinho($codCarrinho) {
        $pdo = Conexao::obterConexao();
        $sql = "DELETE FROM itens_carrinho WHERE cod_carrinho = :cod_carrinho";
        $stmt =  $pdo->prepare($sql);
        $stmt->bindParam(':cod_carrinho', $codCarrinho, PDO::PARAM_INT);
        $stmt->execute();
    }
    public function atualizarEstoque($produtos) {
        $pdo = Conexao::obterConexao();
        
        // Preparar a query para atualizar o estoque
        $sql = "UPDATE produtos SET quantidade_estoque = quantidade_estoque - :quantidade 
                WHERE codigo = :codProd";
        $stmt = $pdo->prepare($sql);
    
        foreach ($produtos as $produto) {
            // Executar a atualização para cada produto
            $stmt->execute([
                ':quantidade' => $produto['quantidade'],
                ':codProd' => $produto['cod_prod']
            ]);
        }
    }
    
}
