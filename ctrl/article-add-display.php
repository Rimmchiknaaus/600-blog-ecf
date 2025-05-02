<?php

include '../model/lib/article.php';
use App\Model\Lib\Article\Article as LibArticle;  
// Définit le titre de la page
$pageTitle = "Nouvel article";


$listCategorie = LibArticle::readAllCategorie();

// Rends la vue
include '../view/_header.php';
include '../view/article-add.php';
include '../view/_footer.php';