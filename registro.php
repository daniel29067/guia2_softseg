<?php
$id_nivel = isset($_GET["id_nivel"]) ? $_GET["id_nivel"] : 'error';
require("Modelo/connect_db.php");

$result = mysqli_query($mysqli, "SELECT des_nivel FROM nivel WHERE id_nivel = '$id_nivel'");
$row = mysqli_fetch_assoc($result);
$des_nivel = $row['des_nivel'];

// Verificar si es el primer usuario registrado
$primer_usuario = false;
$result_count = mysqli_query($mysqli, "SELECT COUNT(*) AS count FROM users");
$row_count = mysqli_fetch_assoc($result_count);
$user_count = $row_count['count'];

if ($user_count == 0) {
    $primer_usuario = true;
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    //ENVIAR LOS DATOS EN JSON AL ENDPOINT

    $(document).ready(function() {
    $("form").submit(function(event) {
        event.preventDefault(); // Evita que el formulario se envíe de forma estándar

        // Obtiene los valores del formulario
        var USERID = $("#USERID").val();
        var USERNAME = $("#USERNAME").val();
        var PASWD = $("#PASWD").val();
        var id_nivel = $("#id_nivel").val();

        // Crea un objeto JavaScript con los datos
        var datos = {
            USERID: USERID,
            USERNAME: USERNAME,
            PASWD: PASWD,
            id_nivel: id_nivel
        };

        // Convierte el objeto en una cadena JSON
        var jsonDatos = JSON.stringify(datos);

        // Realiza una solicitud AJAX para enviar los datos en formato JSON
        $.ajax({
            type: "POST", // Método HTTP POST
            url: "Controlador/ctr_user.php?accion=crear-user", // URL del endpoint de la API
            data: jsonDatos, // Datos en formato JSON
            contentType: "application/json", // Tipo de contenido JSON
            success: function(response) {
                // Verifica la respuesta del servidor
                if (response === "Usuario Registrado con Exito") {
                    // Usuario registrado correctamente
                    alert("¡Usuario Creado con éxito!");
                    // Redirige al usuario a la página de inicio de sesión
                    window.location.href = "index.php";
                } else {
                    // Hubo un problema al registrar el usuario
                    alert(response);
                }
            },
            error: function(error) {
                // Error en la solicitud AJAX
                alert("¡Error al crear Usuario!");
                console.error(error);
                // Limpia el formulario
                $("#USERID").val("");
                $("#USERNAME").val("");
                $("#PASWD").val("");
                $("#id_nivel").val("");
            }
        });
    });
});

</script>
</head>

<body>
    <div class="container" id="container">
        <div class="form-container sign-in-container">
            <form action="Controlador/ctr_user.php?accion=crear-user" method="post">
                <h1>Create Account</h1>
                <span>or use your email for registration</span>
                <input type="number" name="USERID" id="USERID" placeholder="Id" required />
                <input type="text" name="USERNAME"id="USERNAME" placeholder="Username" required />
                <input type="password" name="PASWD" id="PASWD" placeholder="Password" required/>
                <?php if ($primer_usuario){ ?>
                    <input type="hidden" name="id_nivel" id="id_nivel" value="<?php echo $id_nivel; ?>" />
                    <input type="text" name="des_nivel" id="des_nivel" placeholder="<?php echo $des_nivel; ?>" disabled />

                <?php }else { ?>
                    <select name="id_nivel" id="id_nivel" required>
                        <?php
                        // Obtener los niveles diferentes a 0
                        $nivel_query = mysqli_query($mysqli, "SELECT id_nivel, des_nivel FROM nivel WHERE id_nivel != 0");
                        while ($row = mysqli_fetch_assoc($nivel_query)) {
                            echo "<option value='" . $row['id_nivel'] . "'>" . $row['des_nivel'] . "</option>";
                        }
                    }
                        ?>
                    </select>
                <button type="submit" name="sign_up">Sign Up</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-right">
                    <h1>Welcome Back!</h1>
                    <p>To keep connected with us please login with your personal info</p>
                    <a href="index.php"><button class="ghost" id="signIn">Sign In</button></a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>