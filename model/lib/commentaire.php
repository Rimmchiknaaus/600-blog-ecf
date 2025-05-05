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

    
}