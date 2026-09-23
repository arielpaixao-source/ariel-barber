<?php
namespace Model;

use PDO;
use PDOException;

class Connection {
    private static $instance = null;

    public static function getConnection() {
        if (self::$instance === null) {
            try {
                require_once __DIR__ . '/../Config/configuration.php';
                self::$instance = new PDO(
                    "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8",
                    DB_USER,
                    DB_PASS,
                    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
                );
            } catch (PDOException $e) {
                die("Erro na conexão: " . $e->getMessage());
            }
        }
        return self::$instance;
    }
}