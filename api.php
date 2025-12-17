<?php
require 'config.php';

header('Content-Type: application/json');

$listaTareas = $db->query("
    SELECT d.id, titulo, descripcion, fecha_vencimiento, estado
    FROM tarea_data d
    JOIN tarea_dataexten e ON d.id = e.id
    ORDER BY d.id DESC
")->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($listaTareas, JSON_PRETTY_PRINT);
