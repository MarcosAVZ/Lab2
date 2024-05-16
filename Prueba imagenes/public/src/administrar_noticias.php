<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Administrar Noticias</title>
    <link rel="stylesheet" href="/Prueba imagenes/public/diseño/Css/administrar_noticias.css">
</head>
<body>
    <header>
        <?php include '../diseño/header.php'; ?>
    </header>
    <div class="admin-panel">
        <button onclick="toggleNewsMenu()" class="toggle-button">☰ Administrar Noticias</button>
        <h2 class="admin-title">Administrar Noticias</h2>
    </div>
    <div id="newsForm" style="display:none;">
        <?php
        require 'config/db.php';
        $newsData = null;
        $isEditing = false;
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $news_id = $_GET['id'];
            $stmt = $conn->prepare("SELECT * FROM noticias WHERE id = ?");
            $stmt->bind_param("i", $news_id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $newsData = $result->fetch_assoc();
                $isEditing = true;
            }
        }
        $actionUrl = $isEditing ? "agregar_noticia.php?id=$news_id" : "agregar_noticia.php";
        ?>
        <form action="<?= $actionUrl ?>" method="post" enctype="multipart/form-data">
            <div class="form-section">
                <label for="titulo">Título:</label>
                <input type="text" id="titulo" name="titulo" value="<?= $newsData['titulo'] ?? '' ?>" required>
            </div>
            <div class="form-section">
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion" required><?= $newsData['descripcion'] ?? '' ?></textarea>
            </div>
            <div class="form-section">
                <label for="fileToUpload">Seleccionar Imagen:</label>
                <input type="file" name="fileToUpload">
            </div>
            <div class="form-buttons">
                <input type="submit" name="submit" value="<?= $isEditing ? 'Actualizar' : 'Confirmar' ?>">
                <button type="reset" class="reset-button">Limpiar</button>
            </div>
        </form>
    </div>

    <script>
        function toggleNewsMenu() {
            var x = document.getElementById("newsForm");
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
        unset($_SESSION['message']); // Clear the message after displaying it
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
