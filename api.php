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
    $animals = $db->query('SELECT id, tenkhoahoc, duongdan FROM dongvat')->fetchAll();
    $res = array();
    foreach($animals as $_anm) {
        $hinh = $db->query('SELECT * FROM hinhanh WHERE dongvat_id = ' . intval($_anm['id']))->fetch();
        $animal = array(
            'img' => $hinh,
            'animal' => $_anm
        );
        $res[] = $animal;
    }
    _success('OK', $res);
}

// Lấy thông tin 1 con vật
else if ($action == 'get-animal-info') {
    $animal_id = _getInt('animal-id');
    $info = $db->query('SELECT * FROM dongvat WHERE id = ' . intval($animal_id))->fetch();
    $img = $db->query('SELECT * FROM hinhanh WHERE dongvat_id = ' . intval($animal_id))->fetchAll();
    $ho = $db->query('SELECT * FROM ho where id = ' . intval($info['ho_id']))->fetch();
    $bo = $db->query('SELECT * FROM bo where id = ' . intval($ho['bo_id']))->fetch();
    $lop = $db->query('SELECT * FROM lop where id = ' . intval($bo['lop_id']))->fetch();
    $nganh = $db->query('SELECT * FROM nganh where id = ' . intval($lop['nganh_id']))->fetch();
    $gioi = $db->query('SELECT * FROM gioi where id = ' . intval($nganh['gioi_id']))->fetch();
    $res = array(
        'img' => $img,
        'info' => $info,
        'ho' => $ho,
        'bo' => $bo,
        'lop' => $lop,
        'nganh' => $nganh,
        'gioi' => $gioi
    );

    _success('OK', $res);
}

// Lấy danh sách động vật tương tự
else if ($action == 'get-animal-list-same-family') {
    $animal_id = _getInt('animal_id');
    $bo = $db->query('SELECT ho_id FROM dongvat WHERE id = ' . intval($animal_id))->fetchColumn();

    $list = $db->query('SELECT id, tenkhoahoc, duongdan FROM dongvat 
    WHERE ho_id= ' . intval($bo) . ' AND id != ' . intval($animal_id))->fetchAll();
    $res = array();
    foreach($list as $_list) {
        $img = $db->query('SELECT * FROM hinhanh WHERE dongvat_id = ' . intval($_list['id']))->fetch();
        $ani = array(
            'img' => $img,
            'animal' => $_list
        );
        $res[] = $ani;
    }

    _success('get-animal-list-same-family', $res);
}

// Search animal
else if ($action == 'get-search-animal') {
    $text = _getString('text');
    $toado = $db->query('SELECT id FROM toado WHERE toado LIKE "%' . $text . '%"')->fetchAll();

    $list = $db->query('SELECT * FROM dongvat WHERE CONCAT_WS(tenkhoahoc, tentiengviet, tendiaphuong, gioi, nganh, lop, bo, ho, hinhthai, sinhthai, giatri, iucn, sachdo, nghidinh, cities, phanbo, tinhtrang, sinhcanh, diadiem, ngaythuthap, nguoithuthap, created_at, updated_at, duongdan) LIKE "%' . $text . '%"')->fetchAll();
    $res = array();
    foreach($list as $_list) {
        $img = $db->query('SELECT * FROM hinhanh WHERE dongvat_id = ' . intval($_list['id']))->fetch();
        $animal = array(
            'img' => $img,
            'animal' => $_list
        );
        $res[] = $animal;
    }
    _success('get-search-animal', $res);

} 

?>