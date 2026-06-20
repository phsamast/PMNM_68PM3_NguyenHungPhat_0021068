<?php
$isLoggedIn = isset($_SESSION['username']);
?>
<style>
    .header-navbar {
        width: 100%;
        height: 60px;
        background-color: #2c3e50;
        position: fixed;
        top: 0;
        left: 0;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 30px;
        box-sizing: border-box;
        z-index: 1000;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .header-logo {
        color: #fff;
        font-size: 20px;
        font-weight: bold;
        text-decoration: none;
    }
    .header-menu {
        display: flex;
        gap: 20px;
        list-style: none;
        margin: 0;
        padding: 0;
    }
    .header-menu a {
        color: #cbd5e1;
        text-decoration: none;
        font-size: 16px;
        font-weight: 500;
        transition: color 0.3s;
    }
    .header-menu a:hover, .header-menu a.active {
        color: #fff;
    }
    .header-user {
        color: #fff;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 15px;
    }
    .header-logout-btn {
        background-color: #e11d48;
        color: #fff;
        padding: 6px 12px;
        border-radius: 4px;
        text-decoration: none;
        font-size: 14px;
        transition: background 0.3s;
    }
    .header-logout-btn:hover {
        background-color: #be123c;
    }
</style>

<div class="header-navbar">
    <a href="<?php echo url('/'); ?>" class="header-logo">Hệ Thống Quản Lý</a>
    <?php if ($isLoggedIn): ?>
        <ul class="header-menu">
            <li>
                <a href="<?php echo url('/sinhvien/index'); ?>">Sinh viên</a>
            </li>
            <li>
                <a href="<?php echo url('/lophoc/index'); ?>">Lớp học</a>
            </li>
        </ul>
        <div class="header-user">
            <span>Xin chào, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong></span>
            <a href="<?php echo url('/auth/logout'); ?>" class="header-logout-btn">Đăng xuất</a>
        </div>
    <?php endif; ?>
</div>