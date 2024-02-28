<?php
require_once '../Modelo/mod_user.php';

$controlador = new Modelo();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Acción: Crear Cliente
    if (isset($_GET['accion']) && $_GET['accion'] === 'crear-user') {
         // Lee los datos JSON del cuerpo de la solicitud
         $json_data = file_get_contents('php://input');
         $data = json_decode($json_data);
       // Verifica si se pudieron decodificar los datos JSON correctamente
         // Verifica si se pudieron decodificar los datos JSON correctamente
         if ($data) {
            $USERID=$data->USERID;
            $USERNAME = $data->USERNAME;
            $PASWD = $data->PASWD;
            $id_nivel = $data->id_nivel;
            $resultado = $controlador->crearUser($USERID, $USERNAME, $PASWD, $id_nivel);

           
        } else {
            echo "$data";
            echo "Error al decodificar los datos JSON.";
        }
    }else {
        echo "Acción no válida.";
    }

} elseif ($_SERVER["REQUEST_METHOD"] === "GET") {
    // Acción: Consultar todos los Clientes
    if (isset($_GET['accion']) && $_GET['accion'] === 'consultar-user') {
        $resultados = $controlador->ConsultarAllCliente();

        if ($resultados !== false) {
            header('Content-Type: application/json');
            echo $resultados;
        } else {
            echo "Error al consultar los Clientes.";
        }
    } elseif (isset($_GET['accion']) && $_GET['accion'] === 'consultar-user-id') {
        // Acción: Consultar Cliente por ID
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $resultados = $controlador->consultarClientesPorId($id);

            if ($resultados !== false) {
                header('Content-Type: application/json');
                echo $resultados;
            } else {
                echo "Error al consultar el Cliente por ID.";
            }
        } else {
            echo "ID de Cliente no proporcionado.";
        }
    } else {
        echo "Acción no válida.";
    } 
} elseif ($_SERVER["REQUEST_METHOD"] === "DELETE") {
    if (isset($_GET['accion']) && $_GET['accion'] === 'delete-user') {
        // Acción: Eliminar Cliente por ID
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $resultados = $controlador->DeleteClientePorId($id);

            if ($resultados !== false) {
                header('Content-Type: application/json');
                echo json_encode(array('message' => 'Cliente eliminado con éxito'));
            } else {
                echo "Error al eliminar el Cliente.";
            }
        } else {
            echo "ID de Cliente no proporcionado.";
        }
    } else {
        echo "Acción no válida.";
    }
}elseif ($_SERVER["REQUEST_METHOD"] === "PUT") {
    // Acción: Actualizar Cliente
    if (isset($_GET['accion']) && $_GET['accion'] === 'actualizar-user') {
        // Lee los datos JSON del cuerpo de la solicitud
        $json_data = file_get_contents('php://input');
        $data = json_decode($json_data);

        // Verifica si se pudieron decodificar los datos JSON correctamente
        if ($data) {
    
            $id=$data->id;
            $nombre = $data->nombre;
            $apellido = $data->apellido;
            $telefono = $data->telefono;
            $direccion = $data->direccion;
            $email = $data->email;
            $passwordd = $data->password_clt;

            // Luego, llama a una función en tu controlador que actualice al empleado
            $resultado = $controlador->ActualizarCliente($id,$nombre, $apellido, $telefono,$direccion,$email, $passwordd);

            if ($resultado) {
                echo "Cliente actualizado con éxito.";
            } else {
                echo "Error al actualizar el Cliente.";
            }
        } else {
            echo "Error al decodificar los datos JSON.";
        }
    } else {
        echo "Acción no válida.";
    }
}
else {
    echo "Método HTTP no permitido.";
}
?>
