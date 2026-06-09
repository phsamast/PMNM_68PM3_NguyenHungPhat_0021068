<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sinh viên</title>
</head>
<body>
   <h1>Thêm sinh viên</h1>
   <form action="/sinhvien/store" method="POST">
        <label for="HoTen">Họ tên:</label>
        <input type="text" id="HoTen" name="HoTen" required><br><br>
        <label for="MSSV">MSSV:</label>
        <input type="text" id="MSSV" name="MSSV" required><br><br>
        <label for="GioiTinh">Giới tính:</label>
        <select id="GioiTinh" name="GioiTinh" required>
            <option value="">Chọn giới tính</option>
            <option value="Nam">Nam</option>
            <option value="Nữ">Nữ</option>
            <option value="Khác">Khác</option>
        </select><br><br>

        <input type="submit" value="Thêm sinh viên">
    </form>
</body>
</html>