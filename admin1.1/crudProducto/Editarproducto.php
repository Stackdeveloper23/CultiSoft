<?php
	session_start();
	include_once('../dbconect.php');

	if(isset($_POST['editar'])){
		$database = new Connection();
		$db = $database->open();
		try{
			$id = $_GET['id'];
			$nombre = $_POST['nombre'];
			$estado = $_POST['estado'];
			$descripcion = $_POST['descripcion'];
			$precio = $_POST['precio'];
			$imagenes = $_POST['imagenes'];
			$cantidad = $_POST['cantidad'];

			$sql = "UPDATE productos SET nombre = '$nombre', estado = '$estado', descripcion = '$descripcion', precio = '$precio', imagenes = '$imagenes', cantidad = '$cantidad' WHERE id = '$id'";
			//if-else statement in executing our query
			$_SESSION['message'] = ( $db->exec($sql) ) ? 'Producto actualizado correctamente' : 'No se puso actualizar producto';

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

	header('location: crudproductos.php');

?>