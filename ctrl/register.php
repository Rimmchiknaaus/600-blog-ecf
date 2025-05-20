<?php

namespace App\Ctrl;

require_once $_SERVER['DOCUMENT_ROOT'] . '/ctrl/ctrl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/auth.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/mail.php';

use App\Model\Lib\Mailer;
use App\Ctrl\Ctrl;
use App\Model\Lib\Auth\Auth;

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



        // Vérifie les mots de passe
        if ($password !== $passwordRepeat) {
            $this->redirectTo('/ctrl/register-display.php');
            exit();
        }
        // Hachage du mot de passe
        $options = ['cost' => 12];
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT, $options);
        // Vérifie si l'utilisateur existe déjà
        $user = Auth::getUser($email);

        if ($user) {
            $subject = ' Adresse e-mail déjà utilisée';
            $body = 'Bonjour' . $name . '! L’adresse e-mail [email] est déjà associée à un compte sur. Si vous avez oublié votre mot de passe, vous pouvez le réinitialiser ici : [lien de réinitialisation]
            Si vous pensez qu’il s’agit d’une erreur, n’hésitez pas à nous contacter' ;
            $altbody =  'altbody';
            $adress = $email;
            $cc = 'cc@example.com';
            $bcc ='bcc@example.com';
    
            $mailer = Mailer::sendEmail ($adress, $cc, $bcc, $subject, $body, $altbody);
            $this->redirectTo('/ctrl/register-display.php?lang=' . $lang);
            exit();
            }
    

 
        $subject = 'Bienvenue sur Web3@Crypto';
        $body = 'Bonjour' . $name . '! Votre compte a bien été créé. Vous pouvez maintenant vous connecter et commencer à explorer notre contenu.';
        $altbody =  'altbody';
        $adress = $email;
        $cc = 'cc@example.com';
        $bcc ='bcc@example.com';

        $mailer = Mailer::sendEmail ($adress, $cc, $bcc, $subject, $body, $altbody);

        $success = Auth::createUser($name, $email, $password,  $hashedPassword);

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