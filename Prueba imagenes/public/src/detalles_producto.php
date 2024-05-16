<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalles del Producto</title>
    <link rel="stylesheet" href="/Prueba imagenes/public/diseño/Css/detalles_producto.css">
</head>
<body>
    <header>
        <?php include '../diseño/header.php'; ?>
    </header>
    <main class="product-details">
    <?php
        require 'config/db.php'; 
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $product_id = $_GET['id'];

            // Preparar y ejecutar la consulta para obtener los detalles del producto
            $stmt = $conn->prepare("SELECT p.id, p.nombre, p.descripcion, p.precio, i.url_imagen
                FROM productos p
                JOIN imagenes_productos i ON p.id = i.producto_id
                WHERE p.id = ?");
            $stmt->bind_param("i", $product_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $producto = $result->fetch_assoc();
                echo "<div class='product-container'>";
                echo "<div class='product-image'>";
                echo "<img src='" . htmlspecialchars($producto['url_imagen']) . "' alt='Imagen del producto'>";
                echo "</div>";
                echo "<div class='product-info'>";
                echo "<h1>" . htmlspecialchars($producto['nombre']) . "</h1>";
                echo "<p class='description'>" . htmlspecialchars($producto['descripcion']) . "</p>";
                echo "<p class='price'>ARS$" . htmlspecialchars($producto['precio']) . "</p>";

                // Consulta para etiquetas
                $tagStmt = $conn->prepare("SELECT e.nombre FROM etiquetas e
                    JOIN etiqueta_producto ep ON e.id = ep.etiqueta_id
                    WHERE ep.producto_id = ?");
                $tagStmt->bind_param("i", $product_id);
                $tagStmt->execute();
                $tagResult = $tagStmt->get_result();

                $etiquetas = [];
                while ($tagRow = $tagResult->fetch_assoc()) {
                    $etiquetas[] = $tagRow['nombre'];
                }
                $tagStmt->close();

                // Mostrar etiquetas solo si hay alguna
                if (!empty($etiquetas)) {
                    echo "<div class='tags'>";
                    foreach ($etiquetas as $etiqueta) {
                        echo "<span>" . htmlspecialchars($etiqueta) . "</span>";
                    }
                    echo "</div>";
                }

                echo "</div>"; // Close product-info
                echo "</div>"; // Close product-container
            } else {
                echo "<p>Producto no encontrado.</p>";
            }
            $stmt->close();
        } else {
            echo "<p>ID de producto inválido.</p>";
        }
        
    ?>
</main>
<?php 
    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
        echo "<div class='product-actions'>";
             echo "<a href='javascript:void(0);' onclick='confirmDelete(" . $producto['id'] . ")' class='delete-button'>Eliminar Producto</a>";
            echo "<a href='administrar_productos.php?id=" . $producto['id'] . "' class='edit-button'>Editar Producto</a>";
        echo "</div>"; // Close product-actions
    }
?>
<script>
    function confirmDelete(productId) {
        if (confirm("¿Estás seguro de que deseas eliminar este producto? Esta acción no se puede deshacer.")) {
            window.location.href = 'funciones/eliminar_producto.php?id=' + productId;
        }
    }
</script>
<div class="whatsapp-section">
    <p>Para proceder con la compra comunicarse al WhatsApp</p>
    <?php
        $numero = "5493735442240"; // Ajusta el número de WhatsApp
        $mensaje = "Hola, estoy interesado en más información sobre este producto " . $producto['nombre'] . ".";
        $mensajeUrl = urlencode($mensaje);
        echo "<a href='https://wa.me/$numero?text=$mensajeUrl' class='whatsapp-link'>WhatsApp</a>";
    ?>
</div>

<div class="similar-products-container">
    <h2>Productos Similares:</h2>
    <div class='similar-products'>
        <?php
            $similarProductsStmt = $conn->prepare("
                SELECT p2.id, p2.nombre, i.url_imagen, COUNT(*) as relevance
                FROM etiqueta_producto ep
                JOIN etiqueta_producto ep2 ON ep.etiqueta_id = ep2.etiqueta_id AND ep.producto_id != ep2.producto_id
                JOIN productos p2 ON ep2.producto_id = p2.id
                JOIN imagenes_productos i ON p2.id = i.producto_id
                WHERE ep.producto_id = ?
                GROUP BY p2.id, p2.nombre, i.url_imagen
                ORDER BY relevance DESC
                LIMIT 5
            ");
            $similarProductsStmt->bind_param("i", $product_id);
            $similarProductsStmt->execute();
            $similarProductsResult = $similarProductsStmt->get_result();

            if ($similarProductsResult->num_rows > 0) {
                while ($similarProduct = $similarProductsResult->fetch_assoc()) {
                    echo "<div class='similar-product'>";
                    echo "<a href='detalles_producto.php?id=" . $similarProduct['id'] . "'>";
                    echo "<img src='" . htmlspecialchars($similarProduct['url_imagen']) . "' alt='Imagen del producto' style='width:100%;'>";
                    echo "</a>";
                    echo "<h2>" . htmlspecialchars($similarProduct['nombre']) . "</h2>";
                    echo "</div>";
                }
            }
            $similarProductsStmt->close();
            $conn->close();
        ?>
    </div>
</div>
    <footer>
        <div class="footer-container">
            <div class="footer-logo">
                <img src='../diseño/imagenes/imagen_PsicoArte-removebg-preview.png' alt="Logo de PsicoArte">
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
