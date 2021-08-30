var api = BASE + 'ad_api.php';

function myPost(action, data, callback) {
    if (data) {
        data = 'action=' + action + '&' + data;
    } else {
        data = 'action=' + action;
    }

    $.ajax({
        url: api,
        type: 'post',
        cache: false,
        data: data,
        dataType: 'json'
    }).done(function(json) {
        callback(json);
    })
}

function login(form) {
    if (form.username.value == '' || form.password.value == '') {
        alert('Vui lòng nhập đủ thông tin');
        return;
    }
    var data = $(form).serialize();
    myPost('login', data, function(json) {
        if (json['status'] == 'OK') {
            console.log('Đăng nhập thành công');
            window.location.reload();
        } else {
            alert(json['error']);
        }
    })
}

function logout() {
    if (!confirm('Bạn có muốn đăng xuất?')) {
        return;
    }
    myPost('logout', '', function(json) {
        if (json['status'] == 'OK') {
            window.location = BASE + 'admin/';
        } else {
            alert('Đăng xuất chưa được thực hiện!');
        }
    })
}

// ---------------------- Lấy danh sách người dùng trong admin ----------------------

function getListUsers() {
    $('.list-users-body').text('');
    myPost('get-list-users', '', function(json) {
        if (json['status'] == 'OK') {
            console.log(json['data']);
            for(let i in json['data']) {
                createItemUser(json['data'][i]);
            }
        }
    })
}

    // ---------------------- Tạo một hàng trong bảng danh sách user ----------------------
function createItemUser(itemData) {
    var tr = document.createElement('tr');
    var td_name = document.createElement('td');
    var td_role = document.createElement('td');
    var td_time = document.createElement('td');
    var td = document.createElement('td');

    var icon_delete = document.createElement('i');
    icon_delete.onclick = function() {
        deleteUser(itemData.id);
    }
    td_role.innerHTML = itemData['vaitro'];
    if (itemData.vaitro == 1) {
        td_role.innerHTML = 'Administrator';
    } else {
        td_role.innerHTML = 'Editor';
    }

    icon_delete.className ="far fa-trash-alt text-danger icon-delele-user";
    td_name.innerHTML = itemData.tenhienthi || itemData.tendangnhap;

    td_time.innerHTML = itemData.thoigianthem;
    td.append(icon_delete);

    tr.append(td_name, td_role, td_time, td);
    $('.list-users-body').append(tr);
}

// ---------------------- Xóa người dùng trong admin ----------------------
function deleteUser(user_id) {
    if (!confirm('Bạn có muốn xóa người dùng này?')) {
        return;
    }
    myPost('delete-user', 'user_id=' + user_id, function(json) {
        if (json['status'] == 'OK') {
            $('.list-users-body').text('');
            alert('Đã xóa người dùng thành công');
            getListUsers();
        } else {
            alert(json['error']);
        }
    })
}

// ---------------------- Thêm người dùng mới trong admin ----------------------
function addUser(form) {
    if (form.username.value == '' || form.password.value == '') {
        alert('Vui lòng nhập đủ thông tin!');
        return;
    }
    var data = $(form).serialize();
    console.log(data)
    myPost('add-user', data, function(json) {
        if (json['status'] == 'OK') {
            getListUsers();
            $('.user-form__button__reset').click();
        } else {
            alert(json['error']);
        }
    })
}

// ---------------------- Thay đổi thông tin người dùng trong admin ----------------------
function updateInfoAccount(form) {
    var username = form.account_username.value;
    var name = form.account_name.value;
    var birthday = form.account_birthday.value;
    var gender = form.account_gender.value;
    
    if (username == '') {
        alert('Tên đăng nhập khác rỗng!');
        return;
    }

    var avt = $('#account__info__left--avt-file')[0].files[0];
    var formData = new FormData();
    formData.append('action', 'update-info-account');
    formData.append('avt-user', avt);
    formData.append('username', username);
    formData.append('name', name);
    formData.append('birthday', birthday);
    formData.append('gender', gender);
    $.ajax({
        url: api,
        type: 'post',
        data: formData,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function(json) {
            if (json['status'] == 'OK') {
                alert('Cập nhật thông tin thành công!');
            } else {
                alert(json['error']);
            }
            getInfoAccount();
        }
    })
}
// ------------------- Lấy thông tin user -------------------
function getInfoAccount() {
    myPost('get-info-account', '', function(json) {
        if (json['status'] == 'OK') {
            console.log(json['data']);
            $('.account__info__center__form--username').val(json['data']['tendangnhap']);
            $('.account__info__center__form--name').val(json['data']['tenhienthi']);
            $('.account__info__left--avt img').attr('src', BASE + json['data']['anhdaidien']);
            $('.account__info__center__form--birthday').val(json['data']['ngaysinh']);
            $('.account__info__left--name').text(json.data.tenhienthi || json.data.tendangnhap);
            if (json['data']['gioitinh'] == 0) {
                $('.female').attr('checked', true);
            } else {
                $('.male').attr('checked', true);
            }
        } else {
            alert(json['error']);
        }
    })
}

// ------------------- Đổi mật khẩu user -------------------
function changePasswordAccount(form) {
    var password = form.account_password.value;
    var new_password = form.account_new_password.value;
    var re_new_password = form.account_re_new_password.value;
    if (new_password != re_new_password) {
        alert('Nhập lại mật khẩu mới không đúng!');
        return;
    }
    myPost('change-password-account', 'password=' + password + '&new-password=' + new_password, function(json) {
        if (json['status'] == 'OK') {
            console.log('changePassword');
            console.log(json);
            $('.account__left__btn-reset').click();
            alert('Thay đổi mật khẩu thành công!');
        } else {
            alert(json['error']);
        }
    })
}

$(function() {
    getListUsers();
    $('form').on('click', '#login_submit', function() {
        login(this.form);
        return false;
    })

    $('#logout').on('click', function() {
        logout();
    })

    $('form').on('click', '.user-form__button__add', function() {
        addUser(this.form);
        return false;
    })

    //----------------------------------------- ACCOUNT PAGE --------------------------------
    $('.icon-edit-avt').on('click', function() {
        $('.account__info__left--avt-file').click();
    })
        // -------------- thay đổi username, name, avt ----------------
    $('form').on('click', '.account__info__center__form--btn-change-info', function() {
        updateInfoAccount(this.form);
        return false;
    })
    
        // ------------------- Lấy thông tin user -------------------
    getInfoAccount();
        // ------------------- Thay đổi mật khẩu -------------------
    $('form').on('click', '.account__info__right__form--btn-change-password', function() {
        changePasswordAccount(this.form);
        return false;
    })
})