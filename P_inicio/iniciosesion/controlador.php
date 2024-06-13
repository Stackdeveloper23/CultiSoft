<?php
//session_start();
include_once('../dbconect.php');


if (!empty($_POST['boton'])) {
  $database = new Connection();
  $db = $database->open();
  

    if (empty($_POST['email']) and empty($_POST['password'])) {
        echo '<div>Los campos están vacíos</div>';
    } else {
    
      $email = $_POST['email'];
      $password =$_POST['password'];
      $sql =(" select * from cliente where email = '$email' and contraseña = '$password'");
      $resultado = $db->query($sql); 
      if ($resultado && $resultado->rowCount() > 0) {
      $fila = $resultado->fetch(PDO::FETCH_ASSOC);
      $_SESSION['id'] = $fila['id'];
      $_SESSION['nombres'] = $fila['nombres'];
      $_SESSION['apellidos'] = $fila['apellidos'];
        header('location:../index.php');
        exit;
      } else {echo '<div>Los campos son incorrectos</div>';
      }
    }
    //cerrar la conexion
    $database->close();
} 
/*
*/
?>
