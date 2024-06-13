<?php
require __DIR__."/vendor/autoload.php";

// SDK de Mercado Pago
use MercadoPago\MercadoPagoConfig;
// Agrega credenciales
MercadoPagoConfig::setAccessToken("TEST-3959523974557388-061114-3eadbe940262f871afd3c31309f186ef-1851796347");
?>

<?php
use MercadoPago\Client\Preference\PreferenceClient;

$client = new PreferenceClient();
$preference = $client->create([
  "items"=> array(
    array(
      "title" => "Mi producto",
      "quantity" => 1,
      "unit_price" => 2000
    )
  )
]);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://sdk.mercadopago.com/js/v2"></script>
</head>
<body>
    <div class="checkout-btn"></div>

    <script>
        const mp = new MercadoPago('TEST-2f68439c-7003-42ea-b6f5-77af2a1f2004',{
            locale: 'es-CO'
        });

        mp.checkout({
            preference:{
                id: '<?php echo $preference->id; ?>'
            },
            render:{
                container: '.checkout-btn',
                label: 'Pagar con Mercado Pago'
            }
        })
    </script>

</body>

</html>