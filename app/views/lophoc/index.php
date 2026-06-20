<?php
/** @var array $lophoc */
/** @var int $totalPage */
/** @var int $limit */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Lớp Học</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
            background: #fff;
            padding: 20px 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #2c3e50;
            margin-bottom: 20px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #e0e0e0;
            padding: 12px 15px;
            text-align: left;
        }
        th {
            background-color: #f8f9fa;
            font-weight: 600;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .btn {
            display: inline-block;
            padding: 8px 16px;
            text-decoration: none;
            color: white;
            background-color: #007bff;
            border-radius: 4px;
            transition: background 0.3s;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }
        .btn:hover { background-color: #0056b3; }
        .btn-success { background-color: #28a745; margin-bottom: 15px; }
        .btn-success:hover { background-color: #218838; }
        .btn-warning { background-color: #ffc107; color: #212529; }
        .btn-warning:hover { background-color: #e0a800; }
        .btn-danger { background-color: #dc3545; }
        .btn-danger:hover { background-color: #c82333; }
        .action-btns {
            display: flex;
            gap: 8px;
        }
        .pagination {
            display: flex;
            gap: 5px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Danh sách lớp học</h1>
        
        <a href="<?php echo url('/lophoc/create'); ?>" class="btn btn-success">+ Thêm lớp học mới</a>
        <a href="<?php echo url('/auth/logout'); ?>" class="btn btn-danger" style="margin-bottom: 15px; margin-left: 10px;">Đăng xuất</a>

        <?php $limit = $limit ?? 5; ?>
        <div style="margin-bottom: 20px; display: flex; align-items: center; justify-content: space-between; gap: 10px;">
            <div style="display: flex; align-items: center; gap: 8px;">
                <label for="pageSize" style="font-weight: 600; font-size: 14px;">Số dòng hiển thị:</label>
                <select id="pageSize" onchange="changePageSize(this.value)" style="padding: 6px 10px; border-radius: 4px; border: 1px solid #ccc; font-size: 14px;">
                    <option value="5" <?php echo $limit == 5 ? 'selected' : ''; ?>>5</option>
                    <option value="10" <?php echo $limit == 10 ? 'selected' : ''; ?>>10</option>
                    <option value="20" <?php echo $limit == 20 ? 'selected' : ''; ?>>20</option>
                    <option value="50" <?php echo $limit == 50 ? 'selected' : ''; ?>>50</option>
                </select>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã Lớp</th>
                    <th>Tên Lớp</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($lophoc)): ?>
                    <tr>
                        <td colspan="4" style="text-align: center;">Không có lớp học nào</td>
                    </tr>
                <?php else: ?>
                    <?php foreach($lophoc as $index => $lh): ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td><?php echo htmlspecialchars($lh['MaLop']); ?></td>
                            <td><?php echo htmlspecialchars($lh['TenLop']); ?></td>
                            <td> 
                                <div class="action-btns">
                                    <a href="<?php echo url('/lophoc/edit/' . $lh['id']); ?>" class="btn btn-warning">Sửa</a>
                                    <a href="<?php echo url('/lophoc/delete/' . $lh['id']); ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa lớp học này?');">Xoá</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="pagination">
            <?php
                $pageSize = $limit;
                for($i = 1; $i <= $totalPage; $i++){
                    $offset = ($i - 1) * $pageSize;
                    echo "<a class='btn' href='" . url("/lophoc/index/$pageSize/$offset") . "'>Trang $i</a>";
                }
            ?>
        </div>
    </div>
    <script>
    function changePageSize(size) {
        window.location.href = '<?php echo url("/lophoc/index"); ?>/' + size + '/0';
    }
    </script>
</body>
</html>
