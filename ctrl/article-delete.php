<?php

namespace App\Ctrl;

require_once $_SERVER['DOCUMENT_ROOT'] . '/ctrl/ctrl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/article.php';

use App\Ctrl\Ctrl;
use App\Model\Lib\Article\Article as LibArticle;

class articleDelete extends Ctrl
{
    /** @Override */
    public function getPageTitle(): ?string
    {
        return null;
    }
    public function getViewFile(): ?string
    {
        return null;
    }

    /** @Override */
    public function do(): void
    {
        //Supprime la Question
        $id = $_GET['id'];
        LibArticle::deleteArticle($id);
        $lang = $_GET['lang'] ?? 'fr';

        // // Redirige vers la liste des Questions
        $this->redirectTo('/ctrl/article-list.php?lang=' . $lang);
    }
}


// Exécute le Controlleur
$ctrl = new articleDelete();
$ctrl->execute();