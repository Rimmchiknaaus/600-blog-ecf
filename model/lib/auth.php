<?php

namespace App\Model\Lib\Auth;

require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/bdd.php';

use PDO;
use  App\Model\Lib\BDD as LibBdd;


class Auth
{

public static function getUser(string $email) 
    {
        // Prépare la requête
        $query = '  SELECT user.id, user.name, user.email, user.password, user.hashedPassword, user.role';
        $query .= ' FROM user';
        $query .= ' WHERE user.email = :email';
        $statement = LibBdd::connect()->prepare($query);
        $statement->bindParam(':email', $email);

        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        return $user;
    }

    public static function createUser($name, $email,  $password, $hashedPassword): bool
    {
        // Prépare la requête
        // NOTE la requête a des paramètres !
        // NOTE il faut utiliser 'bindParam' pour 'faire le lien' entre, par exemple, le 'paramètre nommé' ':label' dans la requête, et la variable passée en paramètre de la fonction $label
        $query = '  INSERT INTO user(name, email, password, hashedPassword) VALUES(:name, :email, :password, :hashedPassword)';
        $statement = LibBdd::connect()->prepare($query);
        $statement->bindParam(':name', $name);
        $statement->bindParam(':email', $email);
        $statement->bindParam(':password', $password);
        $statement->bindParam(':hashedPassword', $hashedPassword);



        $successOrFailure = $statement->execute();

        return $successOrFailure;
    }   
    
public static function updateUser($id, $name, $email,  $password, $hashedPassword): bool
    {
        // Prépare la requête
        // NOTE la requête a des paramètres !
        // NOTE il faut utiliser 'bindParam' pour 'faire le lien' entre, par exemple, le 'paramètre nommé' ':label' dans la requête, et la variable passée en paramètre de la fonction $label
        $query = '  UPDATE user';
        $query.= '  SET';
        $query.= '  user.name = :name';
        $query.= '  ,user.email = :email';
        $query.= '  ,user.password = :password';
        $query.= '  ,user.hashedPassword = :hashedPassword';
        $query.= '  WHERE user.id = :id';
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