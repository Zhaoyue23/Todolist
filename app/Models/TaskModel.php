<?php

namespace App\Models;

class TaskModel
{
    protected $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function all()
    {
        $stmt = $this->pdo->query("SELECT * FROM todos ORDER BY id DESC");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function create($task)
    {
        $stmt = $this->pdo->prepare("INSERT INTO todos (task) VALUES (?)");
        return $stmt->execute([$task]);
    }

    public function toggle($id)
    {
        $stmt = $this->pdo->prepare("UPDATE todos SET is_completed = NOT is_completed WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM todos WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function find($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM todos WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function update($id, $task)
    {
        $stmt = $this->pdo->prepare("UPDATE todos SET task = ? WHERE id = ?");
        return $stmt->execute([$task, $id]);
    }

    public function filter($search = null, $status = null)
    {
        $sql = "SELECT * FROM todos WHERE 1";

        $params = [];

        if ($search) {
            $sql .= " AND task LIKE ?";
            $params[] = "%$search%";
        }

        if ($status === 'pending') {
            $sql .= " AND is_completed = 0";
        } elseif ($status === 'completed') {
            $sql .= " AND is_completed = 1";
        }

        $sql .= " ORDER BY id DESC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }


}
