<?php
namespace App\Controllers;

use App\Repositories\TaskRepository;
use App\Models\TaskModel;
use App\Services\TaskService;
use App\Core\Request;
use App\Core\BaseController;

class TaskController extends BaseController
{
    protected $service;

    public function __construct($twig, $pdo)
    {
        parent::__construct($twig, $pdo);
        $repo = new TaskRepository($this->pdo);
        $this->service = new TaskService($repo);
    }

    public function index()
    {
        $model = new TaskModel($this->pdo);

        $search = $_GET['search'] ?? null;
        $status = $_GET['status'] ?? null;

        $tasks = $model->filter($search, $status);

        return $this->twig->render('tasks/index.twig', [
            'tasks' => $tasks,
            'search' => $search,
            'status' => $status,
        ]);
    }

    public function show(Request $request)
    {
        $id = $request->get['id'] ?? null;
        if (!$id) { return $this->redirect('/tasks'); }
        $task = $this->service->find($id);
        if (!$task) { return $this->redirect('/tasks'); }
        return $this->twig->render('tasks/show.twig', ['task'=>$task]);
    }

    public function create(Request $request)
    {
        if (!$request->isPost()) {
            return $this->redirect('/tasks');
        }
        $task = $request->post['task'] ?? null;
        $this->service->create($task);
        return $this->redirect('/tasks');
    }

    public function edit(Request $request)
    {
        $id = $request->get['id'] ?? null;
        if (!$id) { return $this->redirect('/tasks'); }
        $task = $this->service->find($id);
        return $this->twig->render('tasks/edit.twig', ['task' => $task]);
    }

    public function update(Request $request)
    {
        if (!$request->isPost()) return $this->redirect('/tasks');
        $id = $request->post['id'] ?? null;
        $task = $request->post['task'] ?? null;
        if ($id && $task !== null) $this->service->update($id, $task);
        return $this->redirect('/tasks');
    }

    public function delete(Request $request)
    {
        if (!$request->isPost()) return $this->redirect('/tasks');
        $id = $request->post['id'] ?? null;
        if ($id) $this->service->delete($id);
        return $this->redirect('/tasks');
    }

    public function toggle(Request $request)
    {
        if (!$request->isPost()) return $this->redirect('/tasks');
        $id = $request->post['id'] ?? null;
        if ($id) $this->service->toggle($id);
        return $this->redirect('/tasks');
    }
}
