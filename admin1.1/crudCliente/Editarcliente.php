<?php
	session_start();
	include_once('../dbconect.php');

	if(isset($_POST['editar'])){
		$database = new Connection();
		$db = $database->open();
		try{
			$id = $_GET['id'];
			$nombres = $_POST['nombres'];
			$apellidos = $_POST['apellidos'];
			$email = $_POST['email'];
			$contraseña = $_POST['contraseña'];
			$rol = $_POST['rol'];

			$sql = "UPDATE cliente SET nombres = '$nombres', apellidos = '$apellidos', email = '$email', contraseña = '$contraseña' , rol ='$rol' WHERE id = '$id'";
			//if-else statement in executing our query
			$_SESSION['message'] = ( $db->exec($sql) ) ? 'usuario actualizado correctamente' : 'No se puso actualizar usuario';

		}
		catch(PDOException $e){
			$_SESSION['message'] = $e->getMessage();
		}

		//Cerrar la conexión
		$database->close();
	}
	else{
		$_SESSION['message'] = 'Complete el formulario de edición';
	}

	header('location: crudcliente.php');

?>