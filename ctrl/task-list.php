<?php

namespace App\Ctrl;

require_once $_SERVER['DOCUMENT_ROOT'] . '/ctrl/ctrl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/task.php';

use App\Ctrl\Ctrl;
use App\Model\Lib\Task as LibTask;

class taskList extends Ctrl
{
    public function getPageTitle(): ?string
    {
        return 'To Do List';
    }

    public function getViewFile(): ?string
    {
        return '/view/task-list.php';
    }

    public function do(): void
    {

        // 3. Articles (selon catégorie ou non)
        $categorieId = $_GET['categorie'] ?? null;
        if ($categorieId) {
            $listTask = LibTask::getTaskByCategorie($categorieId);
        } else {
            $listTask = LibTask::readAllTask();
        }

        // 4. Catégories
        $listCategorie = LibTask::readAllCategorie();

        // 5. Transmettre à la vue
        $this->addViewArg('listTask', $listTask);
        $this->addViewArg('listCategorie', $listCategorie);
    }
}

$ctrl = new taskList();
$ctrl->execute();
