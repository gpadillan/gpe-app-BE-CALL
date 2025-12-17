<?php
require 'config.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$idTarea = $_GET['id'];

$db->prepare("DELETE FROM tarea_dataexten WHERE id = ?")->execute([$idTarea]);
$db->prepare("DELETE FROM tarea_data WHERE id = ?")->execute([$idTarea]);

file_put_contents(
    'app.log',
    date('Y-m-d H:i') . " | delete | {$idTarea}\n",
    FILE_APPEND
);

header('Location: index.php');
exit;
