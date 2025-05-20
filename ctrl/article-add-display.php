<?php

namespace App\Ctrl;

require_once $_SERVER['DOCUMENT_ROOT'] . '/ctrl/ctrl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/article.php';

use App\Ctrl\Ctrl;
use App\Model\Lib\Article\Article as LibArticle;

class ArticleAddDisplay extends Ctrl
{
    public function getPageTitle(): ?string
    {
        return 'Nouvel article';
    }

    public function getViewFile(): ?string
    {
        return '/view/article-add.php?lang= . $lang';
    }

    public function do(): void
    {

        $listCategorie = LibArticle::readAllCategorie();
        $this->addViewArg('listCategorie', $listCategorie);        
    }
}

$ctrl = new ArticleAddDisplay();
$ctrl->execute();
