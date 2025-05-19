<?php

namespace App\Ctrl;

require_once $_SERVER['DOCUMENT_ROOT'] . '/ctrl/ctrl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/auth.php';

use App\Ctrl\Ctrl;
use App\Model\Lib\Auth\Auth;

/** Montre le forme pour ajouter des question. */
class loginUser extends Ctrl
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
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = Auth::getUser($email); 
        $lang = $_GET['lang'] ?? 'fr';

        if ($user && password_verify($password, $user['hashedPassword'])) {
            $_SESSION['user'] = $user;
        
            $this->redirectTo('/ctrl/article-list.php?lang=' . $lang);       
            exit();
        } else {

            $this->redirectTo('/ctrl/login-display.php?lang=' . $lang);
            exit();
        }
    }
}

// Exécute le Controlleur
$ctrl = new loginUser();
$ctrl->execute();