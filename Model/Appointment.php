<?php
namespace Model;

use PDO;

class Appointment {

    public static function isSlotOccupied($date, $time) {
        $db = Connection::getInstance();
        $stmt = $db->prepare("SELECT COUNT(*) FROM appointments WHERE date = :date AND TIME_FORMAT(time, '%H:%i') = TIME_FORMAT(:time, '%H:%i')");
        $stmt->execute([
            ':date' => $date,
            ':time' => $time
        ]);
        return $stmt->fetchColumn() > 0;
    }

    public static function create($userId, $serviceId, $date, $time) {
        $db = Connection::getConnection();
        $stmt = $db->prepare("INSERT INTO appointments (user_id, service_id, date, time) VALUES (:user_id, :service_id, :date, :time)");
        return $stmt->execute([
            ':user_id' => $userId,
            ':service_id' => $serviceId,
            ':date' => $date,
            ':time' => $time
        ]);
    }

    public static function getByUser($userId) {
        $db = Connection::getConnection();
        $stmt = $db->prepare("
            SELECT a.*, s.name as service_name, s.price
            FROM appointments a
            JOIN services s ON a.service_id = s.id
            WHERE a.user_id = :user_id
            ORDER BY a.date DESC, a.time DESC
        ");
        $stmt->execute([':user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function delete($id) {
        $db = Connection::getConnection();
        $stmt = $db->prepare("DELETE FROM appointments WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    public static function update($id, $serviceId, $date, $time) {
        $db = Connection::getConnection();
        $stmt = $db->prepare("UPDATE appointments SET service_id = :service_id, date = :date, time = :time WHERE id = :id");
        return $stmt->execute([
            ':id' => $id,
            ':service_id' => $serviceId,
            ':date' => $date,
            ':time' => $time
        ]);
    }
}