<?php

namespace App\Ctrl;

require_once $_SERVER['DOCUMENT_ROOT'] . '/ctrl/ctrl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/article.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/commentaire.php';

use App\Ctrl\Ctrl;
use App\Model\Lib\Article\Article as LibArticle;  
use App\Model\Lib\Commentaire\Commentaire as LibCommentaire;  


/** Lister des questions. */
class articleShow extends Ctrl
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
        $id = $_GET['id'];
        $articleList = LibArticle::getArticle($id);        
        $commentaireList = LibCommentaire::listCommentaireFromArticle($id);        
        // Les expose à la vue
        
        $this->addViewArg('articleList', $articleList);

        // Les expose à la vue

        $this->addViewArg('commentaireList', $commentaireList);
}
}

// Exécute le Controlleur
$ctrl = new articleShow();
$ctrl->execute();


