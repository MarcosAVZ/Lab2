<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login de Personal</title>
</head>
<body>
    <h2>Login de Personal</h2>
    <form action="funciones/login.php" method="post">
        <label for="username">Correo o Nombre de Usuario:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" value="Ingresar">
    </form>
</body>
</html>
