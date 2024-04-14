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

$sql = $db->prepare("SELECT id, nombre, precio FROM productos WHERE estado ='disponible'");
$sql->execute();
$resultado = $sql->fetchALL(PDO::FETCH_ASSOC);

//session_destroy();
print_r($_SESSION);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
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

           <!--CARRITO-->
          <div style="padding-right: 15px;">
            <button type="button" class="btn btn-outline-warning position-relative">
              <a class="icon-link icon-link-hover" style="--bs-icon-link-transform: translate3d(0, -.125rem, 0);"
                href="carrito_compras/carrito_compras.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart3"
                  viewBox="0 0 16 16">
                  <path
                    d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l.84 4.479 9.144-.459L13.89 4zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
                </svg>
                carrito
                <span id=" num_cart" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning">
                <?php echo $num_cart; ?> </span>
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

          <!--ACCOUNT-->
          <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
          <span class="material-symbols-outlined" style="font-size: 40px">
          account_circle
          </span>
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
 

  <section class="page-section mt-4" style="padding: 2rem; margin-bottom: 2rem;">
    <div class="container">
      <h2 class="text-center mb-5" style="color: green;">PRODUCTOS MAS VENDIDOS</h2>
      <div class="row row-cols-3 g-4">

        <!-- item1-->
      <?php foreach ($resultado as $row) {?>
        <div class="col">
          <div class="card border-success text-success" style="width: 18rem;">
          <?php 
          $id = $row['id'];
          $imagen = "img/images/" . $id . "/principal.jpg";

          if (!file_exists($imagen)){
            $imagen = "img/nophoto.png";
          }
          
          ?> 
          <h1><?php echo $id;?></h1>
            <img src="<?php echo $imagen; ?>" class="rounded mx-auto d-block"
              height="200px">
            <div class="card-body text-center">
              <h5 class="card-title "><?php echo $row['nombre'];?></h5>
              <P class ="card-text">$ <?php echo number_format($row['precio'], 2, ',','.');?></P>
              <a style="margin-bottom: 10px;" href="detalles.php?id=<?php echo $row['id']; ?>&token=<?php echo
              hash_hmac('sha1',$row['id'], KEY_TOKEN);?>" class="btn btn-outline-warning">Detalles</a>
              <button class="btn btn-primary" type="button" 
              onclick= "addProducto(<?php echo $row['id']; ?> , 
              '<?php echo hash_hmac('sha1',$row['id'], KEY_TOKEN);?>' , '<?php echo $_SESSION['id']?>','<?php echo $row['nombre'];?>')">
              Agregar al carrito</button>
              

            </div>
          </div>
        </div>
        <?php }?>
        



      </div>
    </div>
  </section>
 


  <section class="page-section" style="background-color: #1abc9c; padding: 4rem;">
    <div class="container  ">

      <h2 class="text-center mb-5" style="color: green;">PROMOCIONES</h2>
      <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="https://cdn.pixabay.com/photo/2015/04/04/18/43/sale-706824_1280.jpg" class="w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="https://cdn.pixabay.com/photo/2015/04/04/18/43/sale-706821_1280.jpg" class="w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="https://cdn.pixabay.com/photo/2015/04/04/18/43/sale-706822_960_720.jpg" class="w-100" alt="...">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
          data-bs-slide="prev" style=" border-radius: 200px; width: 50px;">
          <span class="carousel-control-prev-icon" style="background-color: rgb(170, 170, 170); border-radius: 100%;" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
          data-bs-slide="next" style=" border-radius: 200px; width: 50px;">
          <span class="carousel-control-next-icon" style="background-color:rgb(170, 170, 170); border-radius: 100%;" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>

    </div>
  </section>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

  <script>
    function addProducto(id, token, id_cliente){
      let url ='carrito_compras/btn_carrito.php'
      let formData = new FormData()
      formData.append('id',id)
      formData.append('token',token)
      formData.append('id_cliente', <?php echo $_SESSION['id'] ?>);

      fetch(url, {
        method: 'POST',
        body: formData,
        mode:'cors',

      }).then(response => response.json())
      .then(data =>{
        console.log(data)
        if(data.ok){
          let elemento = document.getElementById('num_cart')
          elemento.innerHTML = data.numero;
          console.log(json_encode($response));
        }else {
    // Mostrar un mensaje de error al usuario
    console.error("Error al agregar el producto:", data.error);
  }
      })
     
    }
    </script>

  <footer style="background-color: rgba(26, 24, 24, 0.692); height: 100px;">
    <h6 style="text-align: center; color: white;"><small>©2024 CultiSoft</small></h6>
  </footer>
</body>

</html>