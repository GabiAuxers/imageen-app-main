<?php
include 'conexion.php';
include 'literal.php';
include 'functions.php';
include 'auth.php';

if ($auth!= 1) {
  error_log("El usuario no se ha autenticado");
  http_response_code(403);
}
else {

  require 'vendor/autoload.php';
  // This is your test secret API key.
  //\Stripe\Stripe::setApiKey('sk_test_51KEBQcDzdB3jO2burqY4XKPtuMpKf0Kf9tuH4bkkT7HmanfJOX51mADeMnlKOmINpDISzFeITBkVB4Xaf0HeZjMG00T0LKOrbQ');
  \Stripe\Stripe::setApiKey('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');

  header('Content-Type: application/json');

  if ($_SERVER['SERVER_NAME']=="localhost") $YOUR_DOMAIN = "https://localhost/imageen-app-main";
  else $YOUR_DOMAIN = "https://app.imageen.net";

  $checkout_session = \Stripe\Checkout\Session::create([
    'customer' => (!empty($stripe_id_usuario)?$stripe_id_usuario:NULL),
    'client_reference_id' => $codigousuario,
    'line_items' => [[
      # Provide the exact Price ID (e.g. pr_1234) of the product you want to sell
      'price' => $_POST['suscripcion'],
      'quantity' => 1,
    ]],
    'mode' => 'payment',
    'allow_promotion_codes'=> 'true',

    'success_url' => $YOUR_DOMAIN . '/success.php' . ((!empty($_SERVER['QUERY_STRING']))?('?'.$_SERVER['QUERY_STRING']):''),
    'cancel_url' => $YOUR_DOMAIN . '/cancel.php' . ((!empty($_SERVER['QUERY_STRING']))?('?'.$_SERVER['QUERY_STRING']):''),
    'automatic_tax' => [
      'enabled' => true,
    ],
    'customer_email' => (empty($stripe_id_usuario)?$email_usuario:NULL),
  ]);

  header("HTTP/1.1 303 See Other");
  header("Location: " . $checkout_session->url);
}