<?php
include 'conexion.php';


require 'vendor/autoload.php';
// This is your test secret API key.
//\Stripe\Stripe::setApiKey('sk_test_51KEBQcDzdB3jO2burqY4XKPtuMpKf0Kf9tuH4bkkT7HmanfJOX51mADeMnlKOmINpDISzFeITBkVB4Xaf0HeZjMG00T0LKOrbQ');
//$stripe = new \Stripe\StripeClient('sk_test_51KEBQcDzdB3jO2burqY4XKPtuMpKf0Kf9tuH4bkkT7HmanfJOX51mADeMnlKOmINpDISzFeITBkVB4Xaf0HeZjMG00T0LKOrbQ');

  \Stripe\Stripe::setApiKey('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');
  $stripe = new \Stripe\StripeClient('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');

function print_log($val) {
    return file_put_contents('php://stderr', print_r($val, TRUE));
}

// You can find your endpoint's secret in your webhook settings
//$endpoint_secret = 'whsec_pDa4Rkf1UkUfKPb65Wmn0DxjmxVJUiDF';
$endpoint_secret = 'whsec_J6HyaiDQousE0hOkNywfWEmi5EBLMPs5';

$payload = @file_get_contents('php://input');
$sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
$event = null;

try {
  $event = \Stripe\Webhook::constructEvent(
    $payload, $sig_header, $endpoint_secret
  );
} catch(\UnexpectedValueException $e) {
  // Invalid payload
  http_response_code(400);
  exit();
} catch(\Stripe\Exception\SignatureVerificationException $e) {
  // Invalid signature
  http_response_code(400);
  exit();
}


// Handle the checkout.session.completed event
if ($event->type == 'checkout.session.completed') {
    $session = $event->data->object;
    $line_items = $stripe->checkout->sessions->allLineItems($session->id, ['limit' => 5]);

    // Fulfill the purchase...
    print_log("\nCliente stripe: ".$session->customer);
    print_log("\nUsuario: ".$session->client_reference_id);
    print_log("\nSuscripcion: ".$line_items->data[0]->price->nickname);
    print_log("\nEstado: ".$session->payment_status);
    $date = new DateTime();
    $date->setTimestamp($event->created);
    print_log("\nFecha: ".date_format($date, 'U = Y-m-d H:i:s'));
    print_log("\nId Sesion: ".$session->id);
    print_log("\nId Precio:".$line_items->data[0]->price->id);
    print_log("\nPrecio: ".$session->amount_total);

    $conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
    mysqli_set_charset($conn, 'utf8');
    $sql = "INSERT INTO TRANSACCIONES (USUARIO, SUSCRIPCION, ESTADO, FECHA, PRECIO, STRIPESESSION, STRIPEPRICE, STRIPECLIENTE)
           VALUES ('$session->client_reference_id', '{$line_items->data[0]->price->nickname}', '$session->payment_status', FROM_UNIXTIME($event->created),  $session->amount_total/100, '$session->id', '{$line_items->data[0]->price->id}', '$session->customer')";
    print_log("\nSQL: ".$sql);
    $result = $conn->query($sql);
    if($result) {
        print_log("\nÉxito");
    }
    else {
        print_log("\nError SQL: ".$conn->error);
    }
    
    $sql = "SELECT NOMBRE, APELLIDOS, TELEFONO, EMAIL, FOTO, TOKEN, PROVIDER, SUSCRIPCION, FINSUSCRIPCION, STRIPECLIENTE, VISUALIZACION, IDIOMA, IDIOMA2 FROM USUARIOS WHERE CODIGO='$session->client_reference_id'";
    print_log("\nSQL: ".$sql);
    $result = $conn->query($sql);
    if($result) {
        print_log("\nÉxito");
    }
    else {
        print_log("\nError SQL: ".$conn->error);
    }

    $row = $result->fetch_assoc();
    if ($result->num_rows > 0) {
        $email_usuario  	  	= $row["EMAIL"];
        $suscripcion_usuario 	= $row["SUSCRIPCION"];
        $fin_suscripcion_usuario = $row["FINSUSCRIPCION"];
        $stripe_id_usuario		= $row["STRIPECLIENTE"];
    
        $sql = "SELECT VALIDEZ FROM SUSCRIPCIONES WHERE CODIGO='{$line_items->data[0]->price->nickname}'";
        print_log("\nSQL: ".$sql);
        $result = $conn->query($sql);
        if($result) {
            print_log("\nÉxito");
        }
        else {
            print_log("\nError SQL: ".$conn->error);
        }
        
        $row = $result->fetch_assoc();
        if ($result->num_rows > 0) {
          $dias_suscripcion   = $row["VALIDEZ"];

          if(empty($email_usuario)) {
            $email_usuario = $session->customer_email;
          }
          $stripe_id_usuario = $session->customer;
          $suscripcion_usuario = 3;

          $ahora = new DateTime();
          if (!empty($fin_suscripcion_usuario)) {
            $fecha_fin = new DateTime($fin_suscripcion_usuario);
            if ($ahora > $fecha_fin) $fecha_fin = $ahora;
          }
          else {
            $fecha_fin = $ahora;
          }
          
          $fecha_fin->add(new DateInterval('P'. $dias_suscripcion . 'D')); 
          $fin_suscripcion_usuario = $fecha_fin->format('Y-m-d H:i:s');

          $sql = "UPDATE USUARIOS SET STRIPECLIENTE = '$stripe_id_usuario', EMAIL ='$email_usuario', SUSCRIPCION ='$suscripcion_usuario', FINSUSCRIPCION = '$fin_suscripcion_usuario' WHERE CODIGO='$session->client_reference_id'";
          print_log("\nSQL: ".$sql);
          $result = $conn->query($sql);
          if($result) {
              print_log("\nÉxito");
        }
        else {
            print_log("\nError SQL: ".$conn->error);
        }          
      }
      else {
        $conn->close();
        print_log("\nSuscripción no encontrada en BBDD: ".$line_items->data[0]->price->nickname);
        http_response_code(400);
        exit();  
      }
    }
    else {
      $conn->close();
      print_log("\nUsuario no econtrado en BBDD:".$session->client_reference_id);
      http_response_code(400);
      exit();
    } 
    $conn->close();
}

http_response_code(200);

?>