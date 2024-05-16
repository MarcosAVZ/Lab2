<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login de Personal</title>
    <link rel="stylesheet" href="/Prueba imagenes/public/diseño/Css/inicio_sesion.css">
</head>
<body>
<header>
        <?php include '../diseño/header.php'; ?>
</header>
<div class="login">
    <img src="/Prueba imagenes/public/diseño/imagenes/imagen_PsicoArte-removebg-preview.png" alt="Logo de PsicoArte">
        <form action="funciones/login.php" method="post">
        
            <label for="username">Correo o Nombre de Usuario</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" value="Ingresar">
        </form>
</div>
        <footer>
            <div class="footer-container">
                <div class="footer-logo">
                <a href="inicio_sesion.php">
                    <img src="/Prueba imagenes/public/diseño/imagenes/imagen_PsicoArte-removebg-preview.png" alt="Logo de PsicoArte">
                </a>
                </div>
                <div class="footer-links">
                    <a href="mailto:tuemail@example.com"><img src="ruta/a/email-icon.png" alt="Email Icon"></a>
                    <a href="tu-url-de-instagram"><img src="ruta/a/instagram-icon.png" alt="Instagram Icon"></a>
                    <a href="tu-url-de-facebook"><img src="ruta/a/facebook-icon.png" alt="Facebook Icon"></a>
                </div>
                <p>&copy; 2024 PsicoArte. Todos los derechos reservados.</p>
            </div>

    </footer>
</body>
</html>
