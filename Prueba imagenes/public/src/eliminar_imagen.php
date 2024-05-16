<?php
require 'config/db.php';  // Asegúrate de que este archivo contiene la conexión a tu base de datos

if (isset($_GET['image_id']) && is_numeric($_GET['image_id'])) {
    $image_id = $_GET['image_id'];
    $product_id = $_GET['product_id'];

    // Primero, obtener la URL de la imagen para poder eliminar el archivo
    $stmt = $conn->prepare("SELECT url_imagen FROM imagenes_productos WHERE id = ?");
    $stmt->bind_param("i", $image_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $file_path = $row['url_imagen'];

        // Intentar eliminar el archivo del servidor
        if (file_exists($file_path) && unlink($file_path)) {
            // Si el archivo se eliminó correctamente, eliminar la entrada de la base de datos
            $delete_stmt = $conn->prepare("DELETE FROM imagenes_productos WHERE id = ?");
            $delete_stmt->bind_param("i", $image_id);
            $delete_stmt->execute();

            if ($delete_stmt->affected_rows > 0) {
                echo "Imagen eliminada correctamente.";
            } else {
                echo "Error al eliminar la imagen de la base de datos.";
            }
        } else {
            echo "Error al eliminar el archivo de imagen.";
        }
    } else {
        echo "Imagen no encontrada.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Acceso no permitido.";
}

// Redirigir de vuelta a la página de edición del producto
 header("Location: administrar_productos.php?id=$product_id");
exit;
?>
