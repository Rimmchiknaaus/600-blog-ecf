<?php

namespace App\Model\Lib\Article;

require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/bdd.php';

use PDO;
use  App\Model\Lib\BDD as LibBdd;


class Article
{
    public static function readAllArticle(): array
    {
        $query = "SELECT article.id, article.idUser, article.titre, article.contenu, article.image, article.fichier, article.created_at, article.updated_at, user.name AS auteur, GROUP_CONCAT(categorie.label SEPARATOR ' / ') AS categories";
        $query .= ' FROM article';
        $query .= ' JOIN user ON article.idUser = user.id';
        $query .= ' LEFT JOIN article_categorie ON article.id = article_categorie.idArticle';
        $query .= ' LEFT JOIN categorie ON article_categorie.idCategorie = categorie.id';
        $query .= ' GROUP BY article.id';
        $query .= ' ORDER BY article.created_at DESC';
        $statement = LibBdd::connect()->prepare($query);
        $statement->execute();
        $listArticle = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $listArticle;
    }

    public static function readAllCategorie(): array
    {
        $query = '  SELECT categorie.id, categorie.label';
        $query .= ' FROM categorie';
        $statement = LibBdd::connect()->prepare($query);

        $statement->execute();
        $listCategorie = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $listCategorie;
    }

    public static function createArticle( string $titre, string $contenu, $categories, string $imagePath,?string $fichierPath,int $idUser): bool {
        $pdo = LibBdd::connect();
    
        $query = 'INSERT INTO article (idUser, titre, contenu, image, fichier) VALUES (:idUser, :titre, :contenu, :image, :fichier)';
        $statement = $pdo->prepare($query);

        $statement->bindParam(':idUser', $idUser);
        $statement->bindParam(':titre', $titre);
        $statement->bindParam(':contenu', $contenu);
        $statement->bindParam(':image', $imagePath);
        $statement->bindParam(':fichier', $fichierPath);
    
        $successOrFailure = $statement->execute();
    
        if ($successOrFailure) {
            $articleId = $pdo->lastInsertId();
    
            if (!empty($categories)) {
                $stmtCat = $pdo->prepare("
                    INSERT INTO article_categorie (idArticle, idCategorie)
                    VALUES (:idArticle, :idCategorie)
                ");
                foreach ($categories as $catId) {
                    $stmtCat->execute([
                        'idArticle' => $articleId,
                        'idCategorie' => $catId
                    ]);
                }
            }
        }
    
        return $successOrFailure;
    }
}    