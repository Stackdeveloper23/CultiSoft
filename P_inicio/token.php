<?php

define("KEY_TOKEN", base64_decode("APR.wqc-354*"));
define("MONEDA","$");

//session_start();

$num_cart = 0;
if (isset($_SESSION['carrito']['productos'])){
    $num_cart = count($_SESSION['carrito']['productos']);
}
?>