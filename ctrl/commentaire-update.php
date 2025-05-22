<?php

namespace App\Ctrl;

require_once $_SERVER['DOCUMENT_ROOT'] . '/ctrl/ctrl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/commentaire.php';

use App\Ctrl\Ctrl;
use App\Model\Lib\Commentaire\Commentaire as LibCommentaire; 

class commentUpdate extends Ctrl
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
        $id= $_POST['id'];
        $idArticle = $_POST['idArticle'];
        $contenu = $_POST ['contenu'];  
        $lang = $_GET['lang'] ?? 'fr';

        LibCommentaire::updateCommentaire ($id, $contenu);        
        // Les expose à la vue
        
        $this->redirectTo('/ctrl/article-detail.php?id=' . $idArticle. '&lang=' . $lang);
    }
}

$ctrl = new commentUpdate();
$ctrl->execute();