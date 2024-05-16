<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Etiqueta</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
        }
        label {
            margin-right: 10px;
            font-weight: bold;
        }
        input[type="text"] {
            border: 2px solid #ccc;
            border-radius: 4px;
            padding: 8px;
            width: 200px;
            margin-right: 10px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
            font-weight: bold;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <form action="upload_etiqueta.php" method="post">
        <label for="nombre">Agregar Etiqueta</label>
        <input type="text" name="nombre" id="nombre" placeholder="Agregar Nombre..." required>
        <input type="submit" value="Confirmar">
    </form>
</body>
</html>
