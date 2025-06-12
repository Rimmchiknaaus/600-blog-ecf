<?php

namespace App\Ctrl;

require_once $_SERVER['DOCUMENT_ROOT'] . '/ctrl/ctrl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/task.php';

use App\Ctrl\Ctrl;
use App\Model\Lib\Task as LibTask;

class taskAdd extends Ctrl
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
        $idUtilisateur = $_SESSION['utilisateur']['id'];
        $idCategorie = $_POST['idCategorie'];
        $name = $_POST['name'];
        $description = $_POST['description'];

        LibTask::createTask($idUtilisateur, $idCategorie, $name, $description);

        $this->redirectTo('/ctrl/task-list.php');
    }
}

$ctrl = new taskAdd();
$ctrl->execute();
