<?php
session_start();

require_once 'config/config.php';
require_once "controller/MainController.php";
require_once "controller/StreamerController.php";
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

<body>
    <div class="container-md mt-5">
        <form action="" method="post">
            <button class="btn btn-danger" name="action" value="logout">Log out</button>
        </form>
<?php

$db = Database::conectar();

$controlMain=new MainController($db);
$controlMain->processRequest();

$streamerController = new StreamerController($db);

try {
    $streamerController->listarStreamers();
} 
catch (Exception $e) {
    die('No hay streamers');
}

?>

    </div>
</body> 