<?php
/** @var array $sinhvien */
/** @var int $totalPage */
/** @var string $search */
/** @var string $sortBy */
/** @var string $sortOrder */
/** @var int $limit */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Sinh Viên</title>
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
        .search-container {
            margin-bottom: 20px;
            display: flex;
            gap: 10px;
        }
        .search-input {
            flex-grow: 1;
            padding: 8px 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Danh sách sinh viên</h1>
        
        <a href="<?php echo url('/sinhvien/create'); ?>" class="btn btn-success">+ Thêm sinh viên mới</a>
        <a href="<?php echo url('/auth/logout'); ?>" class="btn btn-danger" style="margin-bottom: 15px; margin-left: 10px;">Đăng xuất</a>

        <?php
            $sortBy = $sortBy ?? '';
            $sortOrder = $sortOrder ?? '';
            
            // Prepare parameters for headers
            $nextOrderMSSV = ($sortBy === 'MSSV' && $sortOrder === 'asc') ? 'desc' : 'asc';
            $nextOrderHoTen = ($sortBy === 'HoTen' && $sortOrder === 'asc') ? 'desc' : 'asc';

            $limit = $limit ?? 5;
            $offset = $offset ?? 0;
            
            $mssvParams = ['sortBy' => 'MSSV', 'sortOrder' => $nextOrderMSSV];
            $hotenParams = ['sortBy' => 'HoTen', 'sortOrder' => $nextOrderHoTen];
            
            if (!empty($search)) {
                $mssvParams['search'] = $search;
                $hotenParams['search'] = $search;
            }
            
            $mssvUrl = url("/sinhvien/index/$limit/$offset") . '?' . http_build_query($mssvParams);
            $hotenUrl = url("/sinhvien/index/$limit/$offset") . '?' . http_build_query($hotenParams);
            
            $mssvIndicator = '';
            if ($sortBy === 'MSSV') {
                $mssvIndicator = $sortOrder === 'asc' ? ' ▲' : ' ▼';
            }
            
            $hotenIndicator = '';
            if ($sortBy === 'HoTen') {
                $hotenIndicator = $sortOrder === 'asc' ? ' ▲' : ' ▼';
            }
        ?>
        <form method="GET" action="<?php echo url('/sinhvien/index'); ?>" class="search-container">
            <input type="text" name="search" class="search-input" placeholder="Tìm kiếm theo MSSV, Họ tên hoặc Lớp học..." value="<?php echo htmlspecialchars($search ?? ''); ?>">
            <?php if (!empty($sortBy)): ?>
                <input type="hidden" name="sortBy" value="<?php echo htmlspecialchars($sortBy); ?>">
                <input type="hidden" name="sortOrder" value="<?php echo htmlspecialchars($sortOrder); ?>">
            <?php endif; ?>
            <button type="submit" class="btn">Tìm kiếm</button>
            <?php if (!empty($search)): ?>
                <a href="<?php echo url('/sinhvien/index'); ?>" class="btn btn-danger">Hủy tìm</a>
            <?php endif; ?>
        </form>

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
                    <th><a href="<?php echo $mssvUrl; ?>" style="text-decoration: none; color: inherit;">MSSV<?php echo $mssvIndicator; ?></a></th>
                    <th><a href="<?php echo $hotenUrl; ?>" style="text-decoration: none; color: inherit;">Họ tên<?php echo $hotenIndicator; ?></a></th>
                    <th>Giới tính</th>
                    <th>Lớp</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($sinhvien as $index => $sv): ?>
                    <tr>
                        <td><?php echo $index +1; ?></td>
                        <td><?php echo htmlspecialchars($sv['MSSV']); ?></td>
                        <td><?php echo htmlspecialchars($sv['HoTen']); ?></td>
                        <td><?php echo htmlspecialchars($sv['GioiTinh']); ?></td>
                        <td><?php echo htmlspecialchars($sv['MaLop'] ?? 'Chưa xếp lớp'); ?></td>
                        <td> 
                            <div class="action-btns">
                                <a href="<?php echo url('/sinhvien/edit/' . $sv['id']); ?>" class="btn btn-warning">Sửa</a>
                                <a href="<?php echo url('/sinhvien/delete/' . $sv['id']); ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa sinh viên này?');">Xoá</a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="pagination">
            <?php
                $pageSize = $limit;
                for($i = 1; $i <= $totalPage; $i++){
                    $offset = ($i - 1) * $pageSize;
                    $pageUrl = url("/sinhvien/index/$pageSize/$offset");
                    $queryParams = [];
                    if (!empty($search)) {
                        $queryParams['search'] = $search;
                    }
                    if (!empty($sortBy)) {
                        $queryParams['sortBy'] = $sortBy;
                        $queryParams['sortOrder'] = $sortOrder;
                    }
                    if (!empty($queryParams)) {
                        $pageUrl .= "?" . http_build_query($queryParams);
                    }
                    echo "<a class='btn' href='$pageUrl'>Trang $i</a>";
                }
            ?>
        </div>
    </div>
    <script>
    function changePageSize(size) {
        const search = '<?php echo addslashes($search ?? ""); ?>';
        const sortBy = '<?php echo addslashes($sortBy ?? ""); ?>';
        const sortOrder = '<?php echo addslashes($sortOrder ?? ""); ?>';
        
        let url = '<?php echo url("/sinhvien/index"); ?>/' + size + '/0';
        let params = [];
        if (search) params.push('search=' + encodeURIComponent(search));
        if (sortBy) {
            params.push('sortBy=' + encodeURIComponent(sortBy));
            params.push('sortOrder=' + encodeURIComponent(sortOrder));
        }
        if (params.length > 0) {
            url += '?' + params.join('&');
        }
        window.location.href = url;
    }
    </script>
</body>
</html>