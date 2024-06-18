
<?php
// Iniciar sesión
session_start();
include_once('../dbconect.php');



// Si el usuario no está logueado, redireccionarlo
if (!isset($_SESSION['id'])) {
  header('Location: login.php');
  exit();

try {
      $database = new Connection();
      $db = $database->open();

  // Get data from request
  $id_producto = $_POST['id'];
  $id_usuario = $_POST['id_usuario'];


  // Prepare INSERT statement
  $sql = "INSERT INTO carrito (id_producto, id_usuario) VALUES (?, ?)";
  $stmt = $db->prepare($sql);

  // Bind values and execute query
  $stmt->bindValue(1, $id_producto, PDO::PARAM_INT);
  $stmt->bindValue(2, $id_usuario, PDO::PARAM_INT);
  $stmt->execute();

  // Prepare response
  $response = [
    "ok" => true,
    "numero" => $stmt->rowCount() // Number of affected rows
  ];

  echo json_encode($response);
  $database->close();

} catch (PDOException $e) {
  // Handle database errors
  echo json_encode([
    "ok" => false,
    "error" => "Error en la base de datos: " . $e->getMessage()
  ]);
} catch (Exception $e) {
  // Handle other unexpected errors
  echo json_encode([
    "ok" => false,
    "error" => "Error inesperado: " . $e->getMessage()
  ]);
}
}
?>