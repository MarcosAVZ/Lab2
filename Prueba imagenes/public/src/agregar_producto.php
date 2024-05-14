<?php
require 'config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $descripcion = $_POST['descripcion'];
    $cantidad = $_POST['cantidad'];

    $stmt = $conn->prepare("INSERT INTO productos (nombre, precio, descripcion, fechaCreacion, cantidad) VALUES (?, ?, ?, NOW(), ?)");
    $stmt->bind_param("sdsi", $nombre, $precio, $descripcion, $cantidad);
    $stmt->execute();
    $product_id = $conn->insert_id;

    // Manejar la carga de múltiples imágenes
    foreach ($_FILES['fileToUpload']['tmp_name'] as $key => $value) {
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES['fileToUpload']['name'][$key]);
        if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'][$key], $target_file)) {
            $stmt_img = $conn->prepare("INSERT INTO imagenes_productos (producto_id, url_imagen) VALUES (?, ?)");
            $stmt_img->bind_param("is", $product_id, $target_file);
            $stmt_img->execute();
        }
    }

    // Insertar etiquetas asociadas
    if (isset($_POST['etiquetas'])) {
        foreach ($_POST['etiquetas'] as $etiqueta_id) {
            $stmt_etiqueta = $conn->prepare("INSERT INTO etiqueta_producto (producto_id, etiqueta_id) VALUES (?, ?)");
            $stmt_etiqueta->bind_param("ii", $product_id, $etiqueta_id);
            $stmt_etiqueta->execute();
        }
    }

    $stmt->close();
    $conn->close();

    // Redirigir al usuario a la página principal con un mensaje de éxito
    header("Location: cargar_Productos.php?status=success");
    exit;
} else {
    // Redirigir al usuario a la página principal con un mensaje de error
    header("Location: cargar_Productos.php?status=error");
    exit;
}
?>
