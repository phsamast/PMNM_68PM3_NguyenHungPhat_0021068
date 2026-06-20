<?php
require_once '../app/core/Controller.php';
class lophoc extends Controller {
    public function index($limit = 5, $offset = 0, $search = '') {
        $lophocModel = $this->model('lophocModel');
        $result = $lophocModel->paging($limit, $offset, $search);
        $lophoc = $result['lophoc'];
        $totalPage = $result['totalPage'];
        $this->view('lophoc/index', ['lophoc' => $lophoc, 'totalPage' => $totalPage, 'limit' => $limit], 'Danh sách lớp học');
    }

    public function create() {
        $this->view('lophoc/create', [], 'Thêm lớp học');
    }

    public function store() {
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $MaLop = $_POST['MaLop'] ?? '';
            $TenLop = $_POST['TenLop'] ?? '';

            $lophocModel = $this->model('lophocModel');
            $result = $lophocModel->create($MaLop, $TenLop);
            if ($result) {
                header('Location: ' . url('/lophoc/index'));
                exit();
            } else {
                echo "<script>alert('Lỗi: Thêm lớp học thất bại! Có thể Mã lớp đã tồn tại.'); window.history.back();</script>";
            }
        }
    }

    public function edit($id) {
        $lophocModel = $this->model('lophocModel');
        $lophoc = $lophocModel->getLophocById($id);
        if ($lophoc) {
            $this->view('lophoc/edit', ['lophoc' => $lophoc], 'Sửa lớp học');
        } else {
            echo "Không tìm thấy lớp học!";
        }
    }

    public function update($id) {
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $MaLop = $_POST['MaLop'] ?? '';
            $TenLop = $_POST['TenLop'] ?? '';

            $lophocModel = $this->model('lophocModel');
            $result = $lophocModel->update($id, $MaLop, $TenLop);
            if ($result) {
                header('Location: ' . url('/lophoc/index'));
                exit();
            } else {
                echo "<script>alert('Lỗi: Cập nhật thất bại! Có thể Mã lớp đã tồn tại.'); window.history.back();</script>";
            }
        }
    }

    public function delete($id) {
        $lophocModel = $this->model('lophocModel');
        $result = $lophocModel->delete($id);
        if ($result) {
            header('Location: ' . url('/lophoc/index'));
            exit();
        } else {
            echo "Lỗi khi xóa lớp học!";
        }
    }
}
?>
