<?php

namespace App\Ctrl;

require_once $_SERVER['DOCUMENT_ROOT'] . '/ctrl/ctrl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/article.php';
require $_SERVER['DOCUMENT_ROOT'] . "/view/lang/lang-init.php";

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
        // Déterminer la langue
        $lang = $_GET['lang'] ?? 'fr';
        // Charger les fichiers de traduction
        require $_SERVER['DOCUMENT_ROOT'] . "/view/lang/lang.$lang.php";
    
        // Récupérer les articles selon la catégorie (si spécifiée)
        $categorieId = $_GET['categorie'] ?? null;
        if ($categorieId) {
            $listArticle = LibArticle::getArticlesByCategorie($categorieId);
        } else {
            $listArticle = LibArticle::readAllArticle();
        }
    
        // Lire toutes les catégories
        $listCategorie = LibArticle::readAllCategorie();
    

    
        // Transmettre les variables à la vue
        $this->addViewArg('listArticle', $listArticle);
        $this->addViewArg('listCategorie', $listCategorie);
        $this->addViewArg('lang', $lang);
        $this->addViewArg('language', $language);
    }
    
}


// Exécute le Controlleur
$ctrl = new ArticleList();
$ctrl->execute();
