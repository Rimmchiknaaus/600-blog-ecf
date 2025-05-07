<?php

namespace App\Ctrl;

require_once $_SERVER['DOCUMENT_ROOT'] . '/ctrl/ctrl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/article.php';

use App\Ctrl\Ctrl;
use App\Model\Lib\Article\Article as LibArticle;  

/** Lister des questions. */
class ArticleList extends Ctrl
{
    /** @Override */
    public function getPageTitle(): ?string
    {
        return 'Blog';
    }

    public function getViewFile(): ?string
    {
        return '/view/article-list.php';
    }

    /** @Override */
    public function do(): void
    {
        // Lister des questions

        $categorieId = $_GET['categorie'] ?? null;
        if ($categorieId) {
            $listArticle =  LibArticle::getArticlesByCategorie($categorieId);
        } else {
            $listArticle = LibArticle::readAllArticle();
        }

        $listCategorie = LibArticle::readAllCategorie();

        // Les expose à la vue

        $this->addViewArg('listArticle', $listArticle);
        $this->addViewArg('listCategorie', $listCategorie);

    }
}


// Exécute le Controlleur
$ctrl = new ArticleList();
$ctrl->execute();
