
<?php
require_once '../app/core/Controller.php';
class sinhvien extends Controller {
    public function index($limit = 5, $offset = 0, $search = '') {
        if (isset($_GET['search'])) {
            $search = trim($_GET['search']);
        }
        $sortBy = isset($_GET['sortBy']) ? trim($_GET['sortBy']) : '';
        $sortOrder = isset($_GET['sortOrder']) ? trim($_GET['sortOrder']) : '';

        $sinhvienModel = $this->model('sinhvienModel');
        $result = $sinhvienModel -> paging($limit, $offset, $search, $sortBy, $sortOrder);
        $sinhvien = $result['sinhvien'];
        $totalPage = $result['totalPage'];
        //trả về view 
        //require_once '../app/views/sinhvien/index.php';
        $this -> view('sinhvien/index', [
            'sinhvien' => $sinhvien, 
            'totalPage' => $totalPage, 
            'search' => $search,
            'sortBy' => $sortBy,
            'sortOrder' => $sortOrder,
            'limit' => $limit
        ], 'Danh sách sinh viên');
    }

    public function create() {
        $lophocModel = $this->model('lophocModel');
        $classes = $lophocModel->getAllLophoc();
        $this->view('sinhvien/create', ['classes' => $classes], 'Thêm sinh viên');
    }
    public function store() {
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $HoTen = $_POST['HoTen'] ?? '';
            $GioiTinh = $_POST['GioiTinh'] ?? '';
            $MSSV = $_POST['MSSV'] ?? '';
            $MaLop = $_POST['MaLop'] ?? null;
            if ($MaLop === '') {
                $MaLop = null;
            }

            $sinhvienModel = $this->model('sinhvienModel');
            $result = $sinhvienModel->create($HoTen, $GioiTinh, $MSSV, $MaLop);
            if ($result) {
                header('Location: ' . url('/sinhvien/index'));
                exit();
            } else {
                echo "<script>alert('Lỗi: Thêm sinh viên thất bại! Có thể MSSV đã tồn tại.'); window.history.back();</script>";
            }
        }
    }

    public function edit($id) {
        $sinhvienModel = $this->model('sinhvienModel');
        $sinhvien = $sinhvienModel->getSinhvienById($id);
        $lophocModel = $this->model('lophocModel');
        $classes = $lophocModel->getAllLophoc();
        if ($sinhvien) {
            $this->view('sinhvien/edit', ['sinhvien' => $sinhvien, 'classes' => $classes], 'Sửa sinh viên');
        } else {
            echo "Không tìm thấy sinh viên!";
        }
    }

    public function update($id) {
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $HoTen = $_POST['HoTen'] ?? '';
            $GioiTinh = $_POST['GioiTinh'] ?? '';
            $MSSV = $_POST['MSSV'] ?? '';
            $MaLop = $_POST['MaLop'] ?? null;
            if ($MaLop === '') {
                $MaLop = null;
            }

            $sinhvienModel = $this->model('sinhvienModel');
            $result = $sinhvienModel->update($id, $HoTen, $GioiTinh, $MSSV, $MaLop);
            if ($result) {
                header('Location: ' . url('/sinhvien/index'));
                exit();
            } else {
                echo "<script>alert('Lỗi: Cập nhật thất bại! Có thể MSSV đã tồn tại.'); window.history.back();</script>";
            }
        }
    }

    public function delete($id) {
        $sinhvienModel = $this->model('sinhvienModel');
        $result = $sinhvienModel->delete($id);
        if ($result) {
            header('Location: ' . url('/sinhvien/index'));
            exit();
        } else {
            echo "Lỗi khi xóa sinh viên!";
        }
    }
}