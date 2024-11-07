<?php

class GerenteDao extends FuncionarioDao{
    
    
    public function cadastrarFuncionario($objFuncionario) {
        // Conexão com o Banco de Dados
        $pdo = Conexao::obterConexao();
    
        $stmt = $pdo->prepare("INSERT INTO Funcionario(codigo, nome, email, login, senha, telefone, cpf, cargo, cod_genero) VALUES(:codigo, :nome, :email, :login, :senha, :telefone, :cpf, :cargo, :cod_genero)");
        
        $stmt->bindParam(':codigo', $objFuncionario->getCodigoFuncionario());
        $stmt->bindParam(':nome', $objFuncionario->getNomeFuncionario());
        $stmt->bindParam(':email', $objFuncionario->getEmailFuncionario());
        $stmt->bindParam(':login', $objFuncionario->getLoginFuncionario());
        $stmt->bindParam(':senha', $objFuncionario->getSenhaFuncionario());
        $stmt->bindParam(':telefone', $objFuncionario->getTelefoneFunc());
        $stmt->bindParam(':cpf', $objFuncionario->getCpfFuncionario());
        $stmt->bindParam(':cargo', $objFuncionario->getCargoFuncionario());
        $stmt->bindParam(':cod_genero', $objFuncionario->getCodGenero());
    
        $stmt->execute();
    }

    public function excluir($objFuncionario){
        //Conexão com o Banco de Dados
        $pdo = Conexao::obterConexao();
        
        $stmt = $pdo->prepare("DELETE FROM Funcionario WHERE codigo = :codigo");
        $stmt->bindParam(':codigo',$objFuncionario->getCodigo());

        $stmt->execute();
    }/*
    public function cadastrarForncedor($objFornecedor) {
        // Conexão com o Banco de Dados
        $pdo = Conexao::obterConexao();
    
        $stmt = $pdo->prepare("INSERT INTO Funcionario(codigo, nome, email, login, senha, telefone, cpf, cargo, cod_genero) VALUES(:codigo, :nome, :email, :login, :senha, :telefone, :cpf, :cargo, :cod_genero)");
        
        $stmt->bindParam(':codigo', $objFornecedor->getCodigoFuncionario());
        $stmt->bindParam(':nome', $objFornecedor->getNomeFuncionario());
        $stmt->bindParam(':email', $objFornecedor->getEmailFuncionario());
        $stmt->bindParam(':login', $objFuncionario->getLoginFuncionario());
        $stmt->bindParam(':senha', $objFuncionario->getSenhaFuncionario());
        $stmt->bindParam(':telefone', $objFuncionario->getTelefoneFunc());
        $stmt->bindParam(':cpf', $objFuncionario->getCpfFuncionario());
        $stmt->bindParam(':cargo', $objFuncionario->getCargoFuncionario());
        $stmt->bindParam(':cod_genero', $objFuncionario->getCodGenero());
    
        $stmt->execute();
    }*/
}