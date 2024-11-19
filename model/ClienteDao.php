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

    public function autentica($email, $senha) {
        $pdo = Conexao::obterConexao();
        $cliente = null;

        try {
            $stmt = $pdo->prepare("SELECT * FROM Cliente WHERE email = :email AND senha = :senha");            
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':senha', $senha);
            $stmt->execute();

            if ($resultado = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $cliente = new Cliente(null,null,null,$email,$senha,null,null,null,null);
               /*  
                SALVAR AS INFORMAÇÕES DO CLIENTE NA SESSÃO
                
                */
                $cliente->setEmailCliente($resultado['email']);
                $cliente->setSenhaCliente($resultado['senha']);
            }
        } catch (PDOException $e) {
            echo 'Erro ao consultar o banco de dados: ' . $e->getMessage();
        }

        return $cliente;
    }

    public function verificarEmailExistente($email) {
        $pdo = Conexao::obterConexao();
        $stmt = $pdo->prepare("SELECT COUNT(*) as total FROM cliente WHERE email = :email");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        return $resultado['total'] > 0; // Retorna true se o email já existe
    }

    public function verificarCpfExistente($cpf) {
        $pdo = Conexao::obterConexao();
        $stmt = $pdo->prepare("SELECT COUNT(*) as total FROM cliente WHERE cpf = :cpf");
        $stmt->bindParam(':cpf', $cpf, PDO::PARAM_STR);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        return $resultado['total'] > 0; // Retorna true se o CPF já existe
    }

    public function generos(){
        $pdo = Conexao::obterConexao();

        $statement = $pdo->query("SELECT codigo, genero FROM genero");

        
        $generos = $statement->fetchAll(\PDO::FETCH_ASSOC);

        return $generos;
    }
    
}

