<?php

namespace App\Ctrl;

/** Contrat d'interface d'un Controller. */
interface CtrlI
{
    /** Exécute le code spécifique au Controlleur. */
    function do(): void;

    /** Fournit le titre de la page, s'il y en a. */
    function getPageTitle(): ?string;

    /** Fournit le chemin du fichier de vue, s'il y en a. */
    function getViewFile(): ?string;
}