<?php


class Conexao{

<<<<<<< HEAD
    public static function obterConexao() {
        try {
          
            $pdo = new PDO('mysql:host=localhost;dbname=farmacia', 'root', 'senha');
            return $pdo;
        } catch (Exception $e) {
            echo "Connection failed: " . $e->getMessage();
        }
=======
    public static function obterConexao(){
        return new \PDO('mysql:host=localhost;dbname=farmacia','root','admin');
>>>>>>> f3984aabb414b29b157c4d97e55ba216e2ab6aaf
    }
}