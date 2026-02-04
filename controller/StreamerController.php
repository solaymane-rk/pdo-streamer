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
        $request=NULL;

        if(empty($_COOKIE['username'])) {
            $request='login';
        }

        if(isset($_POST['action'])) {
            $request = $_POST['action'];
        }
        
        //die(var_dump($request));

        switch ($request){
            default:
                $this->listarStreamers();
                
        }

    }

    public function listarStreamers() {
    if (isset($_POST['destacar_id'])) {
        $this->model->cambiarDestacado($_POST['destacar_id']);
    }
    
    $content = $this->model->listar();
    $this->view->display('view/listar.php', $content);
}
}