<?php
session_start(); // Iniciar sesión al comienzo del script para manejar las sesiones correctamente

require '../config/db.php';  // Asegúrate de que este archivo contiene la conexión a tu base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Preparar la consulta SQL para buscar el usuario
    $stmt = $conn->prepare("SELECT contraseña FROM Personal WHERE correo = ? OR nombre_usuario = ?");
    $stmt->bind_param("ss", $username, $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        // Verificar la contraseña
        if (password_verify($password, $user['contraseña'])) {
            // Si la contraseña es correcta, configurar la sesión
            $_SESSION['usuario'] = $username;
            $_SESSION['logged_in'] = true;  // Se puede agregar más información de sesión si es necesario

            // Redirigir al usuario a una página segura
            header("Location: ../index.php");
            exit; // Es importante llamar a exit después de header para terminar la ejecución del script
        } else {
            echo "Usuario o contraseña incorrectos.";
        }
    } else {
        echo "Usuario o contraseña incorrectos.";
    }

    $stmt->close();
    $conn->close();
} else {
    // Si no es una solicitud POST, redirigir al formulario de inicio de sesión
    header("Location: ../login.php");
    exit;
}
?>

