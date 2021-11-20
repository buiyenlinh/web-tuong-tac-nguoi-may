<?php
$vaitro = $db->query('SELECT tenvaitro FROM vaitro WHERE id = ' . intval($_SESSION['user']['vaitro']))->fetchColumn();
?>
<div class="menu-left">
    <ul class="nav justify-content-center flex-column">
        <li class="nav-item pb-2 pt-2" style="border-bottom: 3px solid #fff">
            <a class="nav-link" style="color: #fff; font-size: 20px">
                <i class="fas fa-user-tie"></i>&nbsp; <?php echo $vaitro ?>
            </a>
        </li>    
        <li class="nav-item nav-item-thong-ke">
            <a class="nav-link text-light" href="<?php echo BASE?>admin/pages/thongke.php">
                <i class="fas fa-chart-bar"></i>&nbsp; Thống kê
            </a>
        </li>
        <li class="nav-item nav-item-animal">
            <a class="nav-link text-light" href="<?php echo BASE?>admin/pages/animal.php">
                <i class="fas fa-frog"></i>&nbsp; Động vật
            </a>
        </li>
        <li class="nav-item nav-item-ho-bo">
            <a class="nav-link text-light" href="<?php echo BASE?>admin/pages/ho.php">
            <i class="fas fa-feather-alt"></i>&nbsp; Bộ - Họ
            </a>
        </li>
        <li class="nav-item nav-item-gioi-nganh-lop">
            <a class="nav-link text-light" href="<?php echo BASE?>admin/pages/gioi-nganh-lop.php">
            <i class="fas fa-paw"></i>&nbsp;Giới - Ngành - Lớp
            </a>
        </li>
        <li class="nav-item nav-item-user">
            <a class="nav-link text-light" href="<?php echo BASE?>admin/pages/users.php">
                <i class="fas fa-users"></i>&nbsp; Người dùng
            </a>
        </li>
        <li class="nav-item nav-item-account">
            <a class="nav-link text-light" href="<?php echo BASE?>admin/pages/account.php">
                <i class="fas fa-user-circle"></i>&nbsp;Tài khoản
            </a>
        </li>
        <li class="nav-item nav-item-install">
            <a class="nav-link text-light" href="<?php echo BASE?>admin/pages/install.php">
                <i class="fas fa-cog"></i>&nbsp;Cài đặt
            </a>
        </li>
    </ul>
</div>