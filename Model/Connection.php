<?php
namespace Model;

use PDO;
use PDOException;

class Connection {
    private static $instance = null;

    public static function getInstance() {
        if (self::$instance === null) {
            try {
                $host = DB_HOST;
                $dbname = DB_NAME;
                $user = DB_USER;
                $pass = DB_PASS;

                self::$instance = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $user, $pass);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Erro na conexão com o banco de dados: " . $e->getMessage());
            }
        }
        return self::$instance;
    }

    public static function getConnection() {
        return self::getInstance();
    }
}