<?php

namespace App\Ctrl;

require_once $_SERVER['DOCUMENT_ROOT'] . '/ctrl/ctrl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/auth.php';

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


        // Vérifie les mots de passe
        if ($password !== $passwordRepeat) {
            $_SESSION['msg']['warning'] = 'Les mots de passe ne correspondent pas.';
            $this->redirectTo('/ctrl/register-display.php');
            exit();
        }
        // Hachage du mot de passe
        $options = ['cost' => 12];
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT, $options);
        // Vérifie si l'utilisateur existe déjà
        $user = Auth::getUser($email);

        if ($user) {
        $_SESSION['msg']['warning'] = 'Cet email est déjà utilisé.';
        $this->redirectTo('/ctrl/register-display.php');
        exit();
}
        // Création dans la BDD
        $success = Auth::createUser($name, $email, $password,  $hashedPassword);

        // Ajoute une notification d'erreur
        if (!$success) {
            $_SESSION['msg']['warning'] = 'Erreur lors de l\'inscription.';
            $this->redirectTo('/ctrl/register-display.php');
            exit();
        }
        $_SESSION['msg']['success'] = 'Inscription réussie.';
        // rediriger vers la list de question
        $this->redirectTo('/ctrl/login-display.php');
        exit();

       
    }
}

// Exécute le Controlleur
$ctrl = new registerUser();
$ctrl->execute();