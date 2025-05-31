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

    public function excluirFornecedor($objFornecedor) {
        $pdo = Conexao::obterConexao();
    
        // Verificar se o fornecedor está associado a algum produto
        $stmtCheck = $pdo->prepare("SELECT COUNT(*) as total FROM Produtos WHERE cod_fornecedor = :codigo");
        $stmtCheck->bindParam(':codigo', $objFornecedor->getCodigoFornecedor());
        $stmtCheck->execute();
        $resultado = $stmtCheck->fetch(PDO::FETCH_ASSOC);
    
        if ($resultado['total'] > 0) {
            // Retorna uma mensagem de erro caso o fornecedor esteja associado a algum produto
            throw new Exception("O fornecedor não pode ser excluído porque está vinculado a um ou mais produtos.");
        }
    
        // Caso não haja vínculo, prosseguir com a exclusão
        $stmtDelete = $pdo->prepare("DELETE FROM Fornecedor WHERE codigo = :codigo");
        $stmtDelete->bindParam(':codigo', $objFornecedor->getCodigoFornecedor());
        $stmtDelete->execute();

    }



    public function alterarFuncionario($objFuncionario) {
        // Conexão com o Banco de Dados
        $pdo = Conexao::obterConexao();
    
        $stmt = $pdo->prepare("UPDATE Funcionario SET nome = :nome, email = :email, login = :login, senha = :senha, telefone = :telefone, cpf = :cpf, cargo = :cargo, cod_genero = :cod_genero WHERE codigo = :codigo");
    
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
    
    public function alterarFornecedor($objFornecedor) {
        $pdo = Conexao::obterConexao();
    
        $stmt = $pdo->prepare("UPDATE fornecedor SET 
            razao_social = :razao_social, 
            nome_fantasia = :nome_fantasia, 
            cnpj = :cnpj, 
            endereco = :endereco, 
            cidade = :cidade, 
            cep = :cep, 
            pessoa_contato = :pessoa_contato, 
            telefone = :telefone 
            WHERE codigo = :codigo");
    
        $stmt->bindParam(':codigo', $objFornecedor->getCodigoFornecedor());
        $stmt->bindParam(':razao_social', $objFornecedor->getRazaoSocial());
        $stmt->bindParam(':nome_fantasia', $objFornecedor->getNomeFantasia());
        $stmt->bindParam(':cnpj', $objFornecedor->getCnpj());
        $stmt->bindParam(':endereco', $objFornecedor->getEndereco());
        $stmt->bindParam(':cidade', $objFornecedor->getCidade());
        $stmt->bindParam(':cep', $objFornecedor->getCep());
        $stmt->bindParam(':pessoa_contato', $objFornecedor->getPessoaContato());
        $stmt->bindParam(':telefone', $objFornecedor->getTelefone());
    
        // Executa o comando SQL
        $stmt->execute();
    }
    

}