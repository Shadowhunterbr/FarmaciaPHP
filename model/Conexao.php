<?php


class Conexao{

    public static function obterConexao() {
        try {
          
            $pdo = new PDO('mysql:host=localhost;dbname=farmacia', 'root', 'senha');
            return $pdo;
        } catch (Exception $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
}