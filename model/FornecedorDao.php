<?php

require_once __DIR__ . "/Conexao.php";

class FornecedorDao{

        public function buscarTodosFornecedores(){

            $pdo = Conexao::obterConexao();
            //echo "Banco de Dados Conectado com Sucesso!!!" .PHP_EOL;
    
            $statement = $pdo->query("SELECT codigo, nome_fantasia FROM fornecedor");
    
            return $statement->fetchAll(\PDO::FETCH_ASSOC);
           
        }

}