<?php

require_once __DIR__ . "/Conexao.php";

class ClienteDao {
    public function cadastrarCliente($objCliente) {
        try {
            $pdo = Conexao::obterConexao();

            $stmt = $pdo->prepare("INSERT INTO cliente(codigo, nome, email, senha, telefone, cpf, cod_genero, data_nascimento) 
                                   VALUES(:codigo, :nome, :email, :senha, :telefone, :cpf, :cod_genero, :data_nascimento)");

            $stmt->bindParam(':codigo', $objCliente->getCodigoCliente());
            $stmt->bindParam(':nome', $objCliente->getNomeCliente());
            $stmt->bindParam(':email', $objCliente->getEmailCliente());
            $stmt->bindParam(':senha', $objCliente->getSenhaCliente()); 
            $stmt->bindParam(':telefone', $objCliente->getTelefoneCliente());
            $stmt->bindParam(':cpf', $objCliente->getCpfCliente());
            $stmt->bindParam(':cod_genero', $objCliente->getCodGenero());
            $stmt->bindParam(':data_nascimento', $objCliente->getDataNascimento());

            $stmt->execute();
        } catch (PDOException $e) {
            echo 'Erro ao cadastrar cliente: ' . $e->getMessage();
        }
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
                $cliente = new Cliente(null, null, null, $email, $senha, null, null, null, null);
                $cliente->setCodigoCliente($resultado['codigo']);
                $cliente->setEmailCliente($resultado['email']);
                $cliente->setSenhaCliente($resultado['senha']);
            }
        } catch (PDOException $e) {
            echo 'Erro ao autenticar cliente: ' . $e->getMessage();
        }

        return $cliente;
    }

    public function verificarEmailExistente($email) {
        try {
            $pdo = Conexao::obterConexao();
            $stmt = $pdo->prepare("SELECT COUNT(*) as total FROM cliente WHERE email = :email");
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            return $resultado['total'] > 0;
        } catch (PDOException $e) {
            echo 'Erro ao verificar email existente: ' . $e->getMessage();
            return false;
        }
    }

    public function verificarCpfExistente($cpf) {
        try {
            $pdo = Conexao::obterConexao();
            $stmt = $pdo->prepare("SELECT COUNT(*) as total FROM cliente WHERE cpf = :cpf");
            $stmt->bindParam(':cpf', $cpf, PDO::PARAM_STR);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            return $resultado['total'] > 0;
        } catch (PDOException $e) {
            echo 'Erro ao verificar CPF existente: ' . $e->getMessage();
            return false;
        }
    }

    public function generos() {
        try {
            $pdo = Conexao::obterConexao();
            $statement = $pdo->query("SELECT codigo, genero FROM genero");
            $generos = $statement->fetchAll(PDO::FETCH_ASSOC);

            return $generos;
        } catch (PDOException $e) {
            echo 'Erro ao buscar gêneros: ' . $e->getMessage();
            return [];
        }
    }

    public function buscarClientePorCodigo($codigo) {
        try {
            $pdo = Conexao::obterConexao();
            $stmt = $pdo->prepare("SELECT * FROM Cliente WHERE codigo = :codigo");
            $stmt->bindParam(':codigo', $codigo);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Erro ao buscar cliente por código: ' . $e->getMessage();
            return null;
        }
    }

    public function buscarEnderecoPorCodigo($codigo) {
        try {
            $pdo = Conexao::obterConexao();
            $stmt = $pdo->prepare("SELECT * FROM endereco_cliente WHERE codigo = :codigo");
            $stmt->bindParam(':codigo', $codigo);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Erro ao buscar endereço por código: ' . $e->getMessage();
            return null;
        }
    }

    public function criarEndereco($codCliente) {
        try {
            $pdo = Conexao::obterConexao();
            $stmt = $pdo->prepare("INSERT INTO endereco_cliente (cod_cliente) VALUES (:cod_cliente)");
            $stmt->execute([':cod_cliente' => $codCliente]);
            return $pdo->lastInsertId();
        } catch (PDOException $e) {
            echo 'Erro ao criar endereço: ' . $e->getMessage();
            return null;
        }
    }

    public function alterarEndereco($objEndereco) {
        try {
            $pdo = Conexao::obterConexao();
            $stmt = $pdo->prepare("UPDATE endereco_cliente 
                                   SET cod_cliente = :codCliente,
                                       rua = :rua, 
                                       numero = :numero, 
                                       bairro = :bairro, 
                                       cidade = :cidade, 
                                       cep = :cep, 
                                       UF = :uf 
                                   WHERE codigo = :codigo");

            $stmt->bindParam(':codigo', $objEndereco->getCodigo());
            $stmt->bindParam(':codCliente', $objEndereco->getCodCliente());
            $stmt->bindParam(':rua', $objEndereco->getRua());
            $stmt->bindParam(':numero', $objEndereco->getNumero());
            $stmt->bindParam(':bairro', $objEndereco->getBairro());
            $stmt->bindParam(':cidade', $objEndereco->getCidade());
            $stmt->bindParam(':cep', $objEndereco->getCep());
            $stmt->bindParam(':uf', $objEndereco->getUf());

            $stmt->execute();
        } catch (PDOException $e) {
            echo 'Erro ao alterar endereço: ' . $e->getMessage();
        }
    }

    public function alterarCliente($objCliente) {
        try {
            $pdo = Conexao::obterConexao();
            $stmt = $pdo->prepare("UPDATE cliente 
                                   SET nome = :nome, 
                                       email = :email, 
                                       senha = :senha, 
                                       telefone = :telefone, 
                                       cpf = :cpf, 
                                       cod_genero = :codGenero, 
                                       data_nascimento = :dataNascimento 
                                   WHERE codigo = :codigo");

            $stmt->bindParam(':codigo', $objCliente->getCodigoCliente());
            $stmt->bindParam(':nome', $objCliente->getNomeCliente());
            $stmt->bindParam(':email', $objCliente->getEmailCliente());
            $stmt->bindParam(':senha', $objCliente->getSenhaCliente());
            $stmt->bindParam(':telefone', $objCliente->getTelefoneCliente());
            $stmt->bindParam(':cpf', $objCliente->getCpfCliente());
            $stmt->bindParam(':codGenero', $objCliente->getCodGenero());
            $stmt->bindParam(':dataNascimento', $objCliente->getDataNascimento());

            $stmt->execute();
        } catch (PDOException $e) {
            echo 'Erro ao alterar cliente: ' . $e->getMessage();
        }
    }
}
