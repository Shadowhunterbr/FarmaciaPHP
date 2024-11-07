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

  
}