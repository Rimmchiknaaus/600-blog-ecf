<?php

namespace App\Ctrl;

require_once $_SERVER['DOCUMENT_ROOT'] . '/ctrl/ctrl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/article.php';

use App\Ctrl\Ctrl;
use App\Model\Lib\Article\Article as LibArticle;

class articleDelete extends Ctrl
{
    public function getPageTitle(): ?string
    {
        return null;
    }

    public function getViewFile(): ?string
    {
        return null;
    }

    public function do(): void
    {
        $id = $_GET['id'];
        $lang = $_GET['lang'] ?? 'fr';

        LibArticle::deleteArticle($id);

        $this->redirectTo('/ctrl/article-list.php?lang=' . $lang);
    }
}

$ctrl = new articleDelete();
$ctrl->execute();
