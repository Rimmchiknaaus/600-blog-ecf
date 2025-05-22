<?php

namespace App\Ctrl;

require_once $_SERVER['DOCUMENT_ROOT'] . '/ctrl/ctrl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/article.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/commentaire.php';

use App\Ctrl\Ctrl;
use App\Model\Lib\Article\Article as LibArticle;  
use App\Model\Lib\Commentaire\Commentaire as LibCommentaire;  

class articleShow extends Ctrl
{
    public function getPageTitle(): ?string
    {
        return 'Lire plus';
    }

    public function getViewFile(): ?string
    {
        return '/view/article-detail.php';
    }

    public function do(): void
    {
        $id = $_GET['id'];
        $lang = $_GET['lang'] ?? 'fr';

        require $_SERVER['DOCUMENT_ROOT'] . '/view/lang/lang.' . $lang . '.php';

        $article = LibArticle::getArticle($id, $lang);
        $commentaireList = LibCommentaire::listCommentaireFromArticle($id);

        $this->addViewArg('article', $article);
        $this->addViewArg('commentaireList', $commentaireList);
        $this->addViewArg('lang', $lang);
        $this->addViewArg('language', $language);
    }
}

$ctrl = new articleShow();
$ctrl->execute();
