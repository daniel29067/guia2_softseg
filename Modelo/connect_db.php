<?php
$base_url = "http://localhost/software_seguro/guia2/";
$servername = "localhost";
$database = "softseg";
$username = "root";
$password = "";

// Create connection
$mysqli = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$mysqli) {
    die("Connection failed: " . mysqli_connect_error());
}


?>
