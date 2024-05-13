<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Producto</title>
</head>
<body>
    <h1>Agregar Nuevo Producto</h1>
    <form action="upload_product.php" method="post" enctype="multipart/form-data">
        <label for="nombre">Nombre del producto:</label>
        <input type="text" name="nombre" id="nombre" required><br><br>

        <label for="precio">Precio:</label>
        <input type="number" step="0.01" name="precio" id="precio" required><br><br>

        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" id="descripcion" required></textarea><br><br>

        <label for="cantidad">Cantidad:</label>
        <input type="number" name="cantidad" id="cantidad" required><br><br>

        <label for="fileToUpload">Seleccione imágenes para cargar:</label>
        <input type="file" name="fileToUpload[]" id="fileToUpload" multiple><br><br>

        <fieldset>
            <legend>Seleccionar etiquetas:</legend>
            <?php
            require 'config/db.php';
            $query = "SELECT id, nombre FROM etiquetas";
            $result = $conn->query($query);
            while ($row = $result->fetch_assoc()) {
                echo "<label>";
                echo "<input type='checkbox' name='etiquetas[]' value='" . $row['id'] . "'> " . htmlspecialchars($row['nombre']);
                echo "</label><br>";
            }
            $conn->close();
            ?>
        </fieldset><br>

        <input type="submit" value="Agregar Producto" name="submit">
    </form>
</body>
</html>
