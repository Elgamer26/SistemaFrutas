<?php

namespace App\MailPhp;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'Enviarcorreo/PHPMailer/Exception.php';
require 'Enviarcorreo/PHPMailer/PHPMailer.php';
require 'Enviarcorreo/PHPMailer/SMTP.php';

// Instantiation and passing `true` enables exceptions
class envio_correo
{
    function enviar_correo($correo, $html, $sms)
    {
        $mail = new PHPMailer(true);
        try {
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            $mail->SMTPDebug = 0;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.hostinger.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            // $mail->Username = 'computacioneinformaticauae@gmail.com'; //este debe ir en el address?
            // $mail->Password = 'uae123456';                            // SMTP password
            $mail->Username = 'viverodanielito@i-sistener.xyz';
            $mail->Password = 'ViveroDanoelito*1';
            $mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
            $mail->setFrom('viverodanielito@i-sistener.xyz', 'Vivero Danielito');
            $mail->addAddress($correo, 'Usted');     // Add a recipient
            $mail->CharSet = 'UTF-8';
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $sms;
            $mail->Body    = $html;
            $ok = $mail->send();
            if ($ok) {
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            return "Mensaje de error: {$mail->ErrorInfo}";
        }
        exit();
    }

    function enviar_correo_WEB($correo, $html, $sms, $documento)
    {
        $mail = new PHPMailer(true);
        try {
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            $mail->SMTPDebug = 0;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.hostinger.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            // $mail->Username = 'computacioneinformaticauae@gmail.com'; //este debe ir en el address?
            // $mail->Password = 'uae123456';                            // SMTP password
            $mail->Username = 'viverodanielito@i-sistener.xyz';
            $mail->Password = 'ViveroDanoelito*1';
            $mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
            $mail->setFrom('viverodanielito@i-sistener.xyz', 'Vivero Danielito');
            $mail->addAddress($correo, 'Usted');     // Add a recipient
            $mail->AddStringAttachment($documento, 'Factura_' . Date("Y-m-d", time()) . '.pdf', 'base64', 'application/pdf');
            $mail->CharSet = 'UTF-8';
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $sms;
            $mail->Body    = $html;
            $ok = $mail->send();
            if ($ok) {
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            return "Mensaje de error: {$mail->ErrorInfo}";
        }
        exit();
    }

    function enviar_correo_WEB_XML($correo, $html, $sms, $documento, $xml)
    {
        $mail = new PHPMailer(true);
        try {
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            $mail->SMTPDebug = 0;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.hostinger.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            // $mail->Username = 'computacioneinformaticauae@gmail.com'; //este debe ir en el address?
            // $mail->Password = 'uae123456';                            // SMTP password
            $mail->Username = 'viverodanielito@i-sistener.xyz';
            $mail->Password = 'ViveroDanoelito*1';
            $mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
            $mail->setFrom('viverodanielito@i-sistener.xyz', 'Vivero Danielito');
            $mail->addAddress($correo, 'Usted');     // Add a recipient
            $mail->AddStringAttachment($documento, 'Factura_' . Date("Y-m-d", time()) . '.pdf', 'base64', 'application/pdf');
            $mail->AddStringAttachment($xml, 'Factura_' . Date("Y-m-d", time()) . '.xml', 'base64', 'application/xml');
            $mail->CharSet = 'UTF-8';
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $sms;
            $mail->Body    = $html;
            $ok = $mail->send();
            if ($ok) {
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            return "Mensaje de error: {$mail->ErrorInfo}";
        }
        exit();
    }
    
    function enviar_correo_oferta($correo, $html, $sms)
    {
        $mail = new PHPMailer(true);
        try {
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            $mail->SMTPDebug = 0;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.hostinger.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username = 'viverodanielito@i-sistener.xyz';
            $mail->Password = 'ViveroDanoelito*1';
            $mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
            $mail->setFrom('viverodanielito@i-sistener.xyz', 'Vivero Danielito');

            for ($i = 0; $i < count($correo); $i++) {
                $mail->AddAddress($correo[$i], false);
            }

            $mail->CharSet = 'UTF-8';
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $sms;
            $mail->Body    = $html;
            $ok = $mail->send();
            if ($ok) {
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            return "Mensaje de error: {$mail->ErrorInfo}";
        }
        exit();
    }
}
