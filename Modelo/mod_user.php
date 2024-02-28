<?php
class Modelo
{

    public function crearUser($USERID, $USERNAME, $PASWD, $id_nivel)
    {
        require("../modelo/connect_db.php");

        // Verificar si el email o el id ya están registrados
        $stmt = mysqli_prepare($mysqli, "SELECT COUNT(*) FROM users WHERE USERID = ? OR USERNAME = ?");
        mysqli_stmt_bind_param($stmt, "is", $USERID, $USERNAME);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $count);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        if ($count > 0) {
            // El USERID ya está registrado

            echo "El usuario o id ya están registrados.";
            return false;
            
        } else {
            // Si el email y el id no están registrados, se procede a insertar el cliente
            $stmt = mysqli_prepare($mysqli, "INSERT INTO users (USERID, USERNAME, PASWD, id_nivel) VALUES (?, ?, ?, ?)");
            mysqli_stmt_bind_param($stmt, "issi", $USERID, $USERNAME, $PASWD, $id_nivel);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            echo "Usuario Registrado con Exito";

            return true;
        }
    }


    public function ConsultarAllCliente()
    {
        require("../modelo/connect_db.php");
        // Ejecuta la consulta SQL
        $result = mysqli_query($mysqli, "SELECT cliente.id,cliente.nombre,cliente.apellido,cliente.telefono,cliente.direccion,pais.PaisNombre,ciudad.CiudadNombre,cliente.email,cliente.password_clt,estado.des_estado 
        FROM cliente
        INNER JOIN ciudad ON cliente.ciudad = ciudad.CiudadID
        INNER JOIN pais ON ciudad.PaisCodigo = pais.PaisCodigo
        INNER JOIN estado ON cliente.id_estado = estado.id_estado  ");
        // Verifica si la consulta se ejecutó correctamente
        if (!$result) {
            return false;
        }
        // Inicializa un arreglo para almacenar los datos
        $data = array();
        // Recorre los resultados y agrega cada fila al arreglo
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        // Convierte el arreglo de datos en formato JSON
        $jsonResult = json_encode($data);
        return $jsonResult;
    }

    public function consultarClientesPorId($id)
    {
        require('../modelo/connect_db.php');
        // Utiliza una consulta preparada para seleccionar un Cliente por su ID
        $stmt = mysqli_prepare($mysqli, "SELECT cliente.id,cliente.nombre,cliente.apellido,cliente.telefono,cliente.direccion,pais.PaisNombre,ciudad.CiudadNombre,cliente.email,cliente.password_clt,estado.des_estado 
        FROM cliente
        INNER JOIN ciudad ON cliente.ciudad = ciudad.CiudadID
        INNER JOIN pais ON ciudad.PaisCodigo = pais.PaisCodigo
        INNER JOIN estado ON cliente.id_estado = estado.id_estado  WHERE id = ?");
        // Verifica si la consulta preparada se creó correctamente
        if (!$stmt) {
            return false;
        }
        // Vincula el valor del ID al marcador de posición de la consulta preparada
        mysqli_stmt_bind_param($stmt, "i", $id);
        // Ejecuta la consulta preparada
        $result = mysqli_stmt_execute($stmt);
        // Verifica si la consulta se ejecutó correctamente
        if (!$result) {
            return false;
        }
        // Obtiene el resultado de la consulta
        $queryResult = mysqli_stmt_get_result($stmt);
        // Inicializa un arreglo para almacenar los datos
        $data = array();
        // Recorre los resultados y agrega cada fila al arreglo
        while ($row = mysqli_fetch_assoc($queryResult)) {
            $data[] = $row;
        }
        // Convierte el arreglo de datos en formato JSON
        $jsonResult = json_encode($data);
        // Cierra la consulta preparada
        mysqli_stmt_close($stmt);
        return $jsonResult;
    }


    public function DeleteClientePorId($id)
    {
        require('../modelo/connect_db.php');

        // Utiliza una transacción para garantizar que las eliminaciones se realicen en el orden deseado
        mysqli_autocommit($mysqli, false);

        // Primero, elimina los registros de la tabla `detalle` que hacen referencia a las citas del cliente
        $stmtDeleteDetalle = mysqli_prepare($mysqli, "DELETE FROM detalle WHERE codigo_cita IN (SELECT codigo_cita FROM cita WHERE placa IN (SELECT placa FROM vehiculo WHERE id_cliente = ?))");

        if (!$stmtDeleteDetalle) {
            //rollback, regreso al estado anterior
            mysqli_rollback($mysqli);
            return false;
        }

        mysqli_stmt_bind_param($stmtDeleteDetalle, "i", $id);

        $resultDeleteDetalle = mysqli_stmt_execute($stmtDeleteDetalle);

        if (!$resultDeleteDetalle) {
            mysqli_rollback($mysqli);
            return false;
        }

        // Luego, elimina las citas del cliente
        $stmtDeleteCitas = mysqli_prepare($mysqli, "DELETE FROM cita WHERE placa IN (SELECT placa FROM vehiculo WHERE id_cliente = ?)");

        if (!$stmtDeleteCitas) {
            mysqli_rollback($mysqli);
            return false;
        }

        mysqli_stmt_bind_param($stmtDeleteCitas, "i", $id);

        $resultDeleteCitas = mysqli_stmt_execute($stmtDeleteCitas);

        if (!$resultDeleteCitas) {
            mysqli_rollback($mysqli);
            return false;
        }

        // Después, elimina los vehículos del cliente
        $stmtDeleteVehiculos = mysqli_prepare($mysqli, "DELETE FROM vehiculo WHERE id_cliente = ?");

        if (!$stmtDeleteVehiculos) {
            mysqli_rollback($mysqli);
            return false;
        }

        mysqli_stmt_bind_param($stmtDeleteVehiculos, "i", $id);

        $resultDeleteVehiculos = mysqli_stmt_execute($stmtDeleteVehiculos);

        if (!$resultDeleteVehiculos) {
            mysqli_rollback($mysqli);
            return false;
        }

        // Finalmente, elimina el cliente
        $stmtDeleteCliente = mysqli_prepare($mysqli, "DELETE FROM cliente WHERE id = ?");

        if (!$stmtDeleteCliente) {
            mysqli_rollback($mysqli);
            return false;
        }

        mysqli_stmt_bind_param($stmtDeleteCliente, "i", $id);

        $resultDeleteCliente = mysqli_stmt_execute($stmtDeleteCliente);

        if (!$resultDeleteCliente) {
            mysqli_rollback($mysqli);
            return false;
        }

        // Si todas las eliminaciones se realizaron con éxito, confirma la transacción
        //commit es confirmacion de la transacción en la base de datos
        mysqli_commit($mysqli);
        mysqli_autocommit($mysqli, true);

        return true;
    }

    public function ActualizarCliente($id, $nombre, $apellido, $telefono, $direccion, $email, $passwordd)
    {
        require("../modelo/connect_db.php");
        //se prepara la consulta ? evita inserciones sql
        $stmt = mysqli_prepare($mysqli, "UPDATE cliente SET nombre = ?,apellido=?,telefono=?,direccion=?,email=?,password_clt=? WHERE id=?");
        //se asigna que variable corresponde a los "?" en la consulta 
        mysqli_stmt_bind_param($stmt, "ssisssi", $nombre, $apellido, $telefono, $direccion, $email, $passwordd, $id);
        //ejecuta la consulta
        mysqli_stmt_execute($stmt);
        // Cierra la consulta preparada
        mysqli_stmt_close($stmt);
        return TRUE;
    }
}
