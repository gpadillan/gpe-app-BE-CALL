<?php
require 'config.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$idTarea = $_GET['id'];

// Si se envía el formulario, actualizar
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $stmt = $db->prepare("
        UPDATE tarea_data
        SET fecha_vencimiento = ?, estado = ?
        WHERE id = ?
    ");
    $stmt->execute([
        $_POST['fecha_vencimiento'],
        $_POST['estado'],
        $idTarea
    ]);

    $stmt = $db->prepare("
        UPDATE tarea_dataexten
        SET titulo = ?, descripcion = ?
        WHERE id = ?
    ");
    $stmt->execute([
        $_POST['titulo'],
        $_POST['descripcion'],
        $idTarea
    ]);

    file_put_contents(
        'app.log',
        date('Y-m-d H:i') . " | edit | {$idTarea}\n",
        FILE_APPEND
    );

    header('Location: index.php');
    exit;
}

// Obtener datos actuales
$stmt = $db->prepare("
    SELECT d.id, titulo, descripcion, fecha_vencimiento, estado
    FROM tarea_data d
    JOIN tarea_dataexten e ON d.id = e.id
    WHERE d.id = ?
");
$stmt->execute([$idTarea]);
$tarea = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$tarea) {
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar tarea</title>
</head>
<body>

<h1>Editar tarea</h1>

<form method="post">

    <label>
        Título:<br>
        <input type="text" name="titulo" value="<?= htmlspecialchars($tarea['titulo']) ?>" required>
    </label><br><br>

    <label>
        Descripción:<br>
        <textarea name="descripcion" rows="4"><?= htmlspecialchars($tarea['descripcion']) ?></textarea>
    </label><br><br>

    <label>
        Fecha límite:<br>
        <input type="date" name="fecha_vencimiento" value="<?= htmlspecialchars($tarea['fecha_vencimiento']) ?>">
    </label><br><br>

    <label>
        Estado:<br>
        <select name="estado">
            <option value="pendiente" <?= $tarea['estado'] === 'pendiente' ? 'selected' : '' ?>>Pendiente</option>
            <option value="en_progreso" <?= $tarea['estado'] === 'en_progreso' ? 'selected' : '' ?>>En progreso</option>
            <option value="completada" <?= $tarea['estado'] === 'completada' ? 'selected' : '' ?>>Completada</option>
        </select>
    </label><br><br>

    <button type="submit">Guardar cambios</button>

</form>

<p><a href="index.php">⬅ Volver</a></p>

</body>
</html>