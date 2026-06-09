<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Sinh Viên</title>
</head>
<body>
    <?php
        if (!isset($sinhvien) || !is_array($sinhvien)) {
            $sinhvien = [];
        }
        if (!isset($totalPage) || !is_numeric($totalPage) || $totalPage < 1) {
            $totalPage = 0;
        }
    ?>
    <h1>Danh sách sinh viên</h1>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .btn {
            display: inline-block;
            padding: 8px 16px;
            margin: 4px;
            text-decoration: none;
            color: white;
            background-color: #007bff;
            border-radius: 4px;
        }
    </style>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>MSSV</th>
                <th>Họ tên</th>
                <th>Giới tính</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($sinhvien as $index => $sv): ?>
                <tr>
                    <td><?php echo $index +1; ?></td>
                    <td><?php echo $sv['MSSV']; ?></td>
                    <td><?php echo $sv['HoTen']; ?></td>
                    <td><?php echo $sv['GioiTinh']; ?></td>
                    <td> 
                        <a href = "/sinhvien/edit/<?php echo $sv['id']; ?>">Sửa</a>
                        <a href = "/sinhvien/delete/<?php echo $sv['id']; ?>">Xoá</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div>
        <?php
            $pageSize = 5;
            for($i =1; $i <= $totalPage; $i++){
            $offset = ($i - 1) * $pageSize;
            echo "<a class='btn btn-primary' href = '/sinhvien/index/$pageSize/$offset'> $i </a>";
            }
        ?>
    </div>
</body>
</html>