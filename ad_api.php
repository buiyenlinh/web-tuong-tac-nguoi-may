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
    $users = $db->query('SELECT * FROM nguoidung WHERE vaitro != 1')->fetchAll();
    $res = array();
    foreach ($users as $_us) {
        $vaitro = $db->query('SELECT tenvaitro FROM vaitro WHERE id = ' . intval($_us['vaitro']))->fetch();
        $birthday = $db->query('SELECT date(ngaysinh) from nguoidung WHERE id = ' . intval($_us['id']))->fetchColumn(); 
        $_us['vaitro'] = $vaitro['tenvaitro'];  
        if ($_us['gioitinh'] == 0) {
            $_us['gioitinh'] = 'Nữ';
        } else {
            $_us['gioitinh'] = 'Nam'; 
        }

        $_us['ngaysinh'] = $birthday;
        $res[] = $_us;
    }
    _success('OK', $res);
} 

// Lấy thông tin người dùng
else if ($action == 'get-info-user') {
    $id = _getInt('id');
    $user = $db->query('SELECT * FROM nguoidung WHERE id = ' . intval($id))->fetch();
    $birthday = $db->query('SELECT date(ngaysinh) FROM nguoidung WHERE id = ' . intval($id))->fetchColumn();
    $user['ngaysinh'] = $birthday;
    _success('OK', $user);
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

//  --------------------- Thêm user --------------------------
else if ($action == 'add-user'){
    $username = _getString('username');
    $password = _getString('password');
    $role = _getInt('user_role');

    if ($_SESSION['user']['vaitro'] >= $role || $_SESSION['user']['vaitro'] == 3) {
        _error('Không có quyền thêm!');
    }

    if (empty($username) || empty($password)) {
        _error('Vui lòng điền đủ thông tin các trường có dấu *');
    }
    $password = md5($password);

    $check = $db->query('SELECT * FROM nguoidung WHERE tendangnhap = ' . $db->quote($username))->fetch();

    if (!empty($check)) {
        _error('Tên đăng nhập này đã được sử dụng!');
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
    $phone = _getInt('phone');
    $address = _getInt('address');
    $filename = '';

    $check = $db->query('SELECT * FROM nguoidung WHERE tendangnhap = ' . $db->quote($username) . ' AND id != ' . intval($_SESSION['user']['id']))->fetchAll();

    if (!empty($check)) {
        _error('Tên đăng nhập này đã được sử dụng!');
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
    ', ngaysinh=' . $db->quote($birthday) . ', gioitinh=' . intval($gender) . ', sodienthoai=' . $db->quote($phone) . ', diachi=' . $db->quote($address) .' WHERE id = ' . intval($_SESSION['user']['id']));
    _success('OK', $check);

}

//----------------------- Lấy thông tin người dùng -----------------------
else if ($action == 'get-info-account') {
    $user_info = $db->query('SELECT * FROM nguoidung WHERE id = ' . intval($_SESSION['user']['id']))->fetch();
    $birthday = $db->query('SELECT date(ngaysinh) from nguoidung WHERE id = ' . intval($_SESSION['user']['id']))->fetchColumn();
    $user_info['ngaysinh'] = $birthday;
    $role = $db->query('SELECT tenvaitro FROM vaitro where id = ' . intval($user_info['vaitro']))->fetchColumn();
    $user_info['vaitro'] = $role;
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

//  Cấp nhật tài khoản cho user
else if ($action == 'update-user') {
    $username = _getString('username');
    $role = _getInt('role');
    $gender = _getInt('gender');
    $user_id = _getInt('user_id');
    $name = _getString('name');
    $address = _getString('address');
    $phone = _getString('phone');
    $birthday = _getString('birthday');

    if (!empty($phone) && !preg_match('/^0[0-9]{9,}$/', $phone)) {
        _error('Số điện thoại không hợp lệ!');
    }

    $check = $db->query('SELECT * FROM nguoidung WHERE id = ' . intval($user_id))->fetch(); {}
    if (empty($check)) {
        _error('Người dùng không tồn tại');
    }
    
    $check_username = $db->query('SELECT * from nguoidung WHERE tendangnhap = ' . $db->quote($username) . ' AND id != ' . intval($user_id))->fetch();

    if (!empty($check_username)) {
        _error('Tên đăng nhập đã được dùng!');
    }

    if ($_SESSION['user']['vaitro'] >= $check['vaitro']) {
        _error('Không có quyền thay đổi!');
    }


    $db->query('UPDATE nguoidung 
        SET tendangnhap = ' . $db->quote($username)
        . ', tenhienthi = ' . $db->quote($name)
        . ', ngaysinh = ' . $db->quote($birthday)
        . ', gioitinh = ' . intval($gender)
        . ', sodienthoai = ' . $db->quote($phone)
        . ', diachi = ' . $db->quote($address)
        . ', vaitro = ' . intval($role)
        . ' WHERE id = ' . intval($user_id)
    );

    _success('OK');
}

// Lấy danh sách vai trò người dùng
else if ($action == 'get-list-role') {
    $listRole = $db->query('SELECT * FROM vaitro')-> fetchAll();
    
    _success('OK', $listRole);
}

else if ($action == 'get-sum-animal-post') {
    $sum = $db->query('SELECT COUNT(*) FROM dongvat')->fetchColumn();
    $sum_post = $db->query('SELECT COUNT(*) FROM dongvat WHERE nguoitao = ' . intval($_SESSION['user']['id']))->fetchColumn();
    $percent = round(($sum_post / $sum) * 100, 3);
    
    $res = array(
        'sum' => $sum_post,
        'percent' => $percent
    );
    _success('OK', $res);
}

// Quên mật khẩu
else if ($action == 'forget-password') {
    $username = _getString('username');
    $new_password = _getString('new_password');

    $check = $db->query('SELECT * FROM nguoidung WHERE tendangnhap = ' . $db->quote($username))->fetch();
    if (empty($check)) {
        _error('Tên đăng nhập không tồn tại!');
    }
    $new_password = md5($new_password);
    $db->query('UPDATE nguoidung SET matkhau = ' . $db->quote($new_password) . ' WHERE tendangnhap = ' . $db->quote($username));
    _success('OK');

} 

// Cập nhật thông tin chung của webiste
else if ($action == 'update-info-install') {
    $website_name = _getString('website_name');
    $footer_info = _getString('footer_info');

    $install = $db->query('select * from caidat')->fetch();
    $filename = '';

    if ($website_name == '') {
        $website_name = $install['tenwebsite'];
    }

    if ($footer_info == '') {
        $footer_info = $install['thongtinfooter'];
    }

    if (isset($_FILES['favicon'])) {
        if (!empty($_FILES['favicon']['name'])) {
            $filename = 'favicon/' . $_FILES['favicon']['name'];
            move_uploaded_file($_FILES['favicon']['tmp_name'], $filename);
        }
    } else {
        $filename = $install['favicon'];
    }
    if ($install) {
        $db->query('update caidat
        set tenwebsite = ' . $db->quote($website_name)
        . ', thongtinfooter=' . $db->quote($footer_info)
        . ', favicon=' . $db->quote($filename));
    } else {
        $db->query('insert caidat(tenwebsite, thongtinfooter, favicon)
            values (' .  $db->quote($website_name)
            . ', ' . $db->quote($footer_info)
            . ', ' . $db->quote($filename) . ')');
    }
    
    $install = $db->query('select * from caidat')->fetch();
    _success('OK', $install);
}

// Get info install page
else if ($action == 'get-info-install') {
    $install = $db->query('select * from caidat')->fetch();
    _success('OK', $install);
}




// Lấy danh sách họ theo bộ id
else if ($action == "get-list-ho-by-bo-id") {
    $bo_id = _getInt('bo_id');
    $ho = $db->query('select * from ho where bo_id=' . intval($bo_id))->fetchAll();
    return _success("get-list-ho-by-bo-id", $ho);
}

// Lấy danh sách bộ theo lớp id
else if ($action == "get-bo-by-lop-id") {
    $lop_id = _getInt('lop_id');
    $bo = $db->query('select * from bo where lop_id=' . intval($lop_id))->fetchAll();
    return _success("get-bo-by-lop-id", $bo);
}

// Lấy danh sách lớp theo ngành id
else if ($action == "get-lop-by-nganh-id") {
    $nganh_id = _getInt('nganh_id');
    $lop = $db->query('select * from lop where nganh_id=' . intval($nganh_id))->fetchAll();
    return _success("get-lop-by-nganh-id", $lop);
}

// Lấy danh sách ngành theo giới id
else if ($action == "get-nganh-by-gioi-id") {
    $gioi_id = _getInt('gioi_id');
    $nganh = $db->query('select * from nganh where gioi_id=' . intval($gioi_id))->fetchAll();
    return _success("get-nganh-by-gioi-id", $nganh);
}



// Lấy danh sách họ và bộ
else if ($action == "get-list-ho") {
    $ho = $db->query('select * from ho')->fetchAll();
    $bo = $db->query('select * from bo')->fetchAll();
    $response = [
        'bo' => $bo,
        'ho' => $ho
    ];
    return _success("get-list-ho", $response);
}


// lấy danh sách giới
else if ($action == "get-list-gioi") {
    $gioi = $db->query('select * from gioi')->fetchAll();
    return _success('OK', $gioi);
}

// thêm bộ
else if ($action == "add-bo") {
    $lop = _getInt('lop');
    $bo = _getString('bo');
    $check = $db->query("select * from bo where ten =" . $db->quote($bo) . " and lop_id = " . intval($lop))->fetch();
    if ($check) {
        return _error("Bộ đã tồn tại");
    }
    $db->query("Insert into bo(ten, lop_id) values (" . $db->quote($bo) . ", " . intval($lop) . ")");
    return _success("OK");
}

// Xóa bộ
else if ($action == "delete-bo") {
    $bo_id = _getInt("bo_id");
    if (!$bo_id || $bo_id < 0) {
        return _error("Vui lòng thử lại");
    }
    $ho = $db->query("select * from ho where bo_id=" . intval($bo_id))->fetchAll();
    foreach ($ho as $_ho) {
        $db->query("delete from dongvat where ho_id=" . intval($_ho['id']));
        $db->query("delete from ho where id=" . intval($_ho['id']));
    }
    $db->query("delete from bo where id = " . intval($bo_id));
    return _success("OK");
}


// Lấy thông tin bộ bởi id bộ
else if ($action == "get-info-bo-by-id") {
    $bo_id = _getInt("bo_id");
    $bo = $db->query("select * from bo where id = " . intval($bo_id))->fetch();
    $lop = $db->query("select * from lop where id = " . intval($bo['lop_id']))->fetch();
    $nganh = $db->query("select * from nganh where id = " . intval($lop['nganh_id']))->fetch();
    $gioi = $db->query("select * from gioi where id = " . intval($nganh['gioi_id']))->fetch();

    $response = [
        'bo' => $bo,
        'lop' => $lop,
        'nganh' => $nganh,
        'gioi' => $gioi,
    ];

    return _success('OK', $response);
}

// Cập nhật bộ
else if ($action == "update-bo") {
    $lop_id = _getInt('lop_id');
    $bo_id = _getInt('bo_id');
    $bo_name = _getString("bo_name");
    if ($lop_id && $bo_id) {
        $db->query('UPDATE bo SET lop_id = ' . intval($lop_id) . ', ten =' . $db->quote($bo_name) . ' WHERE id = ' . intval($bo_id));
        return _success("update_bo");
    }
}

// thêm họ
else if ($action == "add-ho") {
    $bo_id = _getInt('bo_id');
    $ho = _getString('ho');
    $check = $db->query("SELECT * FROM ho WHERE ten = " . $db->quote($ho))->fetch();
    if ($check) {
        return _error("Họ này đã tồn tại");
    }
    $db->query("INSERT INTO ho (ten, bo_id) VALUES (" . $db->quote($ho) . ", " . intval($bo_id) . ")");
    return _success("add-ho");
}


// Lấy thông tin họ
else if ($action == "get-info-ho") {
    $ho_id = _getInt('ho_id');
    $ho = $db->query("select * from ho where id = " . intval($ho_id))->fetch();

    $bo = $db->query("select * from bo where id = " . intval($ho['bo_id']))->fetch();
    $lop = $db->query("select * from lop where id = " . intval($bo['lop_id']))->fetch();
    $nganh = $db->query("select * from nganh where id = " . intval($lop['nganh_id']))->fetch();
    $gioi = $db->query("select * from gioi where id = " . intval($nganh['gioi_id']))->fetch();

    $response = [
        'ho' => $ho,
        'bo' => $bo,
        'lop' => $lop,
        'nganh' => $nganh,
        'gioi' => $gioi,
    ];

    return _success('OK', $response);   
}

// Cập nhật họ
else if ($action == "update-ho") {
    $ho_id = _getInt('ho_id');
    $ho_name = _getString('ho_name');
    $bo_id = _getInt('bo_id');

    $db->query("UPDATE ho SET ten = " . $db->quote($ho_name) . ", bo_id = " . intval($bo_id) . " where id = " . $ho_id);
    return _success("update-ho");
}

// Xóa họ
else if ($action == "delete-ho") {
    $ho_id = _getInt('ho_id');
    if ($ho_id <= 0) {
        return _error("Vui lòng thử lại");
    }
    $animal = $db->query("SELECT * FROM dongvat WHERE ho_id = " . intval($ho_id))->fetchAll();
    foreach ($animal as $_ani) {
        $db->query("DELETE FROM dongvat WHERE id = " . intval($_ani['id']));    
    }
    $db->query("DELETE FROM ho WHERE id = " . intval($ho_id));
    return _success("delete-ho");
}
?>