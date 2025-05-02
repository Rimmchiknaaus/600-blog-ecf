<?php

namespace App\Ctrl;

require_once $_SERVER['DOCUMENT_ROOT'] . '/ctrl/ctrl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/article.php';

use App\Ctrl\Ctrl;
use App\Model\Lib\Article\Article as LibArticle;  

class ArticleAdd extends Ctrl
{
    /** @Override */
    public function getPageTitle(): ?string
    {
        return null;
    }

    /** @Override */
    public function getViewFile(): ?string
    {
        return null;
    }

    /** @Override */
    public function do(): void
    {
        // Lis les informations saisies dans le formulaire
        $number = $_POST['number'];
        $label = $_POST['label'];
        LibArticle;

        // rediriger vers la list de question
        $this->redirectTo('/ctrl/article-list.php');
    }
}

// Exécute le Controlleur
$ctrl = new ArticleAdd();
$ctrl->execute();