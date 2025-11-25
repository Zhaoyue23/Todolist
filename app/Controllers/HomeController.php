<?php

namespace App\Controllers;

use App\Models\TaskModel;

class HomeController
{
    protected $twig;
    protected $taskModel;

    public function __construct($twig, $pdo)
    {
        $this->twig = $twig;
        $this->taskModel = new TaskModel($pdo);
    }

    public function index()
    {
        $tasks = $this->taskModel->all();

        return $this->twig->render('tasks/index.twig', [
            'tasks' => $tasks
        ]);
    }
}
