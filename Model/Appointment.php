<?php
namespace Model;

use PDO;

class Appointment {
   
    public static function isSlotOccupied($date, $time) {
        $db = Connection::getConnection();
        $stmt = $db->prepare("SELECT id FROM appointments WHERE date = :date AND time = :time AND status = 'Confirmado'");
        $stmt->execute([':date' => $date, ':time' => $time]);
        return $stmt->fetch() !== false;
    }

    
    public static function create($userId, $serviceId, $date, $time) {
        $db = Connection::getConnection();
        $stmt = $db->prepare("INSERT INTO appointments (user_id, service_id, date, time, status) VALUES (:user_id, :service_id, :date, :time, 'Confirmado')");
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
}