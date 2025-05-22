<?php

namespace App\Ctrl;

require_once $_SERVER['DOCUMENT_ROOT'] . '/ctrl/ctrl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/commentaire.php';

use App\Ctrl\Ctrl;
use App\Model\Lib\Commentaire\Commentaire as LibCommentaire;

class addCommentaire extends Ctrl
{
    public function getPageTitle(): ?string
    {
        return null;
    }

    public function getViewFile(): ?string
    {
        return '/view/article-detail.php';
    }

    public function do(): void
    {
        $idArticle = $_POST['idArticle'];
        $idUser = $_SESSION['user']['id'];
        $contenu = $_POST['contenu'];
        $lang = $_GET['lang'] ?? 'fr';

        require $_SERVER['DOCUMENT_ROOT'] . "/view/lang/lang.$lang.php";

        $this->addViewArg('lang', $lang);
        $this->addViewArg('language', $language);

        LibCommentaire::createCommentaire($idArticle, $idUser, $contenu);

        $this->redirectTo('/ctrl/article-detail.php?id=' . $idArticle . '&lang=' . $lang);
    }
}

$ctrl = new addCommentaire();
$ctrl->execute();
