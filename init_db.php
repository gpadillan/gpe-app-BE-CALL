<?php
require 'config.php';
$db->exec("
CREATE TABLE IF NOT EXISTS tarea_data (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    fecha_creacion TEXT,
    fecha_vencimiento TEXT,
    estado TEXT
)");
$db->exec("
CREATE TABLE IF NOT EXISTS tarea_dataexten (
    id INTEGER,
    titulo TEXT,
    descripcion TEXT,
    FOREIGN KEY(id) REFERENCES tarea_data(id)
)");
echo "Base de datos iniciada correctamente\n";
