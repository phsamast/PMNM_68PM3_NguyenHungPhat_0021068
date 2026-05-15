<?php

class home
{
    public function index()
    {
        echo "<h1>TRANG CHỦ MVC PHP</h1>";
        echo "<p>Project MVC đang chạy thành công.</p>";
    }

    public function hello($name = "User")
    {
        echo "Xin chào " . $name;
    }
}

?>