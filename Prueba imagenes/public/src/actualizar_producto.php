<?php
require 'config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['id']) && is_numeric($_GET['id'])) {
    $product_id = $_GET['id'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $descripcion = $_POST['descripcion'];
    $cantidad = $_POST['cantidad'];

    // Actualizar la información del producto
    $stmt = $conn->prepare("UPDATE productos SET nombre = ?, precio = ?, descripcion = ?, cantidad = ? WHERE id = ?");
    $stmt->bind_param("sdsii", $nombre, $precio, $descripcion, $cantidad, $product_id);
    $result = $stmt->execute();

    // Verificar y manejar la carga de imágenes
    if (!empty($_FILES['fileToUpload']['name'][0])) {
        // Eliminar imágenes antiguas o manejar según la lógica de negocio
        // Insertar nuevas imágenes
        foreach ($_FILES['fileToUpload']['tmp_name'] as $key => $value) {
            $target_dir = "../uploads/";
            $target_file = $target_dir . basename($_FILES['fileToUpload']['name'][$key]);
            if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'][$key], $target_file)) {
                $stmt_img = $conn->prepare("INSERT INTO imagenes_productos (producto_id, url_imagen) VALUES (?, ?)");
                $stmt_img->bind_param("is", $product_id, $target_file);
                $stmt_img->execute();
            }
        }
    }

    // Actualizar etiquetas si es necesario
    if (isset($_POST['etiquetas'])) {
        // Borrar etiquetas antiguas
        $delete_stmt = $conn->prepare("DELETE FROM etiqueta_producto WHERE producto_id = ?");
        $delete_stmt->bind_param("i", $product_id);
        $delete_stmt->execute();

        // Insertar nuevas etiquetas
        foreach ($_POST['etiquetas'] as $etiqueta_id) {
            $stmt_etiqueta = $conn->prepare("INSERT INTO etiqueta_producto (producto_id, etiqueta_id) VALUES (?, ?)");
            $stmt_etiqueta->bind_param("ii", $product_id, $etiqueta_id);
            $stmt_etiqueta->execute();
        }
    }

    if ($result) {
        echo "Producto actualizado con éxito.";
        header("Location: index.php"); // Redirigir al index después de actualizar
    } else {
        echo "Error al actualizar el producto.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Acceso no permitido.";
}
?>
