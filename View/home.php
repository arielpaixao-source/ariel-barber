<?php
use Model\Service;

$services = Service::getAll();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>ArielBarber - Novo Agendamento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5" style="max-width: 500px;">
    <h2 class="text-center mb-4">Agendar Horário</h2>

    <form action="index.php?page=save_appointment" method="POST" class="card p-4 shadow-sm bg-white">
        
        <div class="mb-3">
            <label class="form-label">Selecione o Serviço:</label>
            <select name="service_id" class="form-select" required>
                <option value="">Escolha uma opção...</option>
                <?php foreach ($services as $s): ?>
                    <option value="<?php echo $s['id']; ?>">
                        <?php echo $s['name']; ?> - R$ <?php echo number_format($s['price'], 2, ',', '.'); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Data:</label>
            <input type="date" name="date" class="form-control" required min="<?php echo date('Y-m-d'); ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Horário:</label>
            <input type="time" name="time" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Confirmar Agendamento</button>
        <a href="index.php?page=history" class="btn btn-outline-secondary w-100 mt-2">Ver Meus Agendamentos</a>
    </form>
</div>

</body>
</html>