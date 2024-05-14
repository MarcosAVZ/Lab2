<?php
require 'config/db.php';  // Asegúrate de que la ruta al archivo de configuración de la base de datos es correcta

$target_dir = "../uploads/";
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0777, true); // Crea el directorio con permisos de lectura/escritura/ejecución para todos
}
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Verifica si el archivo es una imagen real
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            // Inserta la ruta de la imagen en la base de datos
            $stmt = $conn->prepare("INSERT INTO imagenes_productos (url_imagen) VALUES (?)");
            $stmt->bind_param("s", $target_file);
            $stmt->execute();
            echo "La imagen ha sido subida correctamente.";
        } else {
            echo "Hubo un error subiendo la imagen.";
        }
    } else {
        echo "El archivo no es una imagen.";
    }
}
?>
