<?php

namespace App\Ctrl;

require_once $_SERVER['DOCUMENT_ROOT'] . '/ctrl/ctrl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/commentaire.php';

use App\Ctrl\Ctrl;
use App\Model\Lib\Commentaire\Commentaire as LibCommentaire;

class commentDelete extends Ctrl
{
    public function getPageTitle(): ?string
    {
        return null;
    }

    public function getViewFile(): ?string
    {
        return null;
    }

    public function do(): void
    {
        $id = $_GET['id'];
        $idArticle = $_GET['idArticle'];
        $lang = $_GET['lang'] ?? 'fr';

        require $_SERVER['DOCUMENT_ROOT'] . "/view/lang/lang.$lang.php";

        $this->addViewArg('lang', $lang);
        $this->addViewArg('language', $language);

        LibCommentaire::deleteCommentaire($id);

        $this->redirectTo('/ctrl/article-detail.php?id=' . $idArticle . '&lang=' . $lang);
    }
}

$ctrl = new commentDelete();
$ctrl->execute();
