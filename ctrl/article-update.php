<?php

namespace App\Ctrl;

require_once $_SERVER['DOCUMENT_ROOT'] . '/ctrl/ctrl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/article.php';

use App\Ctrl\Ctrl;
use App\Model\Lib\Article\Article as LibArticle;

class ArticleUpdate extends Ctrl
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
        // Lis les informations saisies dans le formulaire

        $lang =  $_POST['lang'];
        $id =  $_POST['id'];
        $titre = $_POST['titre'];
        $contenu = $_POST['contenu'];
        $categories =  $_POST['categories'];

        $imagePath = null;
        if (!empty($_FILES['image']['name'])) {
            $imageName = uniqid() . '_' . basename($_FILES['image']['name']);
            $imagePath = '/uploads/images/' . $imageName;
            move_uploaded_file($_FILES['image']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $imagePath);
        }


        $fichierPath = null;
        if (!empty($_FILES['fichier']['name'])) {
            $fileName = uniqid() . '_' . basename($_FILES['fichier']['name']);
            $fichierPath = '/uploads/files/' . $fileName;
            move_uploaded_file($_FILES['fichier']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $fichierPath);
        }
        LibArticle::updateArticle($id, $lang, $titre, $contenu, $categories, $imagePath, $fichierPath);

        // rediriger vers l'article
        $this->redirectTo('/ctrl/article-detail.php?id=' . $id . '&lang=' . $lang);
    }
}

$ctrl = new ArticleUpdate();
$ctrl->execute();
