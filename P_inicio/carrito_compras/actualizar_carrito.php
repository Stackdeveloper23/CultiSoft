<?php

require '../dbconect.php';
require '../token.php';

if(isset($_POST['action'])){

    $action = $_POST['action'];
    $id = isset($_POST['id']) ? $_POST['id'] : 0;

    if($action == 'agregar'){
        $cantidad = isset($_POST['cantidad']) ? $_POST['cantidad'] : 0;
         $respuesta = agregar($id, $cantidad);

         if($respuesta > 0){
            $datos['ok'] = true;
          //  $datos['sub'] = MONEDA . number_format($respuesta,2,',','.');
         }else {
            $datos['ok'] = false;
         }
         $datos['sub'] = MONEDA . number_format($respuesta,2,',','.');
       
    }else if($action == 'eliminar') {
        $datos['ok'] = eliminar($id);
    }
    else{
        $datos['ok'] = false;
    }
}else{
    $datos['ok'] = false;
}
echo json_encode($datos);

function agregar($id, $cantidad) {
    $res = 0;

    // Validación completa
    if ($id > 0 && $cantidad > 0 && is_numeric($cantidad)) {
        $database = new Connection();
        $db = $database->open();

        // Validar si el producto existe
        $sql = $db->prepare("SELECT id FROM productos WHERE id=?");
        $sql->execute([$id]);
        if ($sql->rowCount() === 0) {
            return $res;
        }

        // Validar si el precio del producto es mayor a 0
        $sql = $db->prepare("SELECT precio FROM productos WHERE id=? AND estado = 'disponible'");
        $sql->execute([$id]);
        $row = $sql->fetch(PDO::FETCH_ASSOC);
        if ($row['precio'] <= 0) {
            return $res;
        }

        // Cálculo del total
        $precio = $row['precio'];
        $res = $precio * $cantidad;

        // Actualizar la cantidad en el carrito
        if (isset($_SESSION['carrito']['productos'][$id])) {
            $_SESSION['carrito']['productos'][$id] = $cantidad;
        }

        return $res;
    } else {
        return $res;
    }

}
//eliminar producto de carrito

function eliminar($id)
{
    if($id > 0){
        if(isset($_SESSION['carrito']['productos'][$id])) {
            unset($_SESSION['carrito']['productos'][$id]);
            $id_usuario = $_SESSION['id'];

            $database = new Connection();
		$db = $database->open();
		try{
			$sql = "DELETE FROM carrito WHERE id_producto = $id and id_cliente = $id_usuario";
			//if-else statement in executing our query
			$_SESSION['message'] = ( $db->exec($sql) ) ? 'categoria Borrado' : 'Hubo un error al borrar empleado';
		}
		catch(PDOException $e){
			$_SESSION['message'] = $e->getMessage();
		}

		//Cerrar conexión
		$database->close();
        return true;
        }
    }else {
        return false;
    }
}

/*function eliminar($id) {
    if ($id > 0) {
        if (isset($_SESSION['carrito']['productos'][$id])) {
            // Remove from session
            unset($_SESSION['carrito']['productos'][$id]);

            // Database operations (illustrative example)
            if ($db->ping()) {
                try {
                    // Begin transaction (optional)
                   // $db->beginTransaction();

                    // Prepared statement for cart deletion
                    $sentencia = $db->prepare("DELETE FROM carrito WHERE id_producto = ?");
                    if ($sentencia->execute([$id])) {
                        // Success: Delete from products table (optional)
                        // $productDeleteStatement = $db->prepare("DELETE FROM productos WHERE id = ?");
                        // $productDeleteStatement->execute([$id]);
                    } else {
                        throw new Exception("Error deleting from cart: " . $sentencia->errorInfo()[2]);
                    }

                    // Commit transaction (optional)
                    $db->commit();

                    return true;
                } catch (Exception $e) {
                    // Rollback transaction (optional)
                    $db->rollBack();
                    error_log($e->getMessage(), 3, "/path/to/error.log");
                    return false;
                }
            } else {
                // Handle database connection error
                return false;
            }
        }
    }

    return false;
}*/
?>