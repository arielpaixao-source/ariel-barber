<?php
namespace Controller;

use Model\Appointment;

class AppointmentController {

    public function salvar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $service_id = $_POST['service_id'];
            $date = $_POST['date'];
            $time = $_POST['time'];
            $user_id = 1; 

            
            if (Appointment::isSlotOccupied($date, $time)) {
                echo "<script>alert('Este horário já está ocupado!'); window.location.href='index.php?page=home';</script>";
                exit;
            }

           
            Appointment::create($user_id, $service_id, $date, $time);
            echo "<script>alert('Agendamento feito com sucesso!'); window.location.href='index.php?page=history';</script>";
            exit;
        }
    }
}