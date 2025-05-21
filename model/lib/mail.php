<?php

namespace App\Model\Lib;

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use App\Model\Lib\Server;
use PHPMailer\PHPMailer\PHPMailer;

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/server.php';


class Mailer
{
    public static function sendEmail(): PhpMailer
    {
        $mail = new PHPMailer(true);
        $config = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . '/cfg/mail.ini');
            $mail = Server::connect();

            $mail->isHTML(true);  
            //Recipients
            $fromAdress = $config['from.adress'];
            $fromName = $config['from.name'];
            $mail -> setFrom($fromAdress, $fromName);

        
            // $mail->addAddress('guillaume.raschiero@free.fr', 'GR free'); //Name is optional
            // $mail->addReplyTo('info@example.com', 'Information');
            //$mail->addCC($cc);
            //$mail->addBCC($bcc);
        
            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
        
            //Content
        
            return $mail;
        
    }
}



