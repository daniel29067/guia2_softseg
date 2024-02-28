<?php

session_start();
require("Modelo/connect_db.php");

// Consultar la tabla de usuarios
$result = mysqli_query($mysqli, "SELECT COUNT(*) AS count FROM users");
$row = mysqli_fetch_assoc($result);
$user_count = $row['count'];


// Verificar si hay registros en la tabla de usuarios
if ($user_count == 0) {
    // No hay registros, establecer id_nivel en 0
    $id_nivel = 0;
    // Redirigir a registro.php con el nivel proporcionado como parámetro GET
    header("Location: registro.php?id_nivel=$id_nivel");
    exit; // Terminar el script para evitar que se cargue index.php
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width-device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Vista/CSS/index.css">
    <link rel="icon" href="https://static.thenounproject.com/png/963312-200.png">
    <title>Guia 2</title>
</head>

<body>
    <div class="container" id="container">
        <div class="form-container sign-in-container">
            <form action="Modelo/validar.php" method="post">
                <h1>Sign in</h1>
                <span>or use your account</span>
                <input type="text" name="User" id="User" placeholder="User" required/>
                <input type="password" name="paswd" name="paswd" placeholder="Password" required/>
                <a href="#">Forgot your password?</a>
                <button>Sign In</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>To keep connected with us please login with your personal info</p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hello, Friend!</h1>
                    <p>Enter your personal details and start journey with us</p>
                    <a href="registro.php"> <button class="ghost" id="signUp">Sign Up</button></a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>