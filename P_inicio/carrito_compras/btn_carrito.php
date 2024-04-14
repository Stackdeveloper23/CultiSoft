<?php
session_start();
require '../dbconect.php';
require '../token.php';

if (isset($_POST['id']) || isset($_SESSION['id'])) {

  $database = new Connection();
  $db = $database->open();

  $id = $_POST['id'];
  $id_usuario = $_SESSION['id']; // Assuming this stores the client ID
  $token = $_POST['token'];


  $token_tmp = hash_hmac('sha1', $id, KEY_TOKEN);

  echo "id recibido: " . $id_usuario . "\n";
  echo "Token recibido: " . $token . "\n";
  echo "Token generado: " . $token_tmp . "\n";

  if ($token == $token_tmp) {

    if (isset($_SESSION['carrito']['productos'][$id])) {
      $_SESSION['carrito']['productos'][$id] += 1;
    } else {
      $_SESSION['carrito']['productos'][$id] = 1;
    }

    $sql = "INSERT INTO carrito (id_cliente, id_producto) VALUES (?, ?)";
    $stmt = $db->prepare($sql);

    $stmt->bindValue(1, $id_usuario, PDO::PARAM_INT); // Assuming client ID is in session
    $stmt->bindValue(2, $id, PDO::PARAM_INT);

    $stmt->execute();

    $response = [
      "ok" => true,
      "numero" => $stmt->rowCount(),
    ];

    var_dump($response); // Optional for debugging
    echo json_encode($response);

    $database->close();

  } else {
    $response = [
      "ok" => false,
      "error" => "token invalido",
    ];

    var_dump($response); // Optional for debugging
    echo json_encode($response);
  }
} else {
  $response = [
    "ok" => false,
    "error" => "No se ha iniciado sesión",
  ];

  var_dump($response); // Optional for debugging
  echo json_encode($response);
}
?>