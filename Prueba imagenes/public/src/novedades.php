<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Noticias</title>
    <link rel="stylesheet" href="/Prueba imagenes/public/diseño/Css/novedades.css">
</head>
<body>
    <header>
        <?php include '../diseño/header.php'; ?>
    </header>
    <?php
    require 'config/db.php';

    $stmt = $conn->prepare("SELECT noticias.id, noticias.Titulo, noticias.Descripcion, noticias.Fecha_Creacion, imagenes_productos.url_imagen FROM noticias LEFT JOIN imagenes_productos ON noticias.id = imagenes_productos.noticia_id");
    $stmt->execute();
    $result = $stmt->get_result();

    while ($noticia = $result->fetch_assoc()) {
        echo "<div class='noticia-container'>";
        echo "<div class='noticia-imagen'>";
        echo "<img src='" . htmlspecialchars($noticia['url_imagen']) . "' alt='Imagen de Noticia'>";
        echo "</div>";
        echo "<div class='noticia-texto'>";
        echo "<h2>" . htmlspecialchars($noticia['Titulo']) . "</h2>";
        echo "<p>" . nl2br(htmlspecialchars($noticia['Descripcion'])) . "</p>";
        
        // Comprobación de la sesión del personal para mostrar botones de editar y eliminar
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            echo "<div class='admin-buttons'>";
            echo "<a href='administrar_noticias.php?id=" . $noticia['id'] . "' class='edit-button'>Editar</a>";
            echo "<a href='funciones/eliminar_noticias.php?id=" . $noticia['id'] . "' class='delete-button'>Eliminar</a>";
            echo "</div>";
        }
        
        echo "</div>";
        echo "<p class='fecha-publicacion'>" . date("d/m/Y", strtotime($noticia['Fecha_Creacion'])) . "</p>";
        echo "</div>";
    }
    ?>
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
