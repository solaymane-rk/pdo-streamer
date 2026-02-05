<?php
require_once "UserController.php";
require_once "StreamerController.php";

class MainController {

    private $db;
    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function processRequest() {
        $request = null;

        if(isset($_REQUEST['section'])) {
            $request = $_REQUEST['section'];
        }

        switch ($request){
            case "user":
                $userController = new UserController($this->db);
                $userController->processRequest();
                break;
            case "streamer":
                $streamerController = new StreamerController($this->db);
                $streamerController->processRequest();
                break;
            default:
                header("Location: index.php?section=user&action=login");
        }
    }
}