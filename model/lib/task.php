<?php

namespace App\Model\Lib;

require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/bdd.php';

use PDO;
use  App\Model\Lib\BDD as LibBdd;


class Task
{
    public static function readAllTask(): array
    {

        $query = "SELECT task.id, task.idUtilisateur, task.idCategorie, task.name, task.description, task.created_at, task.updated_at, categorie.label AS categorie";
        $query .= ' FROM task';
        $query .= ' JOIN utilisateur ON task.idUtilisateur = utilisateur.id';
        $query .= ' LEFT JOIN categorie ON task.idCategorie = categorie.id'; 
        $query .= ' ORDER BY categorie.displayRank, task.name';
        $statement = LibBdd::connect()->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getTask(int $id): ?array
    {
        $query = "SELECT task.id, task.idUtilisateur, task.idCategorie, task.name, task.description, task.created_at, task.updated_at, categorie.label AS categorie";
        $query .= ' FROM task';
        $query .= ' JOIN utilisateur ON task.idUtilisateur = utilisateur.id';
        $query .= ' LEFT JOIN categorie ON task.idCategorie = categorie.id'; 
        $query .= ' WHERE task.id = :id';
        $statement = LibBdd::connect()->prepare($query);
        $statement->bindParam(':id', $id);
        $statement->execute();
    
        $task = $statement->fetch(PDO::FETCH_ASSOC);

    
        return $task;
    }

    public static function readAllCategorie(): ?array
    {
        $query = 'SELECT categorie.id, categorie.label, categorie.displayRank, categorie.label AS categorie';
        $query .= ' FROM categorie';
        $query .= ' ORDER BY categorie.displayRank';
        $statement = LibBdd::connect()->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getTaskByCategorie(int $categorieId): array
    {
        $query = "SELECT task.id, task.idUtilisateur, task.idCategorie, task.name, task.description, task.created_at, task.updated_at, categorie.label AS categorie";
        $query .= ' FROM task';
        $query .= ' JOIN utilisateur ON task.idUtilisateur = utilisateur.id';
        $query .= ' LEFT JOIN categorie ON task.idCategorie = categorie.id'; 
        $query .= ' WHERE categorie.id = :categorieId';
        $query .= ' ORDER BY categorie.displayRank, task.name';

        $statement = LibBdd::connect()->prepare($query);
        $statement->bindParam(':categorieId', $categorieId, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function createTask($idUtilisateur, $idCategorie, $name, $description): bool 
    {
        $query = "INSERT INTO task (idUtilisateur, idCategorie, name, description) VALUES (:idUtilisateur, :idCategorie, :name, :description)";
        $statement = LibBdd::connect()->prepare($query);

        $statement->bindParam(':idUtilisateur', $idUtilisateur);
        $statement->bindParam(':idCategorie', $idCategorie);
        $statement->bindParam(':name', $name);
        $statement->bindParam(':description', $description);

        $statement->execute();
        return true;
    }

    public static function updateTask(int $id, $idCategorie, $name, $description): bool
    {
        $query = "UPDATE task SET idCategorie = :idCategorie, name = :name, description = :description WHERE id = :id";

        $statement = LibBdd::connect()->prepare($query);
        $statement->bindParam(':idCategorie', $idCategorie);
        $statement->bindParam(':name', $name);
        $statement->bindParam(':description', $description);
        $statement->bindParam(':id', $id);

        $statement->execute(); 

        return true;
    }

    public static function deleteTask(int $id): bool
    {
        $query = '  DELETE FROM task';
        $query .= ' WHERE task.id = :id';
        $statement = LibBdd::connect()->prepare($query);
        $statement->bindParam(':id', $id);


        $successOrFailure = $statement->execute();

        return $successOrFailure;
    }
}
