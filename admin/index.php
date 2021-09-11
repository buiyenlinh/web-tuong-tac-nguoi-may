<?php 

include '../config.php';
include './layout/header-only.php';

?>

<?php if (empty($_SESSION['user'])): ?>
    <?php include './pages/login.php' ?>
<?php else: ?>
    <div id="main">
        <div class="layout-wrap">
            <div class="layout-left">
                <?php include './layout/menu-left.php'; ?>
            </div>
            <div class="layout-right">
                <div class="layout-right-header">
                    <?php include './layout/header.php'; ?>
                </div>
                <div class="layout-right-content">
                    <div class="layout-right-content-details">
                        <div class="ad-main__right">
                            <div class="ad-main__right--title mt-2 mb-1">
                                <h3>Chào mừng đến với trang web của chúng tôi</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php include './layout/footer-only.php' ?>