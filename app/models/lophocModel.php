<?php
    require_once '../app/core/DB.php';
    class lophocModel {
        private $conn;
        public function __construct() {
            $this -> conn = ConnectDB::Connect();
        }

        public function getAllLophoc() {
            $query = "SELECT * FROM lophoc";
            $stmt = $this -> conn -> prepare($query);
            $stmt -> execute();
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);
        }

        public function create($MaLop, $TenLop) {
            $query = "INSERT INTO lophoc (MaLop, TenLop) VALUES (:MaLop, :TenLop)";
            $stmt = $this -> conn -> prepare($query);
            $stmt -> bindParam(':MaLop', $MaLop);
            $stmt -> bindParam(':TenLop', $TenLop);
            try {
                return $stmt -> execute();
            } catch (PDOException $e) {
                return false;
            }
        }

        public function paging ($limit = 5, $offset = 0, $search = ''){
            $limit = (int)$limit;
            $offset = (int)$offset;
            if ($limit <= 0) {
                $limit = 5;
            }
            if ($offset < 0) {
                $offset = 0;
            }

            if (!empty($search)) {
                $query = "SELECT * FROM lophoc WHERE MaLop LIKE :search OR TenLop LIKE :search LIMIT :limit OFFSET :offset";
                $stmt = $this -> conn -> prepare($query);
                $searchParam = "%$search%";
                $stmt -> bindParam(':search', $searchParam);
                $stmt -> bindParam(':limit', $limit, PDO::PARAM_INT);
                $stmt -> bindParam(':offset', $offset, PDO::PARAM_INT);
                $stmt -> execute();
                $result = $stmt -> fetchAll(PDO::FETCH_ASSOC);

                $countQuery = "SELECT COUNT(*) FROM lophoc WHERE MaLop LIKE :search OR TenLop LIKE :search";
                $countStmt = $this -> conn -> prepare($countQuery);
                $countStmt -> bindParam(':search', $searchParam);
                $countStmt -> execute();
                $totalRecord = $countStmt -> fetchColumn();
            } else {
                $query = "SELECT * FROM lophoc LIMIT :limit OFFSET :offset ";
                $stmt = $this -> conn -> prepare($query);
                $stmt -> bindParam(':limit', $limit, PDO::PARAM_INT);
                $stmt -> bindParam(':offset', $offset, PDO::PARAM_INT);
                $stmt -> execute();
                $result = $stmt -> fetchAll(PDO::FETCH_ASSOC);

                $selectAllQuery = $this->conn->query("SELECT COUNT(*) FROM lophoc");
                $totalRecord = $selectAllQuery -> fetchColumn();
            }

            $totalPage = ceil($totalRecord / $limit);
            
            return ['lophoc' => $result, 'totalPage' => (int) $totalPage];
        }

        public function getLophocById($id) {
            $query = "SELECT * FROM lophoc WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function update($id, $MaLop, $TenLop) {
            $query = "UPDATE lophoc SET MaLop = :MaLop, TenLop = :TenLop WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':MaLop', $MaLop);
            $stmt->bindParam(':TenLop', $TenLop);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            try {
                return $stmt->execute();
            } catch (PDOException $e) {
                return false;
            }
        }

        public function delete($id) {
            $query = "DELETE FROM lophoc WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        }
    }
?>
