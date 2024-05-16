<?php
require 'config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];

    $stmt = $conn->prepare("INSERT INTO noticias (titulo, descripcion, fecha_creacion) VALUES (?, ?, NOW())");
    $stmt->bind_param("ss", $titulo, $descripcion);
    $stmt->execute();
    $noticia_id = $conn->insert_id;

    // Manejar la carga de la imagen
    if (isset($_FILES['fileToUpload']['tmp_name']) && $_FILES['fileToUpload']['tmp_name'] != '') {
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES['fileToUpload']['name']);
        if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file)) {
            $stmt_img = $conn->prepare("INSERT INTO imagenes_productos (noticia_id, url_imagen) VALUES (?, ?)");
            $stmt_img->bind_param("is", $noticia_id, $target_file);
            $stmt_img->execute();
            $stmt_img->close();
        }
    }

    $stmt->close();
    $conn->close();

    // Redirigir al usuario a la página principal con un mensaje de éxito
    header("Location: administrar_noticias.php?status=success");
    exit;
} else {
    // Redirigir al usuario a la página de error o de intento fallido
    header("Location: administrar_noticias.php?status=error");
    exit;
}
?>
