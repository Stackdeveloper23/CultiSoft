<?php
// Iniciar sesión
session_start();
include_once('../dbconect.php');
require 'token.php';

if(isset($_POST['id']) || isset($_SESSION['id'])){
 $database = new Connection();
      $db = $database->open();

    $id =$_POST['id'];
    $id_usuario = $_SESSION['id'];
    $token =$_POST['token'];

    $token_tmp = hash_hmac('sha1', $id, KEY_TOKEN);

  

    if($token == $token_tmp) {

      if (isset($_SESSION['carrito']['productos'][$id])){
        $_SESSION['carrito']['productos'][$id] += 1;
      }else{
        $_SESSION['carrito']['productos'][$id] = 1;
      }
      $sql = "INSERT INTO carrito (id_cliente, id_producto ) VALUES ($id_usuario, $id)";
      $stmt = $db->prepare($sql);
  
      $stmt->bindValue(1, $id, PDO::PARAM_INT);
      $stmt->bindValue(2, $id_usuario, PDO::PARAM_INT);
      $stmt->execute();
      $response = [
        "ok" => true,
        "numero" => $stmt->rowCount() // Number of affected rows
      ];
      ob_end_clean();
      echo json_encode($response);
      $database->close();
        $datos['numero'] = count($_SESSION['carrito']['productos']);
        $datos['ok'] = true; 
    }else{

  $datos['ok'] = false;
  }
} else{

  $datos['ok'] = false; 
}

echo json_encode($datos);
?>