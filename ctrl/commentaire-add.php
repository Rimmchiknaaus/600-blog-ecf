<?php

namespace App\Ctrl;

require_once $_SERVER['DOCUMENT_ROOT'] . '/ctrl/ctrl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/commentaire.php';

use App\Ctrl\Ctrl;
use App\Model\Lib\Commentaire\Commentaire as LibCommentaire;  


/** Lister des questions. */
class addCommentaire extends Ctrl
{
    /** @Override */
    public function getPageTitle(): ?string
    {
        return null;
    }

    public function getViewFile(): ?string
    {
        return '/view/article-detail.php';
    }

    /** @Override */
    public function do(): void
    {
        // Lister des commentaires
        $idArticle = $_POST['idArticle'];
        $idUser =  $_SESSION['user']['id'];
        $contenu = $_POST ['contenu'];
        $lang = $_SESSION['lang'];
        $lang = $_GET['lang'] ?? 'fr';

        $language = [];

        require $_SERVER['DOCUMENT_ROOT'] . "/view/lang/lang.$lang.php";
        $this->addViewArg('lang', $lang);
        $this->addViewArg('language', $language);
        LibCommentaire::createCommentaire($idArticle, $idUser, $contenu);        
        // Les expose à la vue
        
        $this->redirectTo('/ctrl/article-detail.php?id=' . $idArticle. '&lang=' . $lang);
}
}

// Exécute le Controlleur
$ctrl = new addCommentaire();
$ctrl->execute();
