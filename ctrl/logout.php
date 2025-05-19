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
        $lang = $_GET['lang'] ?? 'fr';
        $this->redirectTo('/ctrl/article-list.php?lang=' . $lang);        
    }
}

// Exécute le Controlleur
$ctrl = new logoutUser();
$ctrl->execute();