<?php
namespace Model;

use PDO;

class Service {
    public static function getAll() {
        $db = Connection::getInstance();
        $stmt = $db->query("SELECT * FROM services ORDER BY name ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}