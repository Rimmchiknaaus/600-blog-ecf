<?php

namespace App\Model\Lib\Auth;

require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/bdd.php';

use PDO;
use  App\Model\Lib\BDD as LibBdd;


class Article
{
    public static function readAllArticle(): array
    {
        $query = '  SELECT article.id, idUser, article.titre, article.contenu, article.image, article.fichier, article.created_at, article.updated_at';
        $query .= ' FROM article';
        $statement = LibBdd::connect()->prepare($query);
        $statement->execute();
        $listArticle = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $listArticle;
    }

    public static function getArticle(string $id): ?array
    {
        // Prépare la requête
        $query = '  SELECT article.id, idUser, article.titre, article.contenu, article.image, article.fichier, article.created_at, article.updated_at';
        $query .= ' FROM article';
        $query .= ' WHERE article.id = :id';
        $statement = LibBdd::connect()->prepare($query);
        $statement->bindParam(':id', $id);

        $statement->execute();
        $a = $statement->fetch(PDO::FETCH_ASSOC);

        return $a;
    }

    public static function createArticle( $titre, $contenu, $image, $fichier): bool
    {
        // Prépare la requête
        // NOTE la requête a des paramètres !
        // NOTE il faut utiliser 'bindParam' pour 'faire le lien' entre, par exemple, le 'paramètre nommé' ':label' dans la requête, et la variable passée en paramètre de la fonction $label
        $query = '  INSERT INTO article(titre, contenu, image, fichier) VALUES(:titre, :contenu, :image, :fichier)';
        $statement = LibBdd::connect()->prepare($query);
        $statement->bindParam(':titre', $titre);
        $statement->bindParam(':contenu', $contenu);
        $statement->bindParam(':image', $image);
        $statement->bindParam(':fichier', $fichier);
        $successOrFailure = $statement->execute();

        return $successOrFailure;
    }

}