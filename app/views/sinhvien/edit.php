<?php
/** @var array $sinhvien */
/** @var array $classes */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa sinh viên</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .container {
            max-width: 500px;
            margin: 0 auto;
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #2c3e50;
            margin-top: 0;
            margin-bottom: 20px;
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
        }
        input[type="text"], select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"], .btn-back {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
            margin-top: 10px;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .btn-back {
            display: block;
            background-color: #6c757d;
            text-align: center;
            text-decoration: none;
            box-sizing: border-box;
        }
        .btn-back:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Cập nhật sinh viên</h1>
        <form action="<?php echo url('/sinhvien/update/' . $sinhvien['id']); ?>" method="POST">
            <div class="form-group">
                <label for="MSSV">MSSV:</label>
                <input type="text" id="MSSV" name="MSSV" value="<?php echo htmlspecialchars($sinhvien['MSSV']); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="HoTen">Họ tên:</label>
                <input type="text" id="HoTen" name="HoTen" value="<?php echo htmlspecialchars($sinhvien['HoTen']); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="GioiTinh">Giới tính:</label>
                <select id="GioiTinh" name="GioiTinh" required>
                    <option value="">Chọn giới tính</option>
                    <option value="Nam" <?php echo $sinhvien['GioiTinh'] === 'Nam' ? 'selected' : ''; ?>>Nam</option>
                    <option value="Nữ" <?php echo $sinhvien['GioiTinh'] === 'Nữ' ? 'selected' : ''; ?>>Nữ</option>
                    <option value="Khác" <?php echo $sinhvien['GioiTinh'] === 'Khác' ? 'selected' : ''; ?>>Khác</option>
                </select>
            </div>

            <div class="form-group">
                <label for="MaLop">Lớp học:</label>
                <select id="MaLop" name="MaLop">
                    <option value="">Chọn lớp học (nếu có)</option>
                    <?php foreach ($classes as $class): ?>
                        <option value="<?php echo htmlspecialchars($class['MaLop']); ?>" <?php echo $sinhvien['MaLop'] === $class['MaLop'] ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($class['MaLop'] . ' - ' . $class['TenLop']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <input type="submit" value="Cập nhật">
            <a href="<?php echo url('/sinhvien/index'); ?>" class="btn-back">Quay lại danh sách</a>
        </form>
    </div>
</body>
</html>
