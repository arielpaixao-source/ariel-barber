<?php

require_once __DIR__ . '/Config/configuration.php';
require_once __DIR__ . '/Model/Connection.php';
require_once __DIR__ . '/Model/Service.php';
require_once __DIR__ . '/Model/Appointment.php';
require_once __DIR__ . '/Controller/AppointmentController.php';

use Controller\AppointmentController;

$page = isset($_GET['page']) ? $_GET['page'] : 'home';

if ($page === 'home') {
    require_once __DIR__ . '/View/home.php';
} elseif ($page === 'history') {
    require_once __DIR__ . '/View/history.php';
} elseif ($page === 'save_appointment') {
    $controller = new AppointmentController();
    $controller->salvar();
} else {
    require_once __DIR__ . '/View/home.php';
}