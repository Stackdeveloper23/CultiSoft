<?php
session_start();
if (isset($_SESSION['id'])) {
   
} 

?>
<?php 
require 'token.php';
require 'dbconect.php';
$database = new Connection();
$db = $database->open();

$id =isset($_GET['id']) ? $_GET['id']:'';
$token = isset($_GET['token']) ? $_GET['token']:'';


if ($id == '' || $token == ''){
  echo 'Error al procesar la peticion';
  exit;
} else {

  $token_tmp = hash_hmac('sha1', $id, KEY_TOKEN);

  if($token == $token_tmp) {
      $sql = $db->prepare("SELECT count(id) FROM productos WHERE id=? AND  estado ='disponible'");
      $sql->execute([$id]);
      if($sql -> fetchColumn() > 0){
      $sql = $db->prepare("SELECT nombre, descripcion, precio FROM productos WHERE id=? AND  estado ='disponible' LIMIT 1");
      $sql->execute([$id]);

      $row = $sql->fetch(PDO::FETCH_ASSOC);
      $nombre = $row['nombre'];
      $descripcion = $row['descripcion'];
      $precio = $row['precio'];
      $dir_images = 'img/images/'. $id .'/';

      $rutaImg = $dir_images . 'principal.jpg';

      if(!file_exists($rutaImg)){
        $rutaImg = 'img/nophoto.png';
      }

      $imagenes = array();
      if(file_exists($dir_images)){
      $dir = dir($dir_images);

      while (($archivo = $dir->read()) != false){
          if($archivo != 'principal.jpg' && (strpos($archivo, 'jpg') || strpos($archivo, 'jpeg'))){
            $imagenes[] = $dir_images . $archivo;
          }
      }
      $dir ->close();
    }
      }
     
  } else {
    echo 'Error al procesar la perticion';
    exit;
  }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
  integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" href="img/images/logo.png">

  <title>CultiSoft</title>


</head>

<body style="background-color: rgba(156, 149, 149, 0.267);">

  <!--primera cabecera-->
  <!--LOGO-->
  <div class="">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <h2><a class="navbar-brand" style="color: rgb(41, 206, 41);" href="#">
            <img src="img/images/logo.png" width="80px"
              height="50px">CultiSoft</a></h2>
              <?php
            echo $_SESSION['nombres']." ".$_SESSION['apellidos'];
            ?>

        <form class="d-flex" role="buscar">
          <button type="button" class="btn btn-link" style="margin-right: 30px;"><a href="soporte.html">Soporte</a></button>  
          <div style="padding-right: 15px;">
            <button type="button" class="btn btn-outline-warning">
              <a class="icon-link icon-link-hover" style="--bs-icon-link-transform: translate3d(0, -.125rem, 0);"
                href="inicio_sesion.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person"
                  viewBox="0 0 16 16">
                  <path
                    d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                </svg>
                Cuenta
              </a>
            </button>

          </div>

          <div style="padding-right: 15px;">
            <button type="button" class="btn btn-outline-warning position-relative">
              <a class="icon-link icon-link-hover" style="--bs-icon-link-transform: translate3d(0, -.125rem, 0);"
                href="checkout.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart3"
                  viewBox="0 0 16 16">
                  <path
                    d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l.84 4.479 9.144-.459L13.89 4zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
                </svg>
                carrito
                <span id="num_cart" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning">
                <?php echo $num_cart; ?>
                  <span  class="visually-hidden">unread messages</span>
              </a>
            </button>
          </div>

          <input class="form-control me-1" type="search" placeholder="Search" aria-label="Search"></input>
          <div style="padding-right: 50px;">
            <button class="btn btn-outline-warning" style="color:  black;" type="submit">
              <a class="icon-link icon-link-hover" style="--bs-icon-link-transform: translate3d(0, -.125rem, 0);"
                href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search"
                  viewBox="0 0 16 16">
                  <path
                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                </svg>
                Buscar
              </a>
            </button>
          </div>
          <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="iniciosesion/cerrarsesion.php">Logout</a></li>
                    </ul>
                </li>
            </ul>

        </form>
      </div>
  </div>




  <!-- /* barra de buttons */-->
  <div class="page-section bg-success mt-1 mb-1 pt-1 pb-1">
    <div class="container">
      <nav class="nav nav-pills nav-tabs nav-fill">
        <a class="nav-link btn btn-outline-warning" style="border: 0; color: white;" href="producto1.html">Semillas</a>
        <a class="nav-link btn btn-outline-warning" style="border: 0; color: white;" href="producto2.html">Sustratos</a>
        <a class="nav-link btn btn-outline-warning" style="border: 0; color: white;" href="producto3.html">Nutricion</a>
        <a class="nav-link btn btn-outline-warning" style="border: 0; color: white;" href="producto4.html">Control de plagas</a>
        <a class="nav-link btn btn-outline-warning" style="border: 0; color: white;" href="producto5.html">Macetas</a>
        <a class="nav-link btn btn-outline-warning" style="border: 0; color: white;" href="producto6.html">Herramientas</a>
      </nav>
    </div>
  </div>

  <!--/* seccion productos*/-->
 

  <div class="container">
    <div class="row">
      <div class="col-md-6 order-md-1">
      <img class="img-thumbnail d-block w-100" src="img/images/1/principal.jpg">
      </div>
      <div class="col-md-6 order-md-2">
      <h2><?php echo $nombre;?></h2>
      <h2><?php echo MONEDA . number_format($precio,2, ',','.');?></h2>
      <p class="lead">
        <?php echo $descripcion;?>
      </p>
      <div class="g-grid gap-3 col-10 mx-auto">
        <button class="btn btn-primary" type="button">Comprar Ahora</button>
        <button class="btn btn-primary" type="button" onclick= "addProducto(<?php echo $id; ?> , '<?php echo $token_tmp;?>')">Agregar al carrito</button>

      </div>

      </div>
    </div>
  </div>


  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
    <script>
    function addProducto(id, token){
      let url ='carrito.php'
      let formData = new FormData()
      formData.append('id',id) 
      formData.append('token',token)
      
      fetch(url, {
        method: 'POST',
        body: formData,
        mode:'cors',

      }).then(response => response.json())
      .then(data =>{
        if(data.ok){
          let elemento = document.getElementById("num_cart")
          elemento.innerHTML = data.numero
        }
      })
    }
    </script>


  

  <footer style="background-color: rgba(26, 24, 24, 0.692); height: 100px;">
    <h6 style="text-align: center; color: white;"><small>©2024 CultiSoft</small></h6>
  </footer>
</body>

</html>