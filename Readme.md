BANCO DE DADOS

Tabela services

id: INT (Chave Primária, Auto Incremento) — Identificador único
name: VARCHAR(100) — Nome do serviço
price: DECIMAL(10,2) — Preço do serviço

Tabela appointments

id: INT (Chave Primária, Auto Incremento) — Identificador único do agendamento
user_id: INT — ID do cliente
service_id: INT (Chave Estrangeira -> services.id) — ID do serviço agendado
date: DATE — Data do agendamento (AAAA-MM-DD)
time: TIME — Horário do agendamento (HH:MM:SS)
status: VARCHAR(20) — Estado do agendamento (Padrão: 'Confirmado')