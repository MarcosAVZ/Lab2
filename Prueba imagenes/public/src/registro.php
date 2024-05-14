<?php
require 'config/db.php';  // Asegúrate de que este archivo contiene la conexión a tu base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $nombreUsuario = $_POST['nombre_usuario'];
    $password = $_POST['password'];

    // Crear un hash de la contraseña
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // Preparar la consulta SQL para insertar el usuario con el hash de su contraseña
    $stmt = $conn->prepare("INSERT INTO Personal (correo, nombre_usuario, contraseña, nombre) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $correo, $nombreUsuario, $passwordHash, $nombre);
    $stmt->execute();

    if ($stmt->affected_rows === 1) {
        echo "Usuario registrado con éxito.";
    } else {
        echo "Error al registrar el usuario.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Acceso no permitido.";
}
?>