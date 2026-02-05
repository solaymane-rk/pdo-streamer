<?php
require_once 'ViewController.php';
require_once './model/Streamer.php';


class StreamerController {

    private $view;
    private $model;

    public function __construct(PDO $db) {
        $this->view = new ViewController();
        $this->model = new Streamer($db);
    }

    public function processRequest() {
        $request = $_REQUEST['action'] ?? 'login';

        switch ($request){
            case "listar":
                $this->listarStreamers();
                break;
            case "destacar":
                $this->destacar();
            default:
                $this->listarStreamers();
                
        }
    }

    public function listarStreamers() {
        $content = $this->model->listar();
        $this->view->display('view/listar.php', $content);
    }

    public function destacar() {
        if (isset($_REQUEST['destacar_id'])) {
            $this->model->cambiarDestacado(nuevoId: $_REQUEST['destacar_id']);
        }
        header("Location: index.php?section=streamer&action=listar");    
    }
}