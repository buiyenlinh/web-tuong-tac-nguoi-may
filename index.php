<?php

include 'config.php';

$op = isset($_GET['op']) ? $_GET['op'] : '';
$level1 = isset($_GET['level1']) ? $_GET['level1'] : '';
$level2 = isset($_GET['level2']) ? $_GET['level2'] : '';

$array_op = array(
    '' => 'trangchu',
    'chi-tiet' => 'chitiet',
    'loi' => 'error'
);

$id = 0; // id kiểm tra có tồn tại đường dẫn nhập trong bảng động vật -> 0 : ko tồn tại
if ($op == 'chi-tiet') {
    if (empty($level1)) {
        header('Location: ' . BASE . 'loi');
        exit();
    }
    $animals = $db->query('SELECT id, duongdan FROM dongvat')->fetchAll();
    foreach($animals as $_anm) {
        if($level1 == $_anm['duongdan']) {
            $id = $_anm['id'];
            break;
        }
    }
    if ($id == 0) {
        header('Location: ' . BASE . 'loi');
        exit();
    }
}

$file_op = $array_op[$op];

include ROOT . '/layout/header-only.php';
include ROOT . '/layout/header.php';

include ROOT . '/pages/' . $file_op . '.php';

include ROOT . '/layout/footer.php';
include ROOT . '/layout/footer-only.php';


?>

<script>
    $(function() {
        var id = <?php echo $id ?>;
        if (id > 0) {
            getAnimalInfo(id);
        }
    })
</script>