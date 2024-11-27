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
    $stmt = $pdo->prepare("SELECT * FROM carrinho WHERE cod_cliente = :cod_cliente");
    $stmt->execute([':cod_cliente' => $codCliente]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
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
        SELECT p.nome, p.preco, i.quantidade, i.subtotal , i.cod_prod
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
}
