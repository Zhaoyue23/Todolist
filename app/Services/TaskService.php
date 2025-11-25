<?php
namespace App\Services;

use App\Repositories\TaskRepository;

class TaskService
{
    protected $repo;

    public function __construct(TaskRepository $repo)
    {
        $this->repo = $repo;
    }

    public function list($keyword = null, $status = null)
    {
        return $this->repo->searchAndFilter($keyword, $status);
    }

    public function create($task)
    {
        $task = trim($task);
        if ($task === '') {
            return false;
        }
        return $this->repo->create($task);
    }

    public function find($id) 
    { 
        return $this->repo->find($id); 
    }

    public function update($id, $task) 
    { 
        return $this->repo->update($id, $task); 
    }

    public function delete($id) 
    { 
        return $this->repo->delete($id); 
    }

    public function toggle($id) 
    { 
        return $this->repo->toggle($id); 
    }

    public function all() 
    { 
        return $this->repo->all(); 
    }
}
