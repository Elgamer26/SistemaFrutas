<?php

namespace App\SmsWhatsapp;

require 'vendor/autoload.php';

class Whatsapp
{
  function enviar_mensaje($sms)
  {
    $token =  "GA230610194602";
    $client = new \GuzzleHttp\Client(['verify' => false]);

    $payload = array(
      "op" => "registermessage",
      "token_qr" => $token,
      "mensajes" => $sms
    );

    $res = $client->request('POST', 'https://script.google.com/macros/s/AKfycbyoBhxuklU5D3LTguTcYAS85klwFINHxxd-FroauC4CmFVvS0ua/exec', [
      'headers' => [
        'Content-Type'     => 'application/json',
        'Accept' => 'application/json'
      ], 'json' =>  $payload
    ]);

    echo $res->getStatusCode() . "<br>";
    echo $res->getBody();
  }
}
