<?php

require_once __DIR__ . "/Conexao.php";

class ClienteDao{

    public function cadastrarCliente($objCliente) {
    // Conexão com o Banco de Dados
        $pdo = Conexao::obterConexao();

        $stmt = $pdo->prepare("INSERT INTO cliente(codigo, nome, cod_endereco, email, senha, telefone, cpf, cod_genero, data_nascimento) 
                           VALUES(:codigo, :nome, :cod_endereco, :email, :senha, :telefone, :cpf, :cod_genero, :data_nascimento)");

        $stmt->bindParam(':codigo', $objCliente->getCodigoCliente());
        $stmt->bindParam(':nome', $objCliente->getNomeCliente());
        $stmt->bindParam(':cod_endereco', $objCliente->getCodEndereco());
        $stmt->bindParam(':email', $objCliente->getEmailCliente());
        $stmt->bindParam(':senha', $objCliente->getSenhaCliente()); 
        $stmt->bindParam(':telefone', $objCliente->getTelefoneCliente());
        $stmt->bindParam(':cpf', $objCliente->getCpfCliente());
        $stmt->bindParam(':cod_genero', $objCliente->getCodGenero());
        $stmt->bindParam(':data_nascimento', $objCliente->getDataNascimento());

        $stmt->execute();
    }
}