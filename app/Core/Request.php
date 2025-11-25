<?php
namespace App\Core;

class Request {
    public $get;
    public $post;
    public $twig;
    public $pdo;

    public function __construct($get, $post, $twig, $pdo) {
        $this->get = $get;
        $this->post = $post;
        $this->twig = $twig;
        $this->pdo = $pdo;
    }

    public function input($key, $default = null)
    {
        return $this->post[$key] ?? $this->get[$key] ?? $default;
    }

        public function isPost() {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }
}
