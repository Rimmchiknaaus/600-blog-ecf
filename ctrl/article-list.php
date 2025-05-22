<?php

namespace App\Ctrl;

require_once $_SERVER['DOCUMENT_ROOT'] . '/ctrl/ctrl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/article.php';

use App\Ctrl\Ctrl;
use App\Model\Lib\Article\Article as LibArticle;

class ArticleList extends Ctrl
{
    public function getPageTitle(): ?string
    {
        return 'Blog';
    }

    public function getViewFile(): ?string
    {
        return '/view/article-list.php';
    }

    public function do(): void
    {
        // 1. Langue
        $lang = $_GET['lang'] ?? 'fr';

        // 2. Charger le bon fichier de langue
        require $_SERVER['DOCUMENT_ROOT'] . "/view/lang/lang.$lang.php";

        // 3. Articles (selon catégorie ou non)
        $categorieId = $_GET['categorie'] ?? null;
        if ($categorieId) {
            $listArticle = LibArticle::getArticlesByCategorie($categorieId, $lang);
        } else {
            $listArticle = LibArticle::readAllArticle($lang);
        }

        // 4. Catégories
        $listCategorie = LibArticle::readAllCategorie();

        // 5. Transmettre à la vue
        $this->addViewArg('listArticle', $listArticle);
        $this->addViewArg('listCategorie', $listCategorie);
        $this->addViewArg('lang', $lang);
        $this->addViewArg('language', $language);
    }
}

$ctrl = new ArticleList();
$ctrl->execute();
