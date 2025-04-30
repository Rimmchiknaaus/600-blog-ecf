
<?php


require_once $_SERVER['DOCUMENT_ROOT'] . '/ctrl/ctrl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/auth.php';

use App\Ctrl\Ctrl;

/** Montre le forme pour ajouter des question. */
class loginUserDisplay extends Ctrl
{
    /** @Override */
    public function getPageTitle(): ?string
    {
        return "Se connecter";
    }

    /** @Override */
    public function getViewFile(): ?string
    {
        return  '/view/login.php';
    }

    /** @Override */
    public function do(): void
    {
        
    }
}

// Exécute le Controlleur
$ctrl = new loginUserDisplay();
$ctrl->execute();
