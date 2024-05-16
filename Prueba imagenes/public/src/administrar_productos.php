<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Administrar Productos</title>
    <link rel="stylesheet" href="/Prueba imagenes/public/diseño/Css/administrar_productos.css">
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
        <?php
        require 'config/db.php';
        $productData = null;
        $isEditing = false;
        $selectedTags = [];
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $product_id = $_GET['id'];
            $stmt = $conn->prepare("SELECT * FROM productos WHERE id = ?");
            $stmt->bind_param("i", $product_id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $productData = $result->fetch_assoc();
                $isEditing = true;

                // Fetch associated tags
                $tagQuery = $conn->prepare("SELECT etiqueta_id FROM etiqueta_producto WHERE producto_id = ?");
                $tagQuery->bind_param("i", $product_id);
                $tagQuery->execute();
                $tagsResult = $tagQuery->get_result();
                while ($tag = $tagsResult->fetch_assoc()) {
                    $selectedTags[] = $tag['etiqueta_id'];
                }
            }
        }
        $actionUrl = $isEditing ? "actualizar_producto.php?id=$product_id" : "agregar_producto.php";
        ?>
        <form action="<?= $actionUrl ?>" method="post" enctype="multipart/form-data">
            <div class="form-section">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?= $productData['nombre'] ?? '' ?>" required>
            </div>
            <div class="form-section">
                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" value="<?= $productData['precio'] ?? '' ?>" step="0.01" required>
            </div>
            <div class="form-section">
                <label for="cantidad">Unidades Del Producto:</label>
                <input type="number" id="cantidad" name="cantidad" value="<?= $productData['cantidad'] ?? '' ?>" required>
            </div>
            <div class="form-section">
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion" required><?= $productData['descripcion'] ?? '' ?></textarea>
            </div>
            <div class="form-section">
                <label for="fileToUpload">Seleccionar Imagenes:</label>
                <input type="file" name="fileToUpload[]" multiple>
                <?php if ($isEditing): ?>
                <!-- Mostrar imágenes existentes con opción de eliminar -->
                <div class="existing-images">
                    <?php
                    // Fetch associated images
                    $imageQuery = $conn->prepare("SELECT id, url_imagen FROM imagenes_productos WHERE producto_id = ?");
                    $imageQuery->bind_param("i", $product_id);
                    $imageQuery->execute();
                    $imagesResult = $imageQuery->get_result();
                    while ($img = $imagesResult->fetch_assoc()): ?>
                        <div class="image-container">
                            <img src="<?= $img['url_imagen'] ?>" alt="Product Image" style="width: 100px; height: auto;">
                            <a href="eliminar_imagen.php?image_id=<?= $img['id'] ?>&product_id=<?= $product_id ?>">Eliminar</a>
                        </div>
                    <?php endwhile; ?>
                </div>
                <?php endif; ?>
            </div>
            <fieldset>
                <legend>Seleccionar Etiquetas</legend>
                <?php
                $etiquetas = $conn->query("SELECT id, nombre FROM etiquetas");
                while ($etiqueta = $etiquetas->fetch_assoc()) {
                    $checked = in_array($etiqueta['id'], $selectedTags) ? 'checked' : '';
                    echo "<input type='checkbox' id='etiqueta" . $etiqueta['id'] . "' name='etiquetas[]' value='" . $etiqueta['id'] . "' $checked>";
                    echo "<label for='etiqueta" . $etiqueta['id'] . "'>" . $etiqueta['nombre'] . "</label>";
                }
                ?>
            </fieldset>
            <div class="form-buttons">
                <input type="submit" name="submit" value="<?= $isEditing ? 'Actualizar' : 'Confirmar' ?>">
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

<?php

if (isset($_SESSION['message'])) {
    echo '<div id="tempMessage" style="position: fixed; top: 20px; right: 20px; background-color: #ccffcc; border: 1px solid green; padding: 10px;">' . $_SESSION['message'] . '</div>';
    unset($_SESSION['message']); // Limpiar el mensaje después de mostrarlo
}
?>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const message = document.getElementById('tempMessage');
    if (message) {
        setTimeout(function() {
            message.style.display = 'none';
        }, 5000);
    }
});
</script>
</body>
</html>





