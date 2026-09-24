<?php
namespace Controller;

use Model\Appointment;

class AppointmentController {

    public function salvar() {
        $serviceId = $_POST['service_id'] ?? null;
        $date      = $_POST['date'] ?? null;
        $time      = $_POST['time'] ?? null;
        $userId    = 1;

        if ($serviceId && $date && $time) {

            if (Appointment::isSlotOccupied($date, $time)) {
                echo "<script>
                    alert('Este horário já está ocupado! Por favor, escolha outro.');
                    window.location.href = 'index.php';
                </script>";
                exit;
            }

            if (Appointment::create($userId, $serviceId, $date, $time)) {
                echo "<script>
                    alert('Agendamento feito com sucesso!');
                    window.location.href = 'index.php?page=history';
                </script>";
                exit;
            }
        }
    }

    public function deletar() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            Appointment::delete($id);
            echo "<script>
                alert('Agendamento cancelado com sucesso!');
                window.location.href = 'index.php?page=history';
            </script>";
            exit;
        }
    }

    public function atualizar() {
        $id        = $_POST['id'] ?? null;
        $serviceId = $_POST['service_id'] ?? null;
        $date      = $_POST['date'] ?? null;
        $time      = $_POST['time'] ?? null;

        if ($id && $serviceId && $date && $time) {
            Appointment::update($id, $serviceId, $date, $time);
            echo "<script>
                alert('Agendamento atualizado com sucesso!');
                window.location.href = 'index.php?page=history';
            </script>";
            exit;
        }
    }
}