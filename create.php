<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $stmt = $db->prepare("
        INSERT INTO tarea_data (fecha_creacion, fecha_vencimiento, estado)
        VALUES (datetime('now'), ?, ?)
    ");
    $stmt->execute([
        $_POST['fecha_vencimiento'],
        $_POST['estado']
    ]);

    $idTarea = $db->lastInsertId();

    $stmt = $db->prepare("
        INSERT INTO tarea_dataexten (id, titulo, descripcion)
        VALUES (?, ?, ?)
    ");
    $stmt->execute([
        $idTarea,
        $_POST['titulo'],
        $_POST['descripcion']
    ]);

    file_put_contents(
        'app.log',
        date('Y-m-d H:i') . " | create | {$idTarea}\n",
        FILE_APPEND
    );

    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nueva tarea</title>
</head>
<body>

<h1>Nueva tarea</h1>

<form method="post">

    <label>
        Título:<br>
        <input type="text" name="titulo" required>
    </label><br><br>

    <label>
        Descripción:<br>
        <textarea name="descripcion" rows="4"></textarea>
    </label><br><br>

    <label>
        Fecha límite:<br>
        <input type="date" name="fecha_vencimiento">
    </label><br><br>

    <label>
        Estado:<br>
        <select name="estado">
            <option value="pendiente">Pendiente</option>
            <option value="en_progreso">En progreso</option>
            <option value="completada">Completada</option>
        </select>
    </label><br><br>

    <button type="submit">Guardar tarea</button>

</form>

<p><a href="index.php">⬅ Volver al listado</a></p>

</body>
</html>