<?php

namespace App\Ctrl;

require_once $_SERVER['DOCUMENT_ROOT'] . '/ctrl/ctrl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/auth.php';

use App\Ctrl\Ctrl;


/** Montre le forme pour ajouter des question. */
class logoutUser extends Ctrl
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
        $_SESSION = [];
        $this->redirectTo('/ctrl/task-list.php');        
    }
}

// Exécute le Controlleur
$ctrl = new logoutUser();
$ctrl->execute();