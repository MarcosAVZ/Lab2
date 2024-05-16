<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Administrar</title>
    <link rel="stylesheet" href="/Prueba imagenes/public/diseño/Css/administracion.css">
</head>
<body>
    <header>
        <?php include '../diseño/header.php'; ?>
    </header>

    <div class="botonera">
        <a href="administrar_productos.php" class="boton grande">Administrar Productos</a>
        <a href="administrar_noticias.php" class="boton grande">Administrar Noticias</a>
    </div>

<div class="form-etiqueta">
    <form action="upload_etiqueta.php" method="post" class="horizontal-form">
        <h2 for="nombre">Agregar Etiqueta</h2>
        <input type="text" id="nombre" name="nombre" placeholder="Agregar Nombre..." required>
        <input type="submit" value="Confirmar">
    </form>
</div>
</body>
</html>