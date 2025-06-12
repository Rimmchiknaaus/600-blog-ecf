<?php

namespace App\Model\Lib\Auth;

require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/bdd.php';

use PDO;
use  App\Model\Lib\BDD as LibBdd;


class Auth
{

public static function getUtilisateur(string $email) 
    {
        // Prépare la requête
        $query = '  SELECT utilisateur.id, utilisateur.name, utilisateur.email, utilisateur.password, utilisateur.hashedPassword';
        $query .= ' FROM utilisateur';
        $query .= ' WHERE utilisateur.email = :email';
        $statement = LibBdd::connect()->prepare($query);
        $statement->bindParam(':email', $email);

        $statement->execute();
        $utilisateur = $statement->fetch(PDO::FETCH_ASSOC);

        return $utilisateur;
    }

    public static function createUtilisateur($name, $email,  $password, $hashedPassword): bool
    {
        // Prépare la requête
        // NOTE la requête a des paramètres !
        // NOTE il faut utiliser 'bindParam' pour 'faire le lien' entre, par exemple, le 'paramètre nommé' ':label' dans la requête, et la variable passée en paramètre de la fonction $label
        $query = '  INSERT INTO utilisateur(name, email, password, hashedPassword) VALUES(:name, :email, :password, :hashedPassword)';
        $statement = LibBdd::connect()->prepare($query);
        $statement->bindParam(':name', $name);
        $statement->bindParam(':email', $email);
        $statement->bindParam(':password', $password);
        $statement->bindParam(':hashedPassword', $hashedPassword);



        $successOrFailure = $statement->execute();

        return $successOrFailure;
    }   
    
public static function updateUtilisateur($id, $name, $email,  $password, $hashedPassword): bool
    {
        // Prépare la requête
        // NOTE la requête a des paramètres !
        // NOTE il faut utiliser 'bindParam' pour 'faire le lien' entre, par exemple, le 'paramètre nommé' ':label' dans la requête, et la variable passée en paramètre de la fonction $label
        $query = '  UPDATE utilisateur';
        $query.= '  SET';
        $query.= '  utilisateur.name = :name';
        $query.= '  ,utilisateur.email = :email';
        $query.= '  ,utilisateur.password = :password';
        $query.= '  ,utilisateur.hashedPassword = :hashedPassword';
        $query.= '  WHERE utilisateur.id = :id';
        $statement = LibBdd::connect()->prepare($query);
        $statement->bindParam(':id', $id);
        $statement->bindParam(':name', $name);
        $statement->bindParam(':email', $email);
        $statement->bindParam(':password', $password);
        $statement->bindParam(':hashedPassword', $hashedPassword);

        $successOrFailure = $statement->execute();

        return $successOrFailure;
}

}