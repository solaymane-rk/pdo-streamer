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
        $_SESSION['error'] = '';

        $request=NULL;

        if(empty($_COOKIE['username'])) {
            $request='login';
        }

        if(isset($_POST['action'])) {
            $request = $_POST['action'];
        }

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
        $username = $_POST['username'] ?? '';
        $isValid = preg_match('/[a-z0-9-]{3,}/', $username);

        if(!$isValid) {
            $_SESSION['error'] = 'El username no es valido!';
            header("Location: index.php?action=login");
            return;
        }

        $ultima_visita = time();
        $total_visitas = $this->model->totalVisitas($username);
        $total_visitas = $total_visitas + 1;

        $id = $this->model->obtenerPorUsername($username);
        $id_validacion = $id['id'] ?? null;
        
        $isSaved = $this->model->guardar($username, $ultima_visita, $total_visitas, $id_validacion);

        if($isSaved) {
            $_SESSION['username'] = $username;
            $_SESSION['total_visitas'] = $total_visitas;

            if(isset($_POST['remember'])) {
                setcookie('username', $username);
            }
            
            header("Location: index.php?action=listar");
        } else {
            $_SESSION['error'] = 'El usuario ya existe!';
            header("Location: index.php?action=login");
        }
    }

    public function logout() {
        session_destroy();
        setcookie('username', '', time());
        header("Location: index.php?action=login");
    }

    public function listarStreamers() {
        $streamers = $this->model->listar();
        
        //die(print_r($streamers, true));

        $this->view->display('view/listar.php', $streamers);
    }
}