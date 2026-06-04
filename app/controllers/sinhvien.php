<?php
require_once '../app/core/Controller.php';
class sinhvien extends Controller {
    public function index() {
        $sinhvienModel = $this->model('sinhvienModel');
        $sinhvien = $sinhvienModel->getAllSinhvien();
        $this->view('sinhvien/index', ['sinhvien' => $sinhvien]);
    }

    public function create() {
        require_once '../app/views/sinhvien/create.php';
    }
    public function store() {
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $HoTen = $_POST['HoTen'] ?? '';
            $GioiTinh = $_POST['GioiTinh'] ?? '';
            $MSSV = $_POST['MSSV'] ?? '';

            $sinhvienModel = $this->model('sinhvienModel');
            $result = $sinhvienModel->create($HoTen, $GioiTinh, $MSSV);
            if ($result) {
                header('Location: /sinhvien/index');
                exit();
            } else {
                echo "Lỗi khi thêm sinh viên!";
            }
        }
    }
}