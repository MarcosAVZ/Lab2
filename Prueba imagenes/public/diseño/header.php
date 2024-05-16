<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Sitio Web</title>
    <link rel="stylesheet" href="/Prueba imagenes/public/diseño/Css/header.css">
</head>
<body>
    <?php
    session_start(); // Asegúrate de iniciar la sesión aquí para poder usar $_SESSION
    ?>
    <header>
        <div class="header-container">
            <div class="logo">
                <img src='/Prueba imagenes/public/diseño/imagenes/logo-tipo-2.png' alt="Logo de PsicoArte">
            </div>
            <nav>
                <ul>
                    <li><a href="/Prueba imagenes/public/src/novedades.php">Novedades</a></li>
                    <li><a href='/Prueba imagenes/public/src/index.php'>Productos</a></li>
                    <?php
                    // Verifica si el usuario está logueado
                    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
                        echo '<li><a href="/Prueba imagenes/public/src/administracion.php">Administrar</a></li>';
                        echo '<li><a href="/Prueba imagenes/public/src/funciones/logout.php">Cerrar Sesion</a></li>';
                    }
                    ?>
                </ul>
            </nav>
        </div>
    </header>
</body>
</html>

