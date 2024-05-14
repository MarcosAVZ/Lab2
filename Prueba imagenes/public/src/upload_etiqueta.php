<?php
require 'config/db.php';  // Asegúrate de que la ruta al archivo de configuración de la base de datos es correcta

if (isset($_POST['nombre'])) {
    $nombre = $_POST['nombre'];

    // Preparar la consulta para insertar la etiqueta
    $stmt = $conn->prepare("INSERT INTO etiquetas (nombre) VALUES (?)");
    $stmt->bind_param("s", $nombre);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "Etiqueta agregada con éxito.";
    } else {
        echo "Error al agregar etiqueta: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "Nombre de etiqueta no proporcionado.";
}

$conn->close();
?>
