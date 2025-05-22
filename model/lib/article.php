<?php

namespace App\Model\Lib\Article;

require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/bdd.php';

use PDO;
use  App\Model\Lib\BDD as LibBdd;


class Article
{
    public static function readAllArticle(string $lang = 'fr'): array
    {
        $titreCol = $lang . '_titre';
        $contenuCol = $lang . '_contenu';

        $query = "SELECT article.id, article.idUser, article.$titreCol AS titre, article.$contenuCol AS contenu, article.image, article.fichier, article.created_at, article.updated_at, user.name AS auteur, GROUP_CONCAT(categorie.label SEPARATOR ' / ') AS categories";
        $query .= ' FROM article';
        $query .= ' JOIN user ON article.idUser = user.id';
        $query .= ' LEFT JOIN article_categorie ON article.id = article_categorie.idArticle';
        $query .= ' LEFT JOIN categorie ON article_categorie.idCategorie = categorie.id'; 
        $query .= ' GROUP BY article.id';
        $query .= ' ORDER BY article.created_at DESC';
        $statement = LibBdd::connect()->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getArticle(int $id, string $lang = 'fr'): ?array
    {
        $titreCol = $lang . '_titre';
        $contenuCol = $lang . '_contenu';

        $query =  "SELECT article.id, article.idUser, article.$titreCol AS titre, article.$contenuCol AS contenu, article.image, article.fichier, article.created_at, article.updated_at, user.name AS auteur, GROUP_CONCAT(categorie.label SEPARATOR ' / ') AS categories";
        $query .= ' FROM article';
        $query .= ' JOIN user ON article.idUser = user.id';
        $query .= ' LEFT JOIN article_categorie ON article.id = article_categorie.idArticle';
        $query .= ' LEFT JOIN categorie ON article_categorie.idCategorie = categorie.id';
        $query .= ' WHERE article.id = :id';
        $statement = LibBdd::connect()->prepare($query);
        $statement->bindParam(':id', $id);
        $statement->execute();
    
        $article = $statement->fetch(PDO::FETCH_ASSOC);

    
        return $article;
    }

    public static function readAllCategorie(): ?array
    {
        $query = 'SELECT categorie.id, categorie.label FROM categorie ORDER BY label ASC';
        $statement = LibBdd::connect()->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getCategorieIdsForArticle(int $id): array
    {
        $query = 'SELECT idCategorie FROM article_categorie WHERE idArticle = :id';
        $statement = LibBdd::connect()->prepare($query);
        $statement->bindParam(':id', $id);
        $statement->execute();
        $idCategorie = $statement->fetchAll(PDO::FETCH_ASSOC);
        return array_column($idCategorie, 'idCategorie');
    }

    public static function getArticlesByCategorie(int $categorieId): array
    {
        $query = "SELECT article.id, article.idUser, article.en_titre, article.en_contenu, article.fr_titre, article.fr_contenu, article.image, article.fichier, article.created_at, article.updated_at, user.name AS auteur, GROUP_CONCAT(DISTINCT categorie.label SEPARATOR ' / ') AS categories";
        $query .= ' FROM article';
        $query .= ' JOIN user ON article.idUser = user.id';
        $query .= ' JOIN article_categorie ON article.id = article_categorie.idArticle';
        $query .= ' JOIN categorie ON categorie.id = article_categorie.idCategorie';
        $query .= ' WHERE article_categorie.idCategorie = :categorieId';
        $query .= ' GROUP BY article.id';
        $query .= ' ORDER BY article.created_at DESC';

        $statement = LibBdd::connect()->prepare($query);
        $statement->bindParam(':categorieId', $categorieId, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function createArticle(string $lang, string $titre, string $contenu, $categories, string $imagePath, ?string $fichierPath, int $idUser): bool 
    {
        $pdo = LibBdd::connect();

        $titreCol = $lang . '_titre';
        $contenuCol = $lang . '_contenu';

        $query = "INSERT INTO article (idUser, $titreCol, $contenuCol, image, fichier) VALUES (:idUser, :titre, :contenu, :image, :fichier)";
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
                $stmtCat = $pdo->prepare("INSERT INTO article_categorie (idArticle, idCategorie) VALUES (:idArticle, :idCategorie)");
                foreach ($categories as $catId) {
                    $stmtCat->execute([
                        ':idArticle' => $articleId,
                        ':idCategorie' => $catId
                    ]);
                }
            }
        }

        return $successOrFailure;
    }

    public static function updateArticle(int $id, string $lang,  string $titre, string $contenu, $categories, ?string $image, ?string $fichier): bool
    {

        $titreCol = $lang . '_titre';
        $contenuCol = $lang . '_contenu';

        $query = "UPDATE article SET $titreCol = :titre, $contenuCol = :contenu, image = :image, fichier = :fichier WHERE id = :id";

        $statement = LibBdd::connect()->prepare($query);
        $statement->bindParam(':titre', $titre);
        $statement->bindParam(':contenu', $contenu);
        $statement->bindParam(':image', $image);
        $statement->bindParam(':fichier', $fichier);
        $statement->bindParam(':id', $id);

        $statement->execute(); 

        $stmtDelete = LibBdd::connect()->prepare('DELETE FROM article_categorie WHERE idArticle = :idArticle');
        $stmtDelete->execute([':idArticle' => $id]);

        $stmtInsert = LibBdd::connect()->prepare('INSERT INTO article_categorie (idArticle, idCategorie) VALUES (:idArticle, :idCategorie)');
        foreach ($categories as $catId) {
            $stmtInsert->execute([
                ':idArticle' => $id,
                ':idCategorie' => $catId
            ]);
        }

        return true;
    }

    public static function deleteArticle(int $id): bool
    {
        $db = LibBdd::connect(); 
        $db->beginTransaction();

        $query = 'DELETE FROM article_categorie WHERE idArticle = :id';
        $statement = $db->prepare($query);
        $statement->bindParam(':id', $id);
        $statement->execute();

        $query = 'DELETE FROM commentaire WHERE idArticle = :id';
        $statement = $db->prepare($query);
        $statement->bindParam(':id', $id);
        $statement->execute();

        $query = 'DELETE FROM article WHERE id = :id';
        $statement = $db->prepare($query);
        $statement->bindParam(':id', $id);
        $statement->execute();

        $db->commit();
        return true;
    }
}
