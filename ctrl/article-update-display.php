<?php

namespace App\Ctrl;

require_once $_SERVER['DOCUMENT_ROOT'] . '/ctrl/ctrl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/article.php';

use App\Ctrl\Ctrl;
use App\Model\Lib\Article\Article as LibArticle;

class ArticleUpdateDisplay extends Ctrl
{
    public function getPageTitle(): ?string
    {
        return 'Modifier article';
    }

    public function getViewFile(): ?string
    {
        return '/view/article-update.php';
    }

    public function do(): void
    {
        $id = $_GET ['id'];   
        $lang = $_GET['lang'] ?? 'fr';
        $language = [];     
        $article = LibArticle::getArticle($id);
        $listCategorie = LibArticle::readAllCategorie();
        $articleCategorie = LibArticle::getCategorieIdsForArticle($id);

        require $_SERVER['DOCUMENT_ROOT'] . "/view/lang/lang.$lang.php";

        $this->addViewArg('lang', $lang);
        $this->addViewArg('language', $language);
        $this->addViewArg('article', $article);
        $this->addViewArg('articleCategorie', $articleCategorie);
        $this->addViewArg('listCategorie', $listCategorie);


    }
}

$ctrl = new ArticleUpdateDisplay();
$ctrl->execute();
