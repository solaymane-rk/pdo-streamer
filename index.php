<?php
session_start();

require_once 'config/config.php';
require_once "controller/MainController.php";
require_once 'controller/ViewController.php';

$db = Database::conectar();

$controller = new MainController($db);
$view = new ViewController();

$view->display('view/header.php');

$isLoged = $_SESSION['username'] ?? null;

if($isLoged) {
    $view->display('view/menu.php');
}

$controller->processRequest();

$view->display('view/footer.php');

