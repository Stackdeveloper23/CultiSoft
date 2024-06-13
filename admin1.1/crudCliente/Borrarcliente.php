<?php
	session_start();
	include_once('../dbconect.php');

	if(isset($_GET['id'])){
		$database = new Connection();
		$db = $database->open();
		try{
			$sql = "DELETE FROM cliente WHERE id = '".$_GET['id']."'";
			//if-else statement in executing our query
			$_SESSION['message'] = ( $db->exec($sql) ) ? 'usuario Borrado' : 'Hubo un error al borrar usuario';
		}
		catch(PDOException $e){
			$_SESSION['message'] = $e->getMessage();
		}

		//Cerrar conexión
		$database->close();

	}
	else{
		$_SESSION['message'] = 'Seleccionar usuario para eliminar';
	}

	header('location: crudcliente.php');

?>