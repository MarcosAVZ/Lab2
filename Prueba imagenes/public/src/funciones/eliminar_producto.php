<?php
require '../config/db.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $product_id = $_GET['id'];

    // Inicia una transacción para asegurar que todas las operaciones se realicen juntas
    $conn->begin_transaction();

    try {
        // Primero, obtenemos todas las rutas de las imágenes asociadas al producto
        $stmt = $conn->prepare("SELECT url_imagen FROM imagenes_productos WHERE producto_id = ?");
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $images = [];
        while ($row = $result->fetch_assoc()) {
            $images[] = $row['url_imagen'];
        }

        // Elimina las imágenes asociadas al producto en la base de datos
        $stmt = $conn->prepare("DELETE FROM imagenes_productos WHERE producto_id = ?");
        $stmt->bind_param("i", $product_id);
        $stmt->execute();

        // Elimina físicamente las imágenes del servidor
        foreach ($images as $image) {
            if (file_exists($image)) {
                unlink($image);
            }
        }

        // Desvincula las etiquetas asociadas al producto
        $stmt = $conn->prepare("DELETE FROM etiqueta_producto WHERE producto_id = ?");
        $stmt->bind_param("i", $product_id);
        $stmt->execute();

        // Elimina el producto
        $stmt = $conn->prepare("DELETE FROM productos WHERE id = ?");
        $stmt->bind_param("i", $product_id);
        $stmt->execute();

        // Verifica que el producto se haya eliminado
        if ($stmt->affected_rows > 0) {
            $conn->commit();  // Confirma todas las operaciones de la transacción
            header("Location: ../index.php");  // Redirigir al index después de eliminar
            exit();
        } else {
            echo "No se pudo eliminar el producto.";
            $conn->rollback();  // Revierte la transacción si no se eliminó el producto
        }
    } catch (mysqli_sql_exception $e) {
        $conn->rollback();  // Revierte la transacción en caso de error
        echo "Error al eliminar el producto: " . $e->getMessage();
    }

    $stmt->close();
} else {
    echo "ID inválido.";
}

$conn->close();
?>
