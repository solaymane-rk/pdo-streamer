<?php
//cridem a tots els controladors que necessitem cridar des del processRequest()
require_once './view/controller/ViewController.php';



class MainController {

    private $view;
    private $model;

    public function __construct() {
        $this->view = new ViewController();
    }

    public function processRequest() {
        $request=NULL;

        if(empty($_SESSION['username'])) {
            $request='login';
            // validar username Sanitiza siempre la entrada (htmlspecialchars() o filter_var()).
            // comprobar si existe
            // si no existe, hacer insert
            // finally guardar username en SESSION
        }

        if(isset($_GET["menu"])){
            $request=$_GET["menu"];
        }

        switch ($request){
            case "login":
                $this->login();
                break;
            default:
                include("view/menu/MainMenu.html");
                
        }

    }

    public function login() {
        $this->view->display('view/login.php');
    }
    
}
