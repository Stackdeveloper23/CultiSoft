<?php
session_start();
include_once('../dbconect.php');

if(isset($_POST['agregar'])){
	$database = new Connection();
	$db = $database->open();
	try{
		//hacer uso de una declaración preparada para prevenir la inyección de sql
		$stmt = $db->prepare("INSERT INTO productos (id, nombre, descripcion, precio,imagenes, cantidad) VALUES (:id, :nombre, :descripcion, :precio,:imagenes, :cantidad)");
		//instrucción if-else en la ejecución de nuestra declaración preparada
		$_SESSION['message'] = ( $stmt->execute(array(':id' => $_POST['id'] , ':nombre' => $_POST['nombre'] , ':descripcion' => $_POST['descripcion'], ':precio' => $_POST['precio'], ':imagenes' => $_POST['imagenes'],':cantidad' => $_POST['cantidad'])) ) ? 'producto guardado correctamente' : 'Algo salió mal. No se puede agregar producto';	
	
	}
	catch(PDOException $e){
		$_SESSION['message'] = $e->getMessage();
	}

	//cerrar la conexion
	$database->close();
}

else{
	$_SESSION['message'] = 'Llene el formulario';
}

header('location: crudproductos.php');
	
?>