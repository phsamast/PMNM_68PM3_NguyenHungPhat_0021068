<?php
require_once '../app/core/Controller.php';
class home extends Controller {
    public function index(){
        if (isset($_SESSION['username'])) {
            header('Location: ' . url('/sinhvien/index'));
            exit();
        }
        $this->view('home/index', [], 'Trang chủ');
    }
    public function login(){
        require_once '../app/views/home/login.php';
    }
}

?>