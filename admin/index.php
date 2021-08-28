<?php 

include '../config.php';
include './layout/header-only.php';

?>

<?php if (empty($_SESSION['user'])): ?>
    <?php include './pages/dangnhap.php' ?>
<?php else: ?>
    <?php include './layout/header.php'; ?>
    <div id="ad-main">
        <div class="container">
            <div class="ad-main">
                <div class="layout-wrap">
                    <div class="layout-left">
                        <?php include './layout/menu-left.php'; ?>
                    </div>
                    <div class="layout-right">
                        <div class="ad-main__right">
                            <div class="ad-main__right--title mt-2 mb-1">
                                <h3>Chào mừng đến với trang </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php include './layout/footer-only.php' ?>