<?php
use Model\Appointment;

$user_id = 1;
$appointments = Appointment::getByUser($user_id);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>ArielBarber - Meus Agendamentos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5" style="max-width: 850px;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Meus Agendamentos</h2>
        <a href="index.php?page=home" class="btn btn-success">+ Novo Agendamento</a>
    </div>

    <div class="card p-3 shadow-sm bg-white">
        <table class="table table-striped align-middle">
            <thead>
                <tr>
                    <th>Serviço</th>
                    <th>Data</th>
                    <th>Horário</th>
                    <th>Valor</th>
                    <th>Status</th>
                    <th class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($appointments) > 0): ?>
                    <?php foreach ($appointments as $a): ?>
                        <tr>
                            <td><?php echo $a['service_name']; ?></td>
                            <td><?php echo date('d/m/Y', strtotime($a['date'])); ?></td>
                            <td><?php echo $a['time']; ?></td>
                            <td>R$ <?php echo number_format($a['price'], 2, ',', '.'); ?></td>
                            <td>
                                <span class="badge bg-primary"><?php echo $a['status']; ?></span>
                            </td>
                            <td class="text-center">
                                <a href="index.php?page=delete_appointment&id=<?= $a['id'] ?>" 
                                   onclick="return confirm('Tem certeza que deseja cancelar este agendamento?')" 
                                   class="btn btn-danger btn-sm">
                                   Cancelar
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted">Nenhum agendamento encontrado.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>