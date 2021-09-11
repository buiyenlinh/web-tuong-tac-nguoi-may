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

// -------------------- Lấy danh sách vai trò người dùng --------------
function getListRole() {
    myPost('get-list-role', '', function(json) {
        if (json.status == 'OK') {
            console.log('get list role');
            console.log(json.data);
            for (let i in json.data) {
                if (json.data[i].id != 1) {
                    var option = document.createElement('option');
                    option.innerHTML = json.data[i].tenvaitro;
                    option.setAttribute('value', json.data[i].id);
                    $('.user_role_list').append(option);
                }
                
            }
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
    var td_username = document.createElement('td');
    var td_name = document.createElement('td');
    var td_birthday = document.createElement('td');
    var td_gender = document.createElement('td');
    var td_phone = document.createElement('td');
    var td_address = document.createElement('td');
    var td_role = document.createElement('td');
    var td_time = document.createElement('td');
    var td = document.createElement('td');

    td_username.innerHTML = itemData.tendangnhap;
    td_name.innerHTML = itemData.tenhienthi;
    td_role.innerHTML = itemData.vaitro;
    td_birthday.innerHTML = itemData.ngaysinh;
    td_gender.innerHTML = itemData.gioitinh;
    td_phone.innerHTML = itemData.sodienthoai;
    td_address.innerHTML = itemData.diachi;
    td_time.innerHTML = itemData.thoigianthem;

    var icon_delete = document.createElement('i');
    icon_delete.onclick = function() {
        deleteUser(itemData.id);
    }
    icon_delete.setAttribute('title', 'Xóa');
    icon_delete.className ="far fa-trash-alt text-danger icon-delele-user pl-1";

    var icon_update = document.createElement('i');
    icon_update.setAttribute('title', 'Cập nhật');
    icon_update.onclick = function() {
        getInfoUser(itemData.id);
    }
    icon_update.className ="fas fa-save text-info icon-update-user pr-1";
    icon_update.setAttribute('data-toggle', 'modal');
    icon_update.setAttribute('data-target', '#update-user-modal');
    td.append(icon_update, icon_delete);

    tr.append(td_username, td_name, td_role, td_birthday, td_gender, td_phone, td_address, td_time, td);
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
//  Lấy thông tin người dùng
var user_update_id = 0;
function getInfoUser (id) {
    myPost('get-info-user', 'id=' + id, function(json) {
        if (json.status == 'OK') {
            console.log(json.data);
            $('.update-user-username').val(json.data.tendangnhap);
            $('.update-user-name').val(json.data.tenhienthi);
            $('.update-user-birthday').val(json.data.ngaysinh);
            $('.update-user-phone').val(json.data.sodienthoai);
            $('.update-user-address').val(json.data.diachi);
            if (json.data.gioitinh == 1) {
                $('.male').attr('checked', true);
            } else {
                $('.female').attr('checked', true); 
            }
            $('.user_role_list option[value=' + json.data.vaitro + ']').attr('selected','selected');
            user_update_id = id;
        }
    });
}


// ---------------------- Cập nhật người dùng trong admin ----------------------
function updateUser() {
    var form = document.forms['user-update-form'];
    var phone = form.phone.value;
    if (phone != '' && !(/^0[0-9]{9}$/).test(phone)) {
        alert('Số điện thoại không hợp lệ');
        return;
    }
    var data = $(form).serialize();
    console.log(data);
    myPost('update-user', 'user_id=' + user_update_id + '&' + data, function(json) {
        if (json.status == 'OK') {
            console.log(json.data);
            $('.close-modal-update-user').click();
            alert('Cập nhật thành công');
            getListUsers();
        } else {
            alert(json.error);
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
            $('.close-modal-add-user').click();
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
    var phone = form.account_phone.value;
    var address = form.account_address.value;
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
    formData.append('phone' , phone);
    formData.append('address' , address);
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
            $('.account__info__right--phone span').text(json.data.sodienthoai);
            $('.account__info__right--address span').text(json.data.diachi);
            $('.account__info__right--role span').text(json.data.vaitro); 
            $('.account__info__left--avt img').attr('src', BASE + json['data']['anhdaidien']);
            $('.profile-details-info--username').val(json['data']['tendangnhap']);
            $('.profile-details-info--name').val(json['data']['tenhienthi']);
            $('.profile-details-info--birthday').val(json['data']['ngaysinh']);
            $('.account__info__right--name').text(json.data.tenhienthi || json.data.tendangnhap);
            $('.profile-details-info--phone').val(json.data.sodienthoai);
            $('.profile-details-info--address').val(json.data.diachi);

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
    if (password == '' || new_password == '' || re_new_password == '') {
        alert('Vui lòng điền đủ thông tin có dấu *');
        return;
    }
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

// Lấy tổng số bài đăng của account
function getSumAnimalPost() {
    myPost('get-sum-animal-post', '', function(json) {
        if (json.status == 'OK') {
            console.log(json);
            $('.account-post-number .sum-animal').text(json.data.sum);
            $('.account-post-number .percent').text(json.data.percent);
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
    $('form').on('click', '.profile-details-info--btn-change-info', function() {
        updateInfoAccount(this.form);
        return false;
    })
    
        // ------------------- Lấy thông tin user -------------------
    getInfoAccount();
    getSumAnimalPost();

        // ------------------- Thay đổi mật khẩu -------------------
    $('form').on('click', '.account__info__right__form--btn-change-password', function() {
        changePasswordAccount(this.form);
        return false;
    })

    getListRole();

    $('.close-modal-add-user').on('click', function() {
        $('.user-form__button__reset').click();
    })

    // Cập nhật user
    $('.update-user-button').on('click', function() {
        updateUser();
    })
})