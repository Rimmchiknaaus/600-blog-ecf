<?php

namespace App\Model\Lib\Auth;

require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/bdd.php';

use PDO;
use  App\Model\Lib\BDD as LibBdd;


class Article
{
    public static function readAllArticle(): array
    {
        $query = '  SELECT article.id, article.idUser, article.titre, article.contenu, article.image, article.fichier, article.created_at, article.updated_at, user.name AS auteur, GROUP_CONCAT(categorie.label SEPARATOR ' / ') AS categories';
        $query .= ' FROM article';
        $query .= ' JOIN user ON article.idUser = user.id';
        $query .= ' JOIN LEFT article_categorie ON article.id = article_categorie.idArtticle';
        $query .= ' JOIN LEFT categorie ON article_categorie.idCategorie = categorie.id';
        $query .= ' GROUP BY article.id';
        $query .= ' ORDER BY article.created_at DESC';
        $statement = LibBdd::connect()->prepare($query);
        $statement->execute();
        $listArticle = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $listArticle;
    }

}