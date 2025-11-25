<?php

namespace App\Core;

class BaseController
{
    protected $twig;
    protected $pdo;

    public function __construct($twig, $pdo)
    {
        $this->twig = $twig;
        $this->pdo = $pdo;
    }

    protected function view($view, $data = [])
    {
        return $this->twig->render($view, $data);
    }

    protected function redirect($path)
    {
        header("Location: $path");
        exit;
    }
}
