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

$productos = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] : null;

$lista_carrito = array();
$sql = $db->prepare("SELECT id, nombre, precio  FROM productos WHERE id=? AND estado ='disponible'");
$i=0;
  foreach($productos as $clave => $cantidad){
$sql->execute(array($clave));
$lista_carrito[$i]['cantidad'] = $cantidad;
$lista_carrito[$i]= $sql->fetch(PDO::FETCH_ASSOC);
$i++;
}
//session_destroy();
print_r($_SESSION);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <title>Carrito de compra</title>
  <link rel="stylesheet" href="estilos/carrito.css">
  <link rel="icon" href="img/images/logo.png">
</head>

<body>

  <div class="row">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <h2><a class="navbar-brand" style="color: rgb(41, 206, 41);" href="index.php">
            <img src="img/images/logo.png" width="80px"
              height="50px">CultiSoft</a></h2>

        <form class="d-flex" role="buscar">
          <button type="button" class="btn btn-link" style="margin-right: 30px;"><a
              href="soporte.html">Soporte</a></button>
          <div style="padding-right: 15px;">
            <button type="button" class="btn btn-outline-warning">
              <a class="icon-link icon-link-hover" style="--bs-icon-link-transform: translate3d(0, -.125rem, 0);"
                href="inicio_sesion.html">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person"
                  viewBox="0 0 16 16">
                  <path
                    d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                </svg>
                Cuenta
              </a>
            </button>

          </div>

          <!--CARRITO boton-->
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
                <span id=" num_cart" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning">
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
        <a class="nav-link btn btn-outline-warning" style="border: 0; color: white;" href="producto4.html">Control de
          plagas</a>
        <a class="nav-link btn btn-outline-warning" style="border: 0; color: white;" href="producto5.html">Macetas</a>
        <a class="nav-link btn btn-outline-warning" style="border: 0; color: white;"
          href="producto6.html">Herramientas</a>
      </nav>
    </div>
  </div>

  <br>
  <div class="card mt-3 mb-5">
    <div class="row">
      <div class="col-md-8 cart">

      <!--TITLE-->
        <div class="title">
          <div class="row">
            <div class="col">
              <h4><b>Carro de compras</b></h4>
            </div>
            <div class="col align-self-center text-right text-muted"></div>
          </div>
        </div>

        <!--TABLE-->
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio/UND</th>
                <!--<th>subtotal</th>-->
                <th>Subtotal</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php 
              if($lista_carrito == null){
                echo '<tr><td colspan = "5" class"text-center"><b>lista vacia</b></td></tr>';
              }else{


                $total = 0;
                $i = 0;
                foreach($lista_carrito as $producto){
                  $i++;
                    $id = $producto['id'];
                    $nombre = $producto['nombre'];
                    $precio = $producto['precio'];
                    //$cantidad = $producto['cantidad'];
                    $subtotal = $cantidad * $precio;
                    $total += $subtotal;
              ?>
              <tr>
              
                
          <td><?php echo $nombre; ?></td>
          <td>
          <input type="number" min="1" max="10" step="1" value="<?php echo $cantidad;?>"
            size="1" id="cantidad_<?php echo $id;?>" onchange="actualizaCantidad(<?php echo $id;?>,this.value )">
          </td>
            <td> <span id="precio_<?php echo $id;?>"><?php echo MONEDA . number_format($precio,2, ',','.');?></span></td>
        
        <td> 
        <span id="subtotal_<?php echo $id; ?>" name="subtotal[]">  <?php echo MONEDA . number_format($precio * $cantidad, 2, ',', '.'); ?></span>
            
            
            </td>
            <td>
          <a href="#" id="eliminar" class="btn btn-warning btn-sm" data-bs-id="<?php
        echo $_id; ?>" data-bs-toogle="modal" data-bs-target="eliminamodal">Eliminar</a>
        </td>
        </tr>
       
        <?php } ?>
        </tbody>
        <?php } ?>
        </table>
        </div>
        

        
    
              
            
      </div>
          <div class="col-md-4 summary">
          <div>
            <h5><b>Resumen</b></h5>
          </div>
          <hr>
          <div class="row">
            <div class="col" style="padding: left 10px;">ARTÍCULOS: 3</div>
            
          </div>
        

          <div class="row" style="border-top: 1px solid rgb(0, 0, 0); padding: 2vh 0;">
            <div class="row">Precio Total</div>
            <span id="total" class="h4"></span>
          </div>
          <button class="submit">COMPRAR</button>
        </div>
                  <!--Boton volver-->
        <div class=" w-25 h-25 mt-0">
          <button class="volver btn mt-0" type="submit" style="text-decoration: none;">
            <a class="icon-link icon-link-hover"  style="color: green; text-decoration: none;"
              href="index.html"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-bar-left"
              viewBox="0 0 16 16">
              <path fill-rule="evenodd"
                  d="M12.5 15a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5M10 8a.5.5 0 0 1-.5.5H3.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L3.707 7.5H9.5a.5.5 0 0 1 .5.5">
              </path>
          </svg>Agregar mas productos
            </a>
          </button>
        </div>
        </div>


        
      </div>
       
      
  
    <script>
    
    function actualizaCantidad(id, cantidad) {
    let url = 'actualizar_carrito.php';
    let formData = new FormData();
    formData.append('action', 'agregar');
    formData.append('id', id);
    formData.append('cantidad', document.getElementById('cantidad_' + id).value);

    fetch(url, {
        method: 'POST',
        body: formData,
        mode: 'cors',
    }).then(response => response.json())
    .then(data => {
        if (data.ok) {
            let divsubtotal = document.getElementById('subtotal_' + id);
            divsubtotal.innerHTML = data.sub;

            let total = 0.00;
            let list = document.getElementsByName('subtotal[]');

           for (let i = 0; i < list.length; i++) {
             total += parseFloat(list[i].innerHTML.replace(/[$,]/g, ''));
            }

           total = new Intl.NumberFormat
            ('en-US',
               {
            minimumFractionDigits: 3,
              })
            .format(total);

            document.getElementById('total').innerHTML = '<?php echo MONEDA;?>' + total;


          }
        })
      
}
actualizaCantidad(<?php echo $id; ?>, <?php echo $cantidad; ?>);
    </script>
</body>




</html>