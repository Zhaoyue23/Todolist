<?php
namespace App\Repositories;

use PDO;

class TaskRepository
{
    protected $pdo;
    protected $table = 'todos';

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function all() {
        $stmt = $this->pdo->query("SELECT * FROM todos ORDER BY id DESC");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($task)
    {
        $stmt = $this->pdo->prepare("INSERT INTO {$this->table} (task) VALUES (?)");
        $stmt->execute([$task]);
        return $this->pdo->lastInsertId();
    }

    public function update($id, $task)
    {
        $stmt = $this->pdo->prepare("UPDATE {$this->table} SET task = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ?");
        return $stmt->execute([$task, $id]);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function toggle($id)
    {
        $stmt = $this->pdo->prepare("UPDATE {$this->table} SET is_completed = NOT is_completed, updated_at = CURRENT_TIMESTAMP WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function searchAndFilter($keyword = null, $status = null)
    {
        $sql = "SELECT * FROM {$this->table} WHERE 1=1";
        $params = [];
        if ($keyword) {
            $sql .= " AND task LIKE ?";
            $params[] = "%{$keyword}%";
        }
        if ($status !== null && ($status === 'pending' || $status === 'completed')) {
            $val = $status === 'completed' ? 1 : 0;
            $sql .= " AND is_completed = ?";
            $params[] = $val;
        }
        $sql .= " ORDER BY id DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
}
