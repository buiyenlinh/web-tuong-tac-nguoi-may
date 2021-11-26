<?php
$vaitro = $db->query('SELECT tenvaitro FROM vaitro WHERE id = ' . intval($_SESSION['user']['vaitro']))->fetchColumn();
?>
<div class="menu-left">
    <ul class="nav justify-content-center flex-column">
        <li class="nav-item pb-2 pt-2" style="border-bottom: 3px solid #378488" title="<?php echo $vaitro ?>">
            <a class="nav-link" style="color: #fff; font-size: 20px">
                <i class="fas fa-user-tie"></i>&nbsp; <?php echo $vaitro ?>
            </a>
        </li>    
        <li class="nav-item nav-item-thong-ke" title="Thống kê">
            <a class="nav-link text-light" href="<?php echo BASE?>admin/pages/thongke.php">
                <i class="fas fa-chart-bar"></i>&nbsp; Thống kê
            </a>
        </li>
        <li class="nav-item nav-item-animal" title="Động vật">
            <a class="nav-link text-light" href="<?php echo BASE?>admin/pages/animal.php">
                <i class="fas fa-frog"></i>&nbsp; Động vật
            </a>
        </li>
        <li class="nav-item nav-item-ho-bo" title="Bộ - Họ">
            <a class="nav-link text-light" href="<?php echo BASE?>admin/pages/ho.php">
            <i class="fas fa-project-diagram"></i>&nbsp; Bộ - Họ
            </a>
        </li>
        <li class="nav-item nav-item-gioi-nganh-lop" title="Giới - Ngành - Lớp">
            <a class="nav-link text-light" href="<?php echo BASE?>admin/pages/gioi-nganh-lop.php">
            <i class="fas fa-paw"></i>&nbsp;Giới - Ngành - Lớp
            </a>
        </li>
        <li class="nav-item nav-item-user" title="Người dùng">
            <a class="nav-link text-light" href="<?php echo BASE?>admin/pages/users.php">
                <i class="fas fa-users"></i>&nbsp; Người dùng
            </a>
        </li>
        <li class="nav-item nav-item-account" title="Tài khoản">
            <a class="nav-link text-light" href="<?php echo BASE?>admin/pages/account.php">
                <i class="fas fa-user-circle"></i>&nbsp;Tài khoản
            </a>
        </li>
        <li class="nav-item nav-item-install" title="Cài đặt">
            <a class="nav-link text-light" href="<?php echo BASE?>admin/pages/install.php">
                <i class="fas fa-cog"></i>&nbsp;Cài đặt
            </a>
        </li>
    </ul>
</div>