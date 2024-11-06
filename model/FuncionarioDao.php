<?php
require_once __DIR__ . "/Conexao.php";


class FuncionarioDao{
    public function buscarTodosFuncionarios(){
        $pdo = Conexao::obterConexao();

        $statement = $pdo->query("SELECT * FROM Funcionario");

        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

  
}