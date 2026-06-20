<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm lớp học</title>
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
        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"], .btn-back {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
            margin-top: 10px;
        }
        input[type="submit"]:hover {
            background-color: #218838;
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
        <h1>Thêm lớp học</h1>
        <form action="<?php echo url('/lophoc/store'); ?>" method="POST">
            <div class="form-group">
                <label for="MaLop">Mã lớp học:</label>
                <input type="text" id="MaLop" name="MaLop" required>
            </div>
            
            <div class="form-group">
                <label for="TenLop">Tên lớp học:</label>
                <input type="text" id="TenLop" name="TenLop" required>
            </div>

            <input type="submit" value="Thêm lớp học">
            <a href="<?php echo url('/lophoc/index'); ?>" class="btn-back">Quay lại danh sách</a>
        </form>
    </div>
</body>
</html>
