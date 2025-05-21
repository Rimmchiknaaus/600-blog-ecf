<?php

namespace App\Ctrl;

require_once $_SERVER['DOCUMENT_ROOT'] . '/ctrl/ctrl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/auth.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/mail.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use App\Model\Lib\Mailer;
use App\Ctrl\Ctrl;
use App\Model\Lib\Auth\Auth;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

/** Montre le forme pour ajouter des question. */
class registerUser extends Ctrl
{
    /** @Override */
    public function getPageTitle(): ?string
    {
        return null;
    }

    /** @Override */
    public function getViewFile(): ?string
    {
        return null;
    }

    /** @Override */
    public function do(): void
    {
        // Lis les informations saisies dans le formulaire
        $email = $_POST['myEmail'];
        $password = $_POST['myPassword'];
        $passwordRepeat = $_POST['myPasswordRepeat'];
        $name = $_POST['myName'];
        $lang = $_GET['lang'] ?? 'fr';

        $mail = Mailer::sendEmail ();


        // Twig

        $twigLoader = new FilesystemLoader(__DIR__ . '/../model/mail/templates');
        $twig = new Environment($twigLoader);
        $template = $twig->load('hello-' . $lang . '.twig');
        $bodyMsg = $template->render(['name' => $name]);

        $mail->addAddress ($email);  //Add a recipient     
        $mail->Subject = ($lang === 'en') ? 'Welcome to  Web3@Crypto' : 'Bienvenue sur Web3@Crypto';
        $mail->Body    = $bodyMsg; 
        //$mail->AltBody = strip_tags($bodyMsg);

        // Vérifie les mots de passe
        if ($password !== $passwordRepeat) {
            $this->redirectTo('/ctrl/register-display.php?lang=' . $lang);
            exit();
        }
        // Hachage du mot de passe
        $options = ['cost' => 12];
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT, $options);
        // Vérifie si l'utilisateur existe déjà
        $user = Auth::getUser($email);

        if ($user) {
            $this->redirectTo('/ctrl/register-display.php?lang=' . $lang);
            exit();
            }

        $success = Auth::createUser($name, $email, $password,  $hashedPassword);
        $success = $mail->send();

        // Ajoute une notification d'erreur
        if (!$success) {
            $this->redirectTo('/ctrl/register-display.php?lang=' . $lang);
            exit();

        }
        // rediriger vers la list de question
        $this->redirectTo('/ctrl/login-display.php?lang=' . $lang);
        exit();

    }
}

// Exécute le Controlleur
$ctrl = new registerUser();
$ctrl->execute();