<?php

require_once 'config/BancoDadosConfig.php';

final class ConexaoMySQL {

    public PDO $pdoMySQL;

    public function __construct()
    {
        
        try {

            $this->pdoMySQL = new PDO("mysql:host=" . SERVIDOR . ";dbname=" . NOMEBANCO, USUARIO, SENHA);

        } catch (PDOException $e) {

            echo 'Erro ao conectar: ' . $e->getMessage();

        }
        
    }

}