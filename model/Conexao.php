<?php


class Conexao{

    public static function obterConexao(){
        return new \PDO('mysql:host=localhost;dbname=farmacia','root','senha');

    }
}