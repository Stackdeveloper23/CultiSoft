<?php

require 'dbconect.php';
require 'token.php';

if(isset($_POST['action'])){

    $action = $_POST['action'];
    $id = isset($_POST['id']) ? $_POST['id'] : 0;

    if($action == 'agregar'){
        $cantidad = isset($_POST['cantidad']) ? $_POST['cantidad'] : 0;
         $respuesta = agregar($id, $cantidad);

         if($respuesta > 0){
            $datos['ok'] = true;
            $datos['sub'] = MONEDA . number_format($respuesta,2,',','.');
         }else {
            $datos['ok'] = false;
         }
        
    }else{
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
?>