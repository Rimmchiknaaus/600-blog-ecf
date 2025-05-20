<?php

namespace App\Model\Lib;

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use App\Model\Lib\Server;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/server.php';


class Mailer
{
    public static function sendEmail ($adress, $cc, $bcc, $subject, $body, $altbody): bool
    {
        $mail = new PHPMailer(true);
        $config = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . '/cfg/mail.ini');
            $mail = Server::connect();

            //Recipients
            $mail->setFrom($config['username'], 'Web3&Crypto');

        
            // $mail->addAddress('guillaume.raschiero@free.fr', 'GR free'); //Name is optional
            // $mail->addReplyTo('info@example.com', 'Information');
            $mail->addCC($cc);
            $mail->addBCC($bcc);
        
            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
        
            //Content
            $mail->isHTML(true);  
            $mail->addAddress ($adress);  //Add a recipient                               //Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $body;
            $mail->AltBody = $altbody;
        
            return $mail->send();
        
    }
}



