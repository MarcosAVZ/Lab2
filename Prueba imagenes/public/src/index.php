<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Productos</title>
    <link rel="stylesheet" href="/Prueba imagenes/public/diseño/Css/index.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
</head>
<body>
    <header>
        <?php include '../diseño/header.php'; ?>
    </header>

    <main>
        <!-- Producto destacado -->
        <div class="featured-product">
            <?php
            require 'config/db.php';
            $sql = "SELECT p.id, p.nombre, p.descripcion, im.url_imagen FROM productos p JOIN imagenes_productos im ON p.id = im.producto_id ORDER BY RAND() LIMIT 1";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo "<div class='producto_destacado'>";
                echo "<img src='" . htmlspecialchars($row['url_imagen']) . "' alt='Producto' />";
                echo "<div class='product-info'>";
                echo "<h3>" . htmlspecialchars($row['nombre']) . "</h3>";
                echo "<p>" . htmlspecialchars($row['descripcion']) . "</p>";
                echo "</div>"; // Cierre de div.product-info
                echo "</div>"; // Cierre de div.producto_destacado
            }
            ?>
        </div>
        <h1>Productos</h1>
        <div class="form-search">
    <form action="index.php" method="get" class="search-form">
        <input type="text" name="search" placeholder="Buscar por nombre..." class="search-input" style="width: 200px; padding: 5px; margin-right: 10px;">
        <select name="tags[]" multiple="multiple" id="multi-select-tags" style="width: 300px;">
            <?php
            require 'config/db.php';
            $query = "SELECT id, nombre FROM etiquetas";
            $result = $conn->query($query);
            while ($tag = $result->fetch_assoc()) {
                echo "<option value='" . $tag['id'] . "'>" . htmlspecialchars($tag['nombre']) . "</option>";
            }
            ?>
        </select>
        <button type="submit" class="search-button">Buscar</button>
    </form>
    </div>
    <div class="container">
    <?php
$search = $_GET['search'] ?? '';
$tags = $_GET['tags'] ?? [];
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$results_per_page = 4;
$start_from = ($page - 1) * $results_per_page;

// Crear la consulta base
$query = "SELECT p.id, p.nombre, p.descripcion, MIN(i.url_imagen) AS url_imagen 
          FROM productos p 
          LEFT JOIN imagenes_productos i ON p.id = i.producto_id ";
$whereConditions = [];
$params = []; // Inicializa el array de parámetros

if (!empty($tags)) {
    $tagPlaceholders = implode(',', array_fill(0, count($tags), '?'));
    $whereConditions[] = "ep.etiqueta_id IN ($tagPlaceholders)";
    $params = array_merge($params, array_map('intval', $tags));
}

if (!empty($search)) {
    $whereConditions[] = "p.nombre LIKE ?";
    $params[] = "%{$search}%";
}

if (!empty($whereConditions)) {
    $query .= "LEFT JOIN etiqueta_producto ep ON p.id = ep.producto_id WHERE " . implode(' AND ', $whereConditions);
}

$query .= " GROUP BY p.id ORDER BY p.id LIMIT ?, ?";
$params[] = $start_from;  // Parámetros para la paginación
$params[] = $results_per_page;

if (!empty($params)) {
    $stmt = $conn->prepare($query);
    $types = str_repeat('s', count($params) - 2) . 'ii';
    $stmt->bind_param($types, ...$params);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = $conn->query($query);
}
// Mostrar productos
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='producto'>";
        echo "<a href='detalles_producto.php?id=" . $row['id'] . "'>";
        echo "<img src='" . htmlspecialchars($row['url_imagen']) . "' alt='Imagen del producto' style='width:100%;'>";
        echo "</a>";
        echo "<h2>" . htmlspecialchars($row['nombre']) . "</h2>";
        echo "<p>" . htmlspecialchars($row['descripcion']) . "</p>";
        echo "</div>";
    }
} else {
    echo "<p>No se encontraron productos.</p>";
}


// Contar el total de resultados sin límite
$count_query = "SELECT COUNT(DISTINCT p.id) AS total FROM productos p 
                LEFT JOIN imagenes_productos i ON p.id = i.producto_id ";
if (!empty($whereConditions)) {
    $count_query .= "LEFT JOIN etiqueta_producto ep ON p.id = ep.producto_id WHERE " . implode(' AND ', $whereConditions);
    $count_stmt = $conn->prepare($count_query);
    $count_stmt->bind_param(str_repeat('s', count($params) - 2), ...array_slice($params, 0, -2));
    $count_stmt->execute();
    $count_result = $count_stmt->get_result()->fetch_assoc();
} else {
    $count_result = $conn->query($count_query)->fetch_assoc();
}
$total_pages = ceil($count_result['total'] / $results_per_page);

// Paginación
echo "<div class='pagination'>";
for ($i = 1; $i <= $total_pages; $i++) {
    echo "<a href='index.php?page=$i" . ($search ? "&search=$search" : "") . 
         (!empty($tags) ? "&tags[]=" . implode('&tags[]=', $tags) : "") . 
         "'" . ($i == $page ? " class='current'" : "") . ">$i</a> ";
}
echo "</div>";
?>



</div>

        <script>
        $(document).ready(function() {
            $('#multi-select-tags').select2({
                placeholder: "Seleccionar etiquetas",
                allowClear: true,
                width: 'resolve' // Esto permite que el select2 sea responsivo
            });
        });
        </script>
        <a href="cargar_Productos.php">agregar imagen</a>
        <a href="cargar_etiqueta.php">agregar etiqueta</a>
        <a href="inicio_sesion.php">Login</a>
        <a href="registro_form.php">Registro</a>
    </main>

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




