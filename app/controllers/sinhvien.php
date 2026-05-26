
<?php
require_once '../app/core/Controller.php';
class sinhvien extends Controller {
    function index() {
        $sinhvienModel = $this->model('sinhvienModel');
        $sinhvien = $sinhvienModel -> getAllSinhvien();
        //trả về view 
        //require_once '../app/views/sinhvien/index.php';
        $this -> view('sinhvien/index', ['sinhvien' => $sinhvien]);
    }

    function create() {
        //trả về view 
        require_once '../app/views/sinhvien/create.php';
    }
}