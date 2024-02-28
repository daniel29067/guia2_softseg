<?php

session_start();
require("connect_db.php");

$user = $_POST['User'];
$password = $_POST['paswd'];

// Consultar si el usuario existe en la tabla users
$result = mysqli_query($mysqli, "SELECT * FROM users WHERE USERNAME = '$user'");
$row = mysqli_fetch_assoc($result);

// Verificar si el usuario existe
if ($row) {
    // Verificar si la contraseña es correcta
    if ($row['PASWD'] === $password) {
        // Iniciar sesión
        $_SESSION['USERID'] = $row['USERID'];
        $_SESSION['USERNAME'] = $row['USERNAME'];
        $_SESSION['id_nivel'] = $row['id_nivel'];

        // Redirigir al perfil
        echo '<script>alert("BIENVENIDO");
            location.href="../home.php";
            </script>';
    } else {
        // Contraseña incorrecta
        echo "<script>
            alert('Contraseña incorrecta');
            location.href='../index.php';
            </script>";
    }
} else {
    // El usuario no existe, mostrar alerta y redirigir a la parte de registro en index.php
    echo "<script>
            alert('Este usuario no existe. Por favor, regístrese para poder ingresar.');
            location.href='../index.php';
          </script>";
}
?>
