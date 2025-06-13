<?php

namespace App\Ctrl;

require_once $_SERVER['DOCUMENT_ROOT'] . '/ctrl/ctrl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/task.php';

use App\Ctrl\Ctrl;
use App\Model\Lib\Task as LibTask;

class taskDelete extends Ctrl
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
        $id = $_GET['id'];

        LibTask::deleteTask($id);

        $this->redirectTo('/ctrl/task-list.php');
    }
}

$ctrl = new taskDelete();
$ctrl->execute();
