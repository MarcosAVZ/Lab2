<?php
require '../config/db.php'; // Asegúrate de que la conexión a la base de datos está configurada correctamente

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $news_id = $_GET['id'];

    // Inicia una transacción para asegurar que todas las operaciones se realicen juntas
    $conn->begin_transaction();

    try {
        // Primero, obtenemos todas las rutas de las imágenes asociadas a la noticia
        $stmt = $conn->prepare("SELECT url_imagen FROM imagenes_productos WHERE noticia_id = ?");
        $stmt->bind_param("i", $news_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $images = [];
        while ($row = $result->fetch_assoc()) {
            $images[] = $row['url_imagen'];
        }

        // Elimina las imágenes asociadas a la noticia en la base de datos
        $stmt = $conn->prepare("DELETE FROM imagenes_productos WHERE noticia_id = ?");
        $stmt->bind_param("i", $news_id);
        $stmt->execute();

        // Elimina físicamente las imágenes del servidor
        foreach ($images as $image) {
            if (file_exists($image)) {
                unlink($image);
            }
        }

        // Elimina la noticia
        $stmt = $conn->prepare("DELETE FROM noticias WHERE id = ?");
        $stmt->bind_param("i", $news_id);
        $stmt->execute();

        // Verifica que la noticia se haya eliminado
        if ($stmt->affected_rows > 0) {
            $conn->commit();  // Confirma todas las operaciones de la transacción
            header("Location: ../novedades.php");  // Redirigir al index después de eliminar
            exit();
        } else {
            echo "No se pudo eliminar la noticia.";
            $conn->rollback();  // Revierte la transacción si no se eliminó la noticia
        }
    } catch (mysqli_sql_exception $e) {
        $conn->rollback();  // Revierte la transacción en caso de error
        echo "Error al eliminar la noticia: " . $e->getMessage();
    }

    $stmt->close();
} else {
    echo "ID inválido.";
}

$conn->close();
?>
