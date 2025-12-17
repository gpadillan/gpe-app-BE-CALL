<?php
require 'config.php';

$listaTareas = $db->query("
    SELECT d.id, titulo, descripcion, fecha_vencimiento, estado
    FROM tarea_data d
    JOIN tarea_dataexten e ON d.id = e.id
    ORDER BY d.id DESC
")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de tareas</title>
</head>
<body>

<h1>Gestión de tareas</h1>

<p><a href="create.php">➕ Añadir nueva tarea</a></p>

<table border="1" cellpadding="5">
    <tr>
        <th>Título</th>
        <th>Descripción</th>
        <th>Estado</th>
        <th>Fecha límite</th>
        <th>Acciones</th>
    </tr>

<?php if (count($listaTareas) === 0): ?>
    <tr>
        <td colspan="5">No hay tareas registradas</td>
    </tr>
<?php else: ?>
<?php foreach ($listaTareas as $tarea): ?>
    <tr>
        <td><?= htmlspecialchars($tarea['titulo']) ?></td>
        <td><?= htmlspecialchars($tarea['descripcion']) ?></td>
        <td><?= htmlspecialchars($tarea['estado']) ?></td>
        <td><?= htmlspecialchars($tarea['fecha_vencimiento']) ?></td>
        <td>
            <a href="edit.php?id=<?= $tarea['id'] ?>">Editar</a> |
            <a href="delete.php?id=<?= $tarea['id'] ?>"
               onclick="return confirm('¿Seguro que deseas eliminar esta tarea?');">
               Eliminar
            </a>
        </td>
    </tr>
<?php endforeach; ?>
<?php endif; ?>

</table>

</body>
</html>