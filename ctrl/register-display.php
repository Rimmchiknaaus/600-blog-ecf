<?php

namespace App\Ctrl;

require_once $_SERVER['DOCUMENT_ROOT'] . '/ctrl/ctrl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/auth.php';

use App\Ctrl\Ctrl;

/** Montre le forme pour ajouter des question. */
class registerUserDisplay extends Ctrl
{
    /** @Override */
    public function getPageTitle(): ?string
    {
        return "S'inscrire";
    }

    /** @Override */
    public function getViewFile(): ?string
    {
        return  '/view/register.php';
    }

    /** @Override */
    public function do(): void
    {

    }
}
// Exécute le Controlleur
$ctrl = new registerUserDisplay();
$ctrl->execute();