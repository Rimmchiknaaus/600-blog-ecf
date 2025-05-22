<?php

namespace App\Ctrl;

require_once $_SERVER['DOCUMENT_ROOT'] . '/ctrl/ctrl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/commentaire.php';

use App\Ctrl\Ctrl;
use App\Model\Lib\Commentaire\Commentaire as LibCommentaire;

class CommentaireUpdate extends Ctrl
{
    public function getPageTitle(): ?string { 
        return null; 
    }

    public function getViewFile(): ?string{ 
        return null; 
    }

    public function do(): void
    {
        $id = $_POST['id'];
        $idArticle = $_POST['idArticle'];
        $contenu = $_POST['contenu'];
        $lang = $_POST['lang'] ?? 'fr';

        LibCommentaire::updateCommentaire($id, $contenu);
        $this->redirectTo('/ctrl/article-detail.php?id=' . $idArticle . '&lang=' . $lang);
    }
}

$ctrl = new CommentaireUpdate();
$ctrl->execute();
