<?php
require_once __DIR__ . '/../model/lib/mail.php';
require_once __DIR__ . '/../model/lib/server.php';

use App\Model\Lib\Mail\Mailer;

$mailer = new Mailer();
$mailer->send();
