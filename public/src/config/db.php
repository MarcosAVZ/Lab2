<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "psicoarte2";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Chequear conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>

