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
// chuyển chuỗi ex: trang chủ => trang-chu
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

?>