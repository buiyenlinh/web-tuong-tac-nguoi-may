
<?php
include '../config.php';
$install = $db->query('select * from caidat')->fetch();
if ($install['tenwebsite'] == '') {
    $install['tenwebsite'] = 'Tiêu đề website';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $install['tenwebsite'] ?></title>

    <link rel="icon" type="image/png" href="<?php echo BASE . $install['favicon'] ?>">

    <link rel="stylesheet" href="<?php echo BASE?>bootstrap/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href=" <?php echo BASE ?>css/ad_style.css" >
    <link rel="stylesheet" href=" <?php echo BASE ?>css/ad_responsive.css" >
</head>
<body>
    


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
                                <h3>Chào mừng đến với website quản lý động vật</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php include './layout/footer-only.php' ?>