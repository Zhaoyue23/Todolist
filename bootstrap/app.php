<?php
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/database.php';

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

$loader = new FilesystemLoader(__DIR__ . '/../App/views');
$twig = new Environment($loader, [
    'cache' => false,
]);

// expose $twig and $pdo to public/index bootstrap container
