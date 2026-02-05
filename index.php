<?php
session_start();

require_once 'config/config.php';
require_once "controller/MainController.php";
require_once "controller/StreamerController.php";
require_once 'controller/ViewController.php';

$db = Database::conectar();

$action = $_REQUEST['action'] ?? 'dashboard';

if (!isset($_SESSION['username']) && !isset($_COOKIE['username']) && $action !== 'processLogin') {
    $action = 'login';
}

$controller = new MainController($db);
$streamerController = new StreamerController($db);
$view = new ViewController();

$view->display('view/header.php');

if($action != 'login') {
    $view->display('view/menu.php');
}

switch ($action) {
    case 'login':
        $controller->loginView();
        break;

    case 'processLogin':
        $controller->processLogin();
        break;

    case 'logout':
        $controller->logout();
        break;

    case 'listar':
        $streamerController->listarStreamers();
        break;
    case "destacar":
        $streamerController->destacar();
        break;
    default:
        header("Location: index.php?action=login");
        break;
}

$view->display('view/footer.php');

