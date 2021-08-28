<?php

include 'config.php';

$op = isset($_GET['op']) ? $_GET['op'] : '';
$level1 = isset($_GET['level1']) ? $_GET['level1'] : '';
$level2 = isset($_GET['level2']) ? $_GET['level2'] : '';

$array_op = array(
    '' => 'trangchu',
);


$file_op = $array_op[$op];

include ROOT . '/layout/header-only.php';
include ROOT . '/layout/header.php';

include ROOT . '/pages/' . $file_op . '.php';

include ROOT . '/layout/footer.php';
include ROOT . '/layout/footer-only.php';



?>