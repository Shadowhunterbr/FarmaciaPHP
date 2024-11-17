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
        $stmt->bindParam(':codigo',$objFuncionario->getCodigoFuncionario());

        $stmt->execute();
    }
   public function cadastrarFornecedor($objFornecedor) {
    // Conexão com o Banco de Dados
    $pdo = Conexao::obterConexao();

    $stmt = $pdo->prepare("INSERT INTO Fornecedor(codigo, razao_social, nome_fantasia, cnpj, endereco, cidade, cep, pessoa_contato, telefone) 
                           VALUES(:codigo, :razao_social, :nome_fantasia, :cnpj, :endereco, :cidade, :cep, :pessoa_contato, :telefone)");

    $stmt->bindParam(':codigo', $objFornecedor->getCodigoFornecedor());
    $stmt->bindParam(':razao_social', $objFornecedor->getRazaoSocial());
    $stmt->bindParam(':nome_fantasia', $objFornecedor->getNomeFantasia());
    $stmt->bindParam(':cnpj', $objFornecedor->getCnpj());
    $stmt->bindParam(':endereco', $objFornecedor->getEndereco());
    $stmt->bindParam(':cidade', $objFornecedor->getCidade());
    $stmt->bindParam(':cep', $objFornecedor->getCep());
    $stmt->bindParam(':pessoa_contato', $objFornecedor->getPessoaContato());
    $stmt->bindParam(':telefone', $objFornecedor->getTelefone());

    $stmt->execute();
    }   
}