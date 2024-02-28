<?php
session_start();
// Verifica si $_SESSION['USERID'] está definido y no es nulo
if (isset($_SESSION['USERID'])) {
   // Escapa el valor de $_SESSION['USERID'] para evitar problemas de seguridad
   $USERID = htmlspecialchars($_SESSION['USERID']);

   // Imprime el valor de $_SESSION['USERID'] dentro de un script de JavaScript
   echo "<script>console.log('$USERID');</script>";
} else {
   // Si $_SESSION['USERID'] no está definido, imprime un mensaje de error en la consola
   echo "<script>console.log('ERROR: $_SESSION[USERID] no está definido');</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="Vista/CSS/Student_form.css">
   <link rel="icon" href="https://static.thenounproject.com/png/963312-200.png">
   <title>Student</title>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script>
      //ENVIAR LOS DATOS EN JSON AL ENDPOINT

      $(document).ready(function() {
         $("input[type='submit']").click(function(event) {
            event.preventDefault(); // Evita que el formulario se envíe de forma estándar

            // Obtiene los valores del formulario
            var NAME = $("#NAME").val();
            var LAST = $("#LAST").val();
            var PROGRAM = $("#PROGRAM").val();
            var USERID = "<?php echo isset($_SESSION['USERID']) ? $_SESSION['USERID'] : 'null'; ?>";

            // Crea un objeto JavaScript con los datos
            var datos = {
               NAME: NAME,
               LAST: LAST,
               PROGRAM: PROGRAM,
               USERID: USERID
            };

            // Convierte el objeto en una cadena JSON
            var jsonDatos = JSON.stringify(datos);

            // Realiza una solicitud AJAX para enviar los datos en formato JSON
            $.ajax({
               type: "POST", // Método HTTP POST
               url: "Controlador/ctr_student.php?accion=crear-student", // URL del endpoint de la API
               data: jsonDatos, // Datos en formato JSON
               contentType: "application/json", // Tipo de contenido JSON
               success: function(response) {
                  // Verifica la respuesta del servidor
                  if (response === "Estudiante Registrado con Exito") {
                     // Usuario registrado correctamente
                     alert("Estudiante Creado con éxito!");
                     $("#NAME").val("");
                     $("#LAST").val("");
                     $("#PROGRAM").val("");
                  } else {
                     // Hubo un problema al registrar el usuario
                     $("#NAME").val("");
                     $("#LAST").val("");
                     $("#PROGRAM").val("");
                     alert(response);
                  }
               },
               error: function(error) {
                  // Error en la solicitud AJAX
                  $("#NAME").val("");
                     $("#LAST").val("");
                     $("#PROGRAM").val("");
                  alert("¡Error al crear Estudiante!");
                  console.error(error);
               }
            });
         });
      });
   </script>
</head>

<body>
   <div class="container">
      <div class="text">
         Registro estudiante
      </div>
      <form action="Modelo/mod_student.php" method="POST">
         <div class="form-row">
            <div class="input-data">
               <input type="text" id="NAME" required>
               <div class="underline"></div>
               <label for="">Nombre</label>
            </div>
            <div class="input-data">
               <input type="text" id="LAST" required>
               <div class="underline"></div>
               <label for="">Apellido</label>
            </div>
            <div class="input-data">gi
               <input type="text" id="PROGRAM" required>
               <div class="underline"></div>
               <label for="">Programa</label>
            </div>
         </div>
         <div class="form-row submit-btn">
            <div class="input-data">
               <div class="inner"></div>
               <input type="submit" value="submit">
            </div>
            <div class="input-data">
               <div class="inner"></div>
               <a href="home.php"><input type="button" value="Cancelar"></a>
            </div>
         </div>
      </form>
   </div>
</body>

</html>
