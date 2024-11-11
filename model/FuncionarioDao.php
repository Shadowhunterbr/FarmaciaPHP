<?php
require_once __DIR__ . "/Conexao.php";


class FuncionarioDao{
    public function buscarTodosFuncionarios(){
        $pdo = Conexao::obterConexao();

        $statement = $pdo->query("SELECT * FROM Funcionario");

        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    
    public function buscarFuncionarioPorCodigo($codigoFuncionario){
        //Conexão com o Banco de Dados
        $pdo = Conexao::obterConexao();
 
        $stmt = $pdo->prepare("SELECT * FROM Funcionario WHERE codigo = :codigo");
        $stmt->bindParam(':codigo',$codigoFuncionario);
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
        
    }

    public function autentica($login, $senha) {
        $pdo = Conexao::obterConexao();
        $funcionario = null;

        try {
            $stmt = $pdo->prepare("SELECT * FROM funcionario WHERE login = :login AND senha = :senha");            
            $stmt->bindParam(':login', $login);
            $stmt->bindParam(':senha', $senha);
            $stmt->execute();

            if ($resultado = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $funcionario = new Funcionario(null,null,null,$login,$senha,null,null,null,null);
               /* $funcionario->setIdFuncionario($resultado['id_funcionario']);
                $funcionario->setNome($resultado['nome_funcionario']);
                $funcionario->setCargo($resultado['cargo_funcionario']);
                $funcionario->setSalario($resultado['salario_funcionario']);
                */
                $funcionario->setLoginFuncionario($resultado['login']);
                $funcionario->setSenhaFuncionario($resultado['senha']);
            }
        } catch (PDOException $e) {
            echo 'Erro ao consultar o banco de dados: ' . $e->getMessage();
        }

        return $funcionario;
    }

  
}