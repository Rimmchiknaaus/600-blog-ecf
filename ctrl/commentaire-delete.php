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
        $id= $_GET['id'];
        LibCommentaire::deleteCommentaire($id); 
        $idArticle = $_GET['idArticle'];  
        // Les expose à la vue
        
        $this->redirectTo('/ctrl/article-detail.php?id=' . $idArticle);
    }
}

$ctrl = new commentDelete();
$ctrl->execute();