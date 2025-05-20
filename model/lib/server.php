<?php

namespace App\Model\Lib;

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

class Server
{
    /**
     * Initialise et retourne un objet PHPMailer configuré.
     *
     * @return PHPMailer
     */
    public static function connect(): PHPMailer
    {
        $config = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . '/cfg/mail.ini');

        $mail = new PHPMailer(true);

        // Configuration SMTP
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;     
        $mail->isSMTP();
        $mail->Host       = $config['host'];
        $mail->SMTPAuth   = true;
        $mail->Username   = $config['username'];
        $mail->Password   = $config['password'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;    
        $mail->Port       = $config['port'];

        return $mail;
    }
}
