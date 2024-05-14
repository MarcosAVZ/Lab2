<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Administrar Productos</title>
    <link rel="stylesheet" href="/Prueba imagenes/public/diseño/Css/cargar_Productos.css">
</head>
<body>
     <header>
        <?php include '../diseño/header.php'; ?>
    </header>
<div class="admin-panel">
    <button onclick="toggleMenu()" class="toggle-button">☰ Administrar Productos</button>
    <h2 class="admin-title">Administrar Productos</h2>
</div>
<div id="productForm">
    <form action="agregar_producto.php" method="post" enctype="multipart/form-data">
        <div class="form-section">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
        </div>
        <div class="form-section">
            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" step="0.01" required>
        </div>
        <div class="form-section">
            <label for="cantidad">Unidades Del Producto:</label>
            <input type="number" id="cantidad" name="cantidad" required>
        </div>
        <div class="form-section">
            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" required></textarea>
        </div>
        <div class="form-section">
            <label for="fileToUpload">Seleccionar Imagenes:</label>
            <input type="file" name="fileToUpload[]" multiple>
        </div>
        <fieldset>
            <legend>Seleccionar Etiquetas</legend>
            <!-- Asumiendo que las etiquetas están almacenadas en la base de datos -->
            <?php
            require 'config/db.php';
            $etiquetas = $conn->query("SELECT id, nombre FROM etiquetas");
            while ($etiqueta = $etiquetas->fetch_assoc()) {
                echo "<input type='checkbox' id='etiqueta" . $etiqueta['id'] . "' name='etiquetas[]' value='" . $etiqueta['id'] . "'>";
                echo "<label for='etiqueta" . $etiqueta['id'] . "'>" . $etiqueta['nombre'] . "</label>";
            }
            $conn->close();
            ?>
        </fieldset>
        <div class="form-buttons">
            <input type="submit" name="submit" value="Confirmar">
            <button type="reset" class="reset-button">Limpiar</button>
        </div>
    </form>
</div>

<script>
    function toggleMenu() {
        var x = document.getElementById("productForm");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }
</script>
</body>
</html>