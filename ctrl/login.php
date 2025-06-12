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

        $utilisateur = Auth::getUtilisateur($email); 

        if ($utilisateur && password_verify($password, $utilisateur['hashedPassword'])) {
            $_SESSION['utilisateur'] = $utilisateur;
        } else {

            exit();
        }
        $this->redirectTo('/ctrl/task-list.php');
    }
}

// Exécute le Controlleur
$ctrl = new loginUser();
$ctrl->execute();