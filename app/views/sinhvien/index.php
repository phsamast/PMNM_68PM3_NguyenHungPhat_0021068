<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Sinh Viên</title>
</head>
<body>
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
    </style>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>MSSV</th>
                <th>Họ tên</th>
                <th>Giới tính</th>
            </tr>
        </thead>
        <tbody>
            <?php if(isset($sinhvien) && is_array($sinhvien)): ?>
                <?php foreach($sinhvien as $sv): ?>
                    <tr>
                        <td><?php echo $sv['id']; ?></td>
                        <td><?php echo $sv['MSSV']; ?></td>
                        <td><?php echo $sv['HoTen']; ?></td>
                        <td><?php echo $sv['GioiTinh']; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">Không có dữ liệu sinh viên</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>