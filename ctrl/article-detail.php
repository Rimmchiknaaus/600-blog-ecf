<?php

namespace App\Ctrl;

require_once $_SERVER['DOCUMENT_ROOT'] . '/ctrl/ctrl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/article.php';

use App\Ctrl\Ctrl;
use App\Model\Lib\Article\Article as LibArticle;  

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
        // Lister des questions
        $id = $_GET['id'];
        $article = LibArticle::getArticle($id);
        // Les expose à la vue

        $this->addViewArg('article', $article);
}
}

// Exécute le Controlleur
$ctrl = new articleShow();
$ctrl->execute();


