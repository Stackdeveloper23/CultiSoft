<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../estilos/stylesesion.css">
    <title>Iniciar sesion</title>
    <link rel="icon" href="../img/images/logo.png">
    
</head>

<body>

    <div class="container" id="container">

    <!--REGISTRO-->
        <div class="form-container sign-up">
            <form method="POST" action="">
              
                <h1>Crear cuenta</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>

                </div>
                <span>o utilice su correo electrónico para registrarse</span>
                <?php
                include_once('registro.php');
                ?>
               
                <input type="text" placeholder="N° Identificacion" required name="id">
                <input type="text" placeholder="Nombre" required name="nombres">
                <input type="text" placeholder="Apellido" required name="apellidos">
                <input type="text" placeholder="Correo" required name="email">
                <input type="text" placeholder="Contraseña" required name="contraseña">
                <input type="submit" value="crear cuenta" name="botonreg">
            </form>
        </div>
        
        <div class="form-container sign-in">
             <button type="button" class="btn btn-outline-danger" style="background-color: white; color: rgb(0, 163, 71);">
             <a href="../index.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-bar-left"
                    viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M12.5 15a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5M10 8a.5.5 0 0 1-.5.5H3.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L3.707 7.5H9.5a.5.5 0 0 1 .5.5">
                    </path>
                </svg>
                Salir
            </button></a>

            <!--INICIO SESION-->

            <form method="POST">
                <img src="../img/images/logo.png" height="50px">
                <h1>Ingresar</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                
                </div>
                <?php 
	
	if(isset($_SESSION['message'])){
		?>
		<div class="alert alert-info text-center" style="margin-top:20px;">
			<?php echo $_SESSION['message']; ?>
		</div>
		<?php

		unset($_SESSION['message']);
	}
?>
                <span>o utiliza tu contraseña de correo electrónico</span>
                <?php
  include('controlador.php');
  ?>
     
                <input type="email" placeholder="Correo" required name="email">
                <input type="password" placeholder="Contraseña" required name="password">
                <a href="#">¿Olvidaste tu contraseña?</a>
                <input type="submit" value="iniciar sesion" name="boton">
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <img src="../img/images/logo.png"  height="50px">
                    <h1>¡Bienvenid@ de nuevo!</h1>
                    <p>Ingrese sus datos personales para utilizar todas las funciones del sitio</p>
                    <button class="hidden" id="login">Ingresar</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Hola!</h1>
                    <p>Regístrese con sus datos personales para utilizar todas las funciones del sitio</p>
                    <button class="hidden" id="register">Crear cuenta</button>
                </div>
            </div>
        </div>
    </div>

    <script src="../js/script.js"></script>
</body>

</html>