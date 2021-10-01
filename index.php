<?php

include 'config.php';

$op = isset($_GET['op']) ? $_GET['op'] : '';
$level1 = isset($_GET['level1']) ? $_GET['level1'] : '';
$level2 = isset($_GET['level2']) ? $_GET['level2'] : '';

$array_op = array(
    '' => 'trangchu',
    'tim-kiem' => 'timkiem',
    'chi-tiet' => 'chitiet',
    'loi' => 'error'
);

$id = 0; // id kiểm tra có tồn tại đường dẫn nhập trong bảng động vật -> 0 : ko tồn tại
$textSearch = '';
if ($op == 'chi-tiet') {
    if (empty($level1)) {
        header('Location: ' . BASE . 'loi');
        exit();
    }
    $animals = $db->query('SELECT id, duongdan FROM dongvat')->fetchAll();
    foreach($animals as $_anm) {
        if($level1 == $_anm['duongdan']) {
            $id = $_anm['id'];
            $_SESSION["animal_id"] = $id;
            break;
        }
    }
    if ($id == 0) {
        header('Location: ' . BASE . 'loi');
        exit();
    }
} else if ($op == 'tim-kiem') {
    if (empty($level1)) {
        Header('Location: ' . BASE . 'loi');
        exit();
    } else {
        if (!empty($level2)) {
            Header('Location: ' . BASE . 'loi');
            exit();
        } else {
            $textSearch = str_replace('-', ' ', $level1);
        }
        
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
        var textSearch = '<?php echo $textSearch ?>';
        if (id > 0) {
            
            getAnimalInfo(id);
        }
        if (textSearch != '') {
            getSearchAnimal(textSearch);
        }
    })
</script>