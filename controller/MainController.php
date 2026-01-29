<?php
require_once 'ViewController.php';
require_once './model/Usuario.php';


class MainController {

    private $view;
    private $model;

    public function __construct(PDO $db) {
        $this->view = new ViewController();
        $this->model = new Usuario($db);
    }

    public function processRequest() {
        $_SESSION['error'] = [];
        $_SESSION['info'] = [];

        $request=NULL;

        if(empty($_COOKIE['username'])) {
            $request='login';
        }

        if(isset($_POST['action'])) {
            $request = $_POST['action'];
        }
        
        //die(var_dump($request));

        switch ($request){
            case "login":
                $this->loginView();
                break;
            case "processLogin":
                $this->processLogin();
                break;
            case "logout":
                $this->logout();
            default:
                $this->loginView();
        }
    }

    public function loginView() {
        $this->view->display('view/form/login.php');
    }

    public function processLogin() {
        $username = $_POST['username'] ?? 'sin';
        $isValid = preg_match('/[a-z0-9-]{3,}/', $username);

        if(!$isValid) {
            $_SESSION['error'][] = 'El username no es valido!';
        }

        $ultima_visita = time();

        $total_visitas = $this->model->totalVisitas('user') ?? 0;

        $total_visitas = $total_visitas + 1;

        $isSaved = $this->model->guardar($username, $ultima_visita, $total_visitas);

        if($isSaved) {
            $_SESSION['username'] = $username;
        } else {
            $_SESSION['error'][] = 'El usuario ya existe!';
        }

        if(isset($_POST['remember'])) {
            setcookie('username', $username);
        }
    }

    public function logout() {
        session_destroy();
        setcookie('username', '', time());
    }
}