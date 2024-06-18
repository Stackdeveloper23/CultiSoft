<?php
session_start();
include_once('../dbconect.php');

if(isset($_POST['agregar'])){
	$database = new Connection();
	$db = $database->open();
	try{
		//hacer uso de una declaración preparada para prevenir la inyección de sql
		$stmt = $db->prepare("INSERT INTO cliente (id, nombres, apellidos, email, contraseña,rol) VALUES (:id, :nombres, :apellidos, :email, :contraseña, :rol)");
		//instrucción if-else en la ejecución de nuestra declaración preparada
		$_SESSION['message'] = ( $stmt->execute(array(':id' => $_POST['id'] , ':nombres' => $_POST['nombres'] , ':apellidos' => $_POST['apellidos'], ':email' => $_POST['email'], ':contraseña' => $_POST['contraseña'], ':rol' => $_POST['rol'])) ) ? 'Usuario guardado correctamente' : 'Algo salió mal. No se puede agregar Usuario';	
	
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

header('location: crudcliente.php');
	
?>