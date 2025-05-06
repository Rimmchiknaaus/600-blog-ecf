<?php

namespace App\Model\Lib\Commentaire;

require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/bdd.php';

use PDO;
use  App\Model\Lib\BDD as LibBdd;

class Commentaire
{
    public static function listCommentaireFromArticle($idArticle): array
    {
        $query = '  SELECT commentaire.id, commentaire.idArticle, commentaire.idUser, commentaire.contenu, commentaire.created_at, commentaire.updated_at, user.name AS auteur';
        $query .= ' FROM commentaire';
        $query .= ' JOIN user ON commentaire.idUser = user.id';
        $query .= ' WHERE commentaire.idArticle = :idArticle';
        $query .= ' ORDER BY commentaire.created_at DESC';
        $statement = LibBdd::connect()->prepare($query);
        $statement->bindParam(':idArticle', $idArticle, \PDO::PARAM_INT);

        $statement->execute();
        $commentaireList = $statement->fetchAll(\PDO::FETCH_ASSOC);

        return $commentaireList;
    }

    public static function createCommentaire($idArticle, $idUser, $contenu): bool
    {
        $query = '  INSERT INTO commentaire(idArticle, idUser, contenu) VALUES(:idArticle, :idUser, :contenu)';
        $statement = LibBdd::connect()->prepare($query);
        $statement->bindParam(':idArticle', $idArticle);
        $statement->bindParam(':idUser', $idUser);
        $statement->bindParam(':contenu', $contenu);

        $successOrFailure = $statement->execute();

        return $successOrFailure;
    }

    public static function getCommentaire($id):  ?array
    {
        $query = '  SELECT commentaire.id, commentaire.idArticle, commentaire.idUser, commentaire.contenu, commentaire.created_at, commentaire.updated_at, user.name AS auteur';
        $query .= ' FROM commentaire';
        $query .= ' WHERE commentaire.id = :id';
        $statement = LibBdd::connect()->prepare($query);
        $statement->bindParam(':id', $id);

        $commentaire = $statement->fetch(PDO::FETCH_ASSOC);

        return $commentaire;
    }

    public static function updateCommentaire($id, $contenu):  bool
    {
        $query = '  UPDATE commentaire';
        $query .= ' SET ';
        $query .= ' commentaire.contenu = :contenu ';
        $query .= ' WHERE commentaire.id = :id';
        $statement = LibBdd::connect()->prepare($query);
        $statement->bindParam(':contenu', $contenu);
        $statement->bindParam(':id', $id);


        $successOrFailure = $statement->execute();

        return $successOrFailure;
    }
    public static function deleteCommentaire($id):  bool
    {
        $query = '  DELETE FROM commentaire';
        $query .= ' WHERE commentaire.id = :id';
        $statement = LibBdd::connect()->prepare($query);
        $statement->bindParam(':id', $id);


        $successOrFailure = $statement->execute();

        return $successOrFailure;
    }

}