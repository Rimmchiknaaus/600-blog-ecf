<?php

namespace App\Ctrl;

require_once $_SERVER['DOCUMENT_ROOT'] . '/ctrl/ctrl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/task.php';

use App\Ctrl\Ctrl;
use App\Model\Lib\Task as LibTask;

class taskUpdate extends Ctrl
{
    public function getPageTitle(): ?string
    {
        return null;
    }

    public function getViewFile(): ?string
    {
        return null;
    }

    public function do(): void
    {
        // Lis les informations saisies dans le formulaire
        $id =  $_POST['id'];
        $idCategorie = $_POST['idCategorie'];
        $name = $_POST['name'];
        $description =  $_POST['description'];

        LibTask::updateTask($id, $idCategorie, $name, $description);

        // rediriger vers l'article
        $this->redirectTo('/ctrl/task-list.php');


    }
}

$ctrl = new taskUpdate();
$ctrl->execute();
