<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use Alura\Mvc\Controller\{
  Controller,
  DeleteVideoController,
  EditVideoController,
  Error404Controller,
  NewVideoController,
  VideoFormController,
  VideoListController
};;

use Alura\Mvc\Repository\VideoRepository;

$dbPath = __DIR__ . '/../banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");
$videoRepository = new VideoRepository($pdo);

$routes = require_once __DIR__ . '/../config/routes.php';

$pathInfo = $_SERVER['PATH_INFO'] ?? '/';
$httpMethod = $_SERVER['REQUEST_METHOD'];

$key = "$httpMethod|$pathInfo";

if (array_key_exists($key , $routes)) {
  $controllerClass = $routes[$key];
  $controller = new $controllerClass($videoRepository);
} else {
  $controller = new Error404Controller();
}

/** @var Controller $controller */
$controller->processaRequisicao();

// if (!array_key_exists('PATH_INFO', $_SERVER) || $_SERVER['PATH_INFO'] === '/') {
//   $controller = new VideoListController($videoRepository);
// } elseif ($_SERVER['PATH_INFO'] === '/novo-video') {
//   if ($_SERVER['REQUEST_METHOD'] === 'GET') {
//     $controller = new VideoFormController($videoRepository);
//   } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $controller = new NewVideoController($videoRepository);
//   }
// } elseif ($_SERVER['PATH_INFO'] === '/editar-video') {
//   if ($_SERVER['REQUEST_METHOD'] === 'GET') {
//     $controller = new VideoFormController($videoRepository);
//   } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $controller = new EditVideoController($videoRepository);
//   }
// } elseif ($_SERVER['PATH_INFO'] === '/remover-video') {
//   $controller = new DeleteVideoController($videoRepository);
// } else {
//   $controller = new Error404Controller();
// }
// /** @var Controller $controller */
// $controller->processaRequisicao();


// if (!array_key_exists('PATH_INFO', $_SERVER) || $_SERVER['PATH_INFO'] === '/') {
//   require_once __DIR__ . '/../listagem-videos.php';
// } elseif ($_SERVER['PATH_INFO'] === '/novo-video') {
//   if ($_SERVER['REQUEST_METHOD'] === 'GET') {
//     require_once __DIR__ . '/../formulario.php';
//   } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     require_once __DIR__ . '/../novo-video.php';
//   }
// } elseif ($_SERVER['PATH_INFO'] === '/editar-video') {
//   if ($_SERVER['REQUEST_METHOD'] === 'GET') {
//     require_once __DIR__ . '/../formulario.php';
//   } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     require_once __DIR__ . '/../editar-video.php';
//   }
// } elseif ($_SERVER['PATH_INFO'] === '/remover-video') {
//   require_once __DIR__ . '/../remover-video.php';
// } else {
//   http_response_code(404);
// }
