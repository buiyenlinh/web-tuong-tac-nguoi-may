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

if ($action == 'login') {
    $username = _getString('username');
    $password = _getString('password');

    if (empty($username) || empty($password)) {
        _error('Vui lòng nhập đủ thông tin');
    }
    $password = md5($password);
    $user = $db->query('SELECT * FROM nguoidung WHERE tendangnhap = ' . $db->quote($username) . ' AND matkhau = ' . $db->quote($password))->fetch();
    if (empty($user)) {
        _error('Tên đăng nhập hoặc mật khẩu không đúng');
    }
    $_SESSION['user'] = $user;
    _success('OK', $password);
} else if ($action == 'logout') {
    if (empty($_SESSION['user'])) {
        _error('');
     }
     unset($_SESSION['user']);
     _success('OK');
} 
//  --------------------- Lấy danh sách user --------------------------
else if ($action == 'get-list-users') {
    $users = $db->query('SELECT * FROM nguoidung WHERE vaitro != 0')->fetchAll();
    
    _success('OK', $users);
} 

//  --------------------- Xóa user --------------------------
else if ($action == 'delete-user') {
    $user_id = _getInt('user_id');
    if ($user_id == $_SESSION['user']['id']) {
        _error('Đây là tài khoản của bạn. Không thể xóa');
    }
    $user_delete = $db->query('SELECT * FROM nguoidung WHERE id = ' . intval($user_id))->fetch();
    if (empty($user_delete)) {
        _error('Đã xảy ra lỗi! Vui lòng thử lại!');
    }
    if ($_SESSION['user']['vaitro'] >=  $user_delete['vaitro']) {
        _error('Bạn không có quyền xóa người dùng này!');
    }
    $db->query('DELETE FROM nguoidung WHERE id = ' . intval($user_id));
    _success('OK');
} 

//  --------------------- Lấy danh sách user --------------------------
else if ($action == 'add-user'){
    $username = _getString('username');
    $password = _getString('password');
    $role = _getInt('user_role');

    if (empty($username) || empty($password)) {
        _error('Vui lòng điền đủ thông tin các trường có dấu *');
    }
    $password = md5($password);

    $check = $db->query('SELECT * FROM nguoidung WHERE tendangnhap = ' . $db->quote($username))->fetch();

    if (!empty($check)) {
        _error('Tên đăng nhập này đã được sử dụng! Vui lòng chọn tên khác!');
    }

    $db->query('INSERT INTO nguoidung (tendangnhap, matkhau, vaitro) VALUES (' 
    . $db->quote($username) . ',' . $db->quote($password) . ',' . intval($role)
    . ')');

    $id = $db->lastInsertId();
    $res = $db->query('SELECT * FROM nguoidung WHERE id =' . intval($id))->fetch();
    _success('OK', $res);
}

//----------------------- cập nhật thông tin người dùng-----------------------

else if ($action === 'update-info-account') {
    $username = _getString('username');
    $name = _getString('name');
    $birthday = _getString('birthday');
    $gender = _getInt('gender');
    $filename = '';

    $check = $db->query('SELECT * FROM nguoidung WHERE tendangnhap = ' . $db->quote($username) . ' AND id != ' . intval($_SESSION['user']['id']))->fetchAll();

    if (!empty($check)) {
        _error('Tên đăng nhập này đã được dử dụng! Vui lòng nhập tên khác!');
    }

    $user = $db->query('SELECT * FROM nguoidung WHERE id =' . intval($_SESSION['user']['id']))->fetch();
    if (isset($_FILES['avt-user'])) {
        if (!empty($_FILES['avt-user']['name'])) {
            $filename = 'avt/' . $_FILES['avt-user']['name'];
            move_uploaded_file($_FILES['avt-user']['tmp_name'], $filename);
        }
    } else {
        $filename = $user['anhdaidien'];
    }

    $db->query('UPDATE nguoidung 
    SET tendangnhap = ' . $db->quote($username) . ', tenhienthi = ' . $db->quote($name) . ', anhdaidien=' . $db->quote($filename) . 
    ', ngaysinh=' . $db->quote($birthday) . ', gioitinh=' . intval($gender) .' WHERE id = ' . intval($_SESSION['user']['id']));
    _success('OK', $check);

}

//----------------------- Lấy thông tin người dùng -----------------------
else if ($action == 'get-info-account') {
    $user_info = $db->query('SELECT * FROM nguoidung WHERE id = ' . intval($_SESSION['user']['id']))->fetch();
    _success('OK', $user_info);
}

else if ($action == 'change-password-account') {
    $password = md5(_getString('password'));
    $new_password = md5(_getString('new-password'));

    $check = $db->query('SELECT * FROM nguoidung WHERE id = ' . intval($_SESSION['user']['id']))->fetch();
    if ($password != $check['matkhau']) {
        _error('Nhập mật khẩu cũ không đúng!');
    }

    $db->query('UPDATE nguoidung SET matkhau = ' . $db->quote($new_password) . ' WHERE id=' . intval($_SESSION['user']['id']));

    
    _success('OK', $check);
}

?>