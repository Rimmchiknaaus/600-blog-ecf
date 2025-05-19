<?php

namespace App\Model\Lib\Mail;

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use App\Model\Lib\SMTP\Server;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../model/lib/server.php';


class Mailer
{
    public function send(): bool
    {
        $mail = new PHPMailer(true);

        try {

            $mail = Server::connect();

            //Recipients
            $mail->setFrom('rimma@alwaysdata.net', 'Mailer');
            $mail->addAddress('naausrimma@gmail.com', 'Rimma');  //Add a recipient
        
            // $mail->addAddress('guillaume.raschiero@free.fr', 'GR free'); //Name is optional
            // $mail->addReplyTo('info@example.com', 'Information');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');
        
            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
        
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Here is the subject';
            $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
            return $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}



