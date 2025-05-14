<?php

namespace App\Model\Lib\Lang;

require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/bdd.php';

use PDO;
use  App\Model\Lib\BDD as LibBdd;


class Lang
{
    private $ds;
    public function getAllRecords()
    {
        $query = 'select * from article';
        $result = $this->ds->select($query);
        return $result;
    }

}