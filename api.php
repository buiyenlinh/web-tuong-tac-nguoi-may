<?php

include 'config.php';

function _getString($name, $default='') {
    if (isset($_POST[$name])) {
        return trim($_POST[$name]);
    }
    return $default;
}

function _getInt($name, $default = 0) {
    if (isset($_POST[$name])) {
        return $_POST[$name];
    }

    return $default;
}

function _success($message, $data = array()) {
    exit(json_encode(array(
        'status'=> 'OK',
        'data' => $data,
        'message' => $message
    )));
}

function _error($message) {
    exit(json_encode(array(
        'status' => 'error',
        'error' => $message
    )));
}

function to_slug($str) { 
    $str = trim(mb_strtolower($str));
    $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
    $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
    $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
    $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
    $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
    $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
    $str = preg_replace('/(đ)/', 'd', $str);
    $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
    $str = preg_replace('/([\s]+)/', '-', $str);
    return $str;
}

$action = _getString('action');

if ($action == 'get-list-animals') {
    $animals = $db->query('SELECT tenkhoahoc, hinh1, duongdan FROM dongvat')->fetchAll();
    _success('OK', $animals);
}

// Lấy thông tin 1 con vật
else if ($action == 'get-animal-info') {
    $animal_id = _getInt('animal-id');
    $info = $db->query('SELECT * FROM dongvat WHERE id = ' . intval($animal_id))->fetch();

    _success('OK', $info);
}

// Lấy danh sách động vật tương tự
else if ($action == 'get-animal-list-same-family') {
    $animal_id = _getInt('animal_id');
    $animal = $db->query('SELECT ho, bo FROM dongvat WHERE id = ' . intval($animal_id))->fetch();

    $list = $db->query('SELECT id, tenkhoahoc, duongdan, hinh1 FROM dongvat 
    WHERE ho LIKE "%' . $animal['ho'] . '%" AND bo LIKE "%' . $animal['bo'] . '%" AND id != ' . intval($animal_id))->fetchAll();

    _success('OK', $list);
}

?>