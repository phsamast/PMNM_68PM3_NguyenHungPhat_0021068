<?php
    require_once '../app/core/DB.php';
    class sinhvienModel {
        private $conn;
        public function __construct() {
            $this -> conn = ConnectDB::Connect();
        }

        public function getAllSinhvien() {
            $query = "SELECT * FROM sinhvien";
            $stmt = $this -> conn -> prepare($query);
            $stmt -> execute();
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);
        }
        public function create($HoTen, $GioiTinh, $MSSV, $MaLop = null) {
            $query = "INSERT INTO sinhvien (HoTen, GioiTinh, MSSV, MaLop) VALUES (:HoTen, :GioiTinh, :MSSV, :MaLop)";
            $stmt = $this -> conn -> prepare($query);
            $stmt -> bindParam(':HoTen', $HoTen);
            $stmt -> bindParam(':GioiTinh', $GioiTinh);
            $stmt -> bindParam(':MSSV', $MSSV);
            $stmt -> bindParam(':MaLop', $MaLop);
            try {
                return $stmt -> execute();
            } catch (PDOException $e) {
                return false;
            }
        }
        public function paging ($limit = 5, $offset = 0, $search = '', $sortBy = '', $sortOrder = ''){
            $limit = (int)$limit;
            $offset = (int)$offset;
            if ($limit <= 0) {
                $limit = 5;
            }
            if ($offset < 0) {
                $offset = 0;
            }

            $allowedSortBy = ['MSSV', 'HoTen', 'id'];
            $allowedSortOrder = ['asc', 'desc'];
            
            $sortQuery = '';
            if (in_array($sortBy, $allowedSortBy)) {
                $order = in_array(strtolower($sortOrder), $allowedSortOrder) ? $sortOrder : 'asc';
                $sortQuery = " ORDER BY sinhvien.$sortBy $order";
            } else {
                $sortQuery = " ORDER BY sinhvien.id ASC";
            }

            if (!empty($search)) {
                $query = "SELECT sinhvien.* FROM sinhvien 
                          LEFT JOIN lophoc ON sinhvien.MaLop = lophoc.MaLop 
                          WHERE sinhvien.MSSV LIKE :search 
                             OR sinhvien.HoTen LIKE :search 
                             OR sinhvien.MaLop LIKE :search 
                             OR lophoc.TenLop LIKE :search 
                          $sortQuery 
                          LIMIT :limit OFFSET :offset";
                $stmt = $this -> conn -> prepare($query);
                $searchParam = "%$search%";
                $stmt -> bindParam(':search', $searchParam);
                $stmt -> bindParam(':limit', $limit, PDO::PARAM_INT);
                $stmt -> bindParam(':offset', $offset, PDO::PARAM_INT);
                $stmt -> execute();
                $result = $stmt -> fetchAll(PDO::FETCH_ASSOC);

                $countQuery = "SELECT COUNT(*) FROM sinhvien 
                               LEFT JOIN lophoc ON sinhvien.MaLop = lophoc.MaLop 
                               WHERE sinhvien.MSSV LIKE :search 
                                  OR sinhvien.HoTen LIKE :search 
                                  OR sinhvien.MaLop LIKE :search 
                                  OR lophoc.TenLop LIKE :search";
                $countStmt = $this -> conn -> prepare($countQuery);
                $countStmt -> bindParam(':search', $searchParam);
                $countStmt -> execute();
                $totalRecord = $countStmt -> fetchColumn();
            } else {
                $query = "SELECT * FROM sinhvien $sortQuery LIMIT :limit OFFSET :offset ";
                $stmt = $this -> conn -> prepare($query);
                $stmt -> bindParam(':limit', $limit, PDO::PARAM_INT);
                $stmt -> bindParam(':offset', $offset, PDO::PARAM_INT);
                $stmt -> execute();
                $result = $stmt -> fetchAll(PDO::FETCH_ASSOC);
                
                //Tính tổng số bản ghi
                $selectAllQuery = $this->conn->query("SELECT COUNT(*) FROM sinhvien");
                $totalRecord = $selectAllQuery -> fetchColumn();
            }

            $totalPage = ceil($totalRecord / $limit);
            
            return ['sinhvien' => $result, 'totalPage' => (int) $totalPage];
        }

        public function getSinhvienById($id) {
            $query = "SELECT * FROM sinhvien WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function update($id, $HoTen, $GioiTinh, $MSSV, $MaLop = null) {
            $query = "UPDATE sinhvien SET HoTen = :HoTen, GioiTinh = :GioiTinh, MSSV = :MSSV, MaLop = :MaLop WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':HoTen', $HoTen);
            $stmt->bindParam(':GioiTinh', $GioiTinh);
            $stmt->bindParam(':MSSV', $MSSV);
            $stmt->bindParam(':MaLop', $MaLop);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            try {
                return $stmt->execute();
            } catch (PDOException $e) {
                return false;
            }
        }

        public function delete($id) {
            $query = "DELETE FROM sinhvien WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        }
    }
    
?>