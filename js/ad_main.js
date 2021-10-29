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
    var checkEmpty = false;
    if (form.username.value == '') {
        $('.login-alert-username').show();
        checkEmpty = true;
    }

    if (form.password.value == '') {
        $('.login-alert-password').show();
        checkEmpty = true;
    }
    if (checkEmpty) {
        return;
    }

    var data = $(form).serialize();
    myPost('login', data, function(json) {
        if (json['status'] == 'OK') {
            window.location.reload();
        } else {
            $('.error-login').text(json['error']);
        }
    })
}

function logout() {
    // if (!confirm('Bạn có muốn đăng xuất?')) {
    //     return;
    // }
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
        $('.btn-group-modal-delete-user').text('');
        $('.text-modal-delete-user b').text(itemData.tenhienthi || itemData.tendangnhap);
        var btn_delete = document.createElement('button');
        btn_delete.className = "btn btn-danger btn-sm rounded-0 mr-2";
        btn_delete.innerHTML = "Xóa";

        var btn_cancel = document.createElement('button');
        btn_cancel.className = "btn btn-secondary btn-sm rounded-0 cancel-modal-delete-user";
        btn_cancel.setAttribute('data-dismiss', 'modal');
        btn_cancel.innerHTML = "Hủy";

        $('.btn-group-modal-delete-user').prepend(btn_delete, btn_cancel);
        btn_delete.onclick = function() {
            deleteUser(itemData.id);
            $('.cancel-modal-delete-user').click();
        }

        $('.toggle-delete-modal').click();
    }

    icon_delete.setAttribute('title', 'Xóa');
    icon_delete.className ="far fa-trash-alt text-danger icon-delele-user  rounded-0";

    var icon_update = document.createElement('i');
    icon_update.setAttribute('title', 'Cập nhật');
    icon_update.onclick = function() {
        getInfoUser(itemData.id);
    }
    icon_update.className ="fas fa-edit text-info icon-update-user mr-2 rounded-0";
    icon_update.setAttribute('data-toggle', 'modal');
    icon_update.setAttribute('data-target', '#update-user-modal');
    td.append(icon_update, icon_delete);

    tr.append(td_username, td_name, td_role, td_birthday, td_gender, td_phone, td_address, td_time, td);
    $('.list-users-body').append(tr);
}

// ---------------------- Xóa người dùng trong admin ----------------------
function deleteUser(user_id) {
    
    myPost('delete-user', 'user_id=' + user_id, function(json) {
        if (json.status == 'OK') {
            $('.list-users-body').text('');
            getListUsers();
            $('.users-noti-content').text('Xóa người dùng thành công!');
        } else {
            $('.users-noti-content').text(json.error);
        }
        $('.users-page-show-dialog').click();

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

            $('.update-user-gender input[name=gender]').filter('[value=' + json.data.gioitinh + ']').prop('checked', true);
            
            $('.user_role_list option[value=' + json.data.vaitro + ']').attr('selected','selected');
            user_update_id = id;
        }
    });
}

// ---------------------- Cập nhật người dùng trong admin ----------------------
function updateUser() {
    var form = document.forms['user-update-form'];

    if (form.username.value == '') {
        $('.update-user-username-alert').show();
        return;
    }

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
            getListUsers();

            $('.users-noti-content').text('Cập nhật thông tin người dùng thành công');
        } else {
            $('.users-noti-content').text(json.error);
        }
        $('.users-page-show-dialog').click();
    })
}

// ---------------------- Thêm người dùng mới trong admin ----------------------
function addUser(form) {
    var checkEmpty = false;
    if (form.username.value == '') {
        $('.user-form__username-alert').show();
        checkEmpty = true;
    }

    if (form.password.value == '') {
        $('.user-form__password-alert').show();
        checkEmpty = true;
    }

    if (checkEmpty) {
        return;
    }

    var data = $(form).serialize();
    console.log(data)
    myPost('add-user', data, function(json) {
        if (json['status'] == 'OK') {
            getListUsers();
            $('.user-form__button__reset').click();
            $('.close-modal-add-user').click();
            $('.users-noti-content').text('Thêm người dùng thành công!');

        } else {
            $('.users-noti-content').text(json.error);
        }
        $('.users-page-show-dialog').click();
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
                $('.account-noti-content').text('Cập nhật thông tin thành công');
            } else {
                $('.account-noti-content').text(json.error);
            }
            $('.account-page-show-dialog').click();
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

            // avt header
            $('.header-avt-user img').attr('src', BASE + json.data.anhdaidien);
            $('.header-account img').attr('src', BASE + json.data.anhdaidien);
            $('.header-account-name').text(json.data.tenhienthi)
            $('.header-account-username').text(json.data.tendangnhap)
            if (json['data']['gioitinh'] == 0) {
                $('.account_female').attr('checked', true);
            } else {
                $('.account_male').attr('checked', true);
            }

            if (json.data.vaitro == 'Editor') {
                $('.btn-add-user').attr('disabled', true);
                $('.icon-update-user').attr('disabled', true);
                $('.icon-delele-user').attr('disabled', true);
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
    var checkEmpty = false;
    if (password == '') {
        $('.change-password-old-password-alert').show();
        checkEmpty = true;
    }

    if (new_password == '') {
        $('.change-password-new-password-alert').show();
        checkEmpty = true;
    }

    if (re_new_password == '') {
        $('.change-password-check-new-password-alert').show();
        checkEmpty = true;
    }

    if (re_new_password != new_password && new_password != '') {
        $('.change-password-check-new-password-alert').text('Xác nhận mật khẩu mới sai!');
        $('.change-password-check-new-password-alert').show();
        checkEmpty = true;
    }

    if (checkEmpty) {
        return;
    }

    
    myPost('change-password-account', 'password=' + password + '&new-password=' + new_password, function(json) {
        if (json['status'] == 'OK') {
            console.log('changePassword');
            console.log(json);
            $('.account__left__btn-reset').click();
            $('.account-noti-content').text('Đổi mật khẩu thành công!');
            
        } else {
            $('.account-noti-content').text(json.error);
        }
       $('.account-page-show-dialog').click();
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


// Quên mật khẩu
function forgetPassword(form) {
    var data = $(form).serialize();
    var username = form.username.value;
    var new_password = form.new_password.value;
    var check_password = form.check_password.value;
    var checkEmpty = false;

    if (username == '') {
        $('.forget-alert-username').show();
        checkEmpty = true;
    }

    if (new_password == '') {
        $('.forget-alert-password').show();
        checkEmpty = true;
    }

    if (check_password == '') {
        $('.forget-alert-check-password').show();
        checkEmpty = true;
    }

    if (checkEmpty) {
        return;
    }

    if (new_password != check_password) {
        $('.forget-alert-check-password span').text('Xác nhận mật khẩu không đúng!');
        $('.forget-alert-check-password').css('display', 'block');
        checkEmpty = true;
    }

    if (!checkEmpty) {
        myPost('forget-password', data, function(json) {
            if (json.status == 'OK') {
                $('.login-back').click();
            } else {
                $('.error-change-password').text(json.error);
            }
        })
    }
}

function updateInfoInstall(form) {
    var website_name = form.website_name.value || '';
    var footer_info = form.footer_info.value || '';

    if (website_name == '') {
        return;
    }

    if (footer_info == '') {
        return;
    }

    var favicon = $('#install-favicon')[0].files[0] || '';
    var formData = new FormData();
    formData.append('action', 'update-info-install');
    formData.append('website_name', website_name);
    formData.append('footer_info', footer_info);
    formData.append('favicon', favicon);

    $.ajax({
        type: 'POST',
        cache: false,
        url: api,
        data: formData,
        dataType: 'json',
        contentType: false,
        processData: false,
    }).done(function(json) {
        if (json.status == 'OK') {
            location.reload();
        } else {
            alert(json.error);
        }
    })
}

function getInfoInstall() {
    myPost('get-info-install', '', function(json) {
        if (json.status == 'OK') {
            $('.website_name').val(json.data['tenwebsite']);
            $('.footer_info').val(json.data['thongtinfooter']);
            $('.install-favicon-preview').attr('src', BASE + json.data['favicon']);
        } else {
            alert(json.error);
        }
    })
}


$(function() {

    $('.website_name').on('keyup', function() {
        if ($('.website_name').val() == '') {
            $('.website-name-error').text('Tên website là bắt buộc');
        } else {
            $('.website-name-error').text('');
        }
    })

    $('.footer_info').on('keyup', function() {
        if ($('.footer_info').val() == '') {
            $('.footer-info-error').text('Thông tin footer là bắt buộc');
        } else {
            $('.footer-info-error').text('');
        }
    })

    // scrollTop
    $('.layout-right-content-details').scroll(function () {
        if ($('.layout-right-content-details').scrollTop() > 30) {
            $('#back-to-top').fadeIn();
        } else {
            $('#back-to-top').fadeOut();
        }
    });
    
    $('#back-to-top').on('click', function () {
        $('.layout-right-content-details').animate({
            scrollTop: 0
        }, 400);
        return false;
    });
    
    getListUsers();
    $('form').on('click', '#login_submit', function() {
        login(this.form);
        return false;
    })

    $('#logout').on('click', function() {
        $('.btn-group-logout').text('');
        var btn_logout = document.createElement('button');
        btn_logout.className = "btn btn-danger btn-sm rounded-0 mr-2";
        btn_logout.innerHTML = "Đăng xuất";
        btn_logout.onclick = function() {
            logout();
        }

        var btn_cancel = document.createElement('button');
        btn_cancel.className = "btn btn-secondary btn-sm rounded-0 cancel-modal-logout";
        btn_cancel.setAttribute('data-dismiss', 'modal');
        btn_cancel.innerHTML = "Hủy";

        $('.btn-group-logout').prepend(btn_logout, btn_cancel);
    })

    $('form').on('click', '.user-form__button__add', function() {
        addUser(this.form);
        return false;
    })

    //----------------------------------------- ACCOUNT PAGE --------------------------------
    $('.icon-edit-avt').on('click', function() {
        $('.account__info__left--avt-file').click();
    })

    $('.account__info__left--avt-file').change(function() {
        var avt = $('#account__info__left--avt-file')[0].files[0];
        var previewAvatar = URL.createObjectURL(avt);
        $('.account__info__left--avt img').attr('src', previewAvatar);
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

    // Quên mật khẩu
    $('.go-forget-password').on('click', function() {
        $('.forget-password-form').show();
        $('.login-form').hide();
        $('#login_username').val('')
        $('#login_password').val('')
    })
    $('.login-back').on('click', function() {
        $('.forget-password-form').hide();
        $('.login-form').show();
        $('#forget_username').val('')
        $('#forget_new_password').val('')
        $('#forget_check_password').val('')
    })

    $('form').on('click', '#forget_password_submit', function() {
        forgetPassword(this.form);
        return false;
    })

        // login close
    $('#login_username').on('keyup', function() {
        if ($('#login_username').val() == '') {
            $('.login-alert-username').show();
        } else {
            $('.login-alert-username').hide();
        }
    })

    $('#login_password').on('keyup', function() {
        if ($('#login_password').val() == '') {
            $('.login-alert-password').show();
        } else {
            $('.login-alert-password').css('display', 'none');
        }
    })

    $('#forget_username').on('keyup', function() {
        if ($('#forget_username').val() == '') {
            $('.forget-alert-username').show();
        } else {
            $('.forget-alert-username').hide();
        }
    })

    $('#forget_new_password').on('keyup', function() {
        if ($('#forget_new_password').val() == '') {
            $('.forget-alert-password').show();
        } else {
            $('.forget-alert-password').hide();
        }
    })

    $('#forget_check_password').on('keyup', function() {
        if ($('#forget_check_password').val() == '') {
            $('.forget-alert-check-password').show();
        } else {
            $('.forget-alert-check-password').hide();
        }
    })

    // acount admin
    $('.profile-details-info--username').on('keyup', function() {
        if ($('.profile-details-info--username').val() == '') {
            $('.profile-details-info--username-alert').show();
        } else {
            $('.profile-details-info--username-alert').hide();
        }
    })

        // update password account admin
    $('.account__info__right__form--password').on('keyup', function() {
        if ($('.account__info__right__form--password').val() == '') {
            $('.change-password-old-password-alert').show();
        } else {
            $('.change-password-old-password-alert').hide();
        }
    })

    $('.account__info__right__form--new_password').on('keyup', function() {
        if ($('.account__info__right__form--new_password').val() == '') {
            $('.change-password-new-password-alert').show();
        } else {
            $('.change-password-new-password-alert').hide();
        }
    })

    $('.account__info__right__form--re_new_password').on('keyup', function() {
        if ($('.account__info__right__form--re_new_password').val() == '') {
            $('.change-password-check-new-password-alert').show();
        } else {
            $('.change-password-check-new-password-alert').hide();
        }
    })

    // UPDATE USER
    $('.user-form__username').on('keyup', function() {
        if($('.user-form__username').val() == '') {
            $('.user-form__username-alert').show();
        } else {
            $('.user-form__username-alert').hide();
        }
    })

    $('.user-form__password').on('keyup', function() {
        if($('.user-form__password').val() == '') {
            $('.user-form__password-alert').show();
        } else {
            $('.user-form__password-alert').hide();
        }
    })

    $('.update-user-username').on('keyup', function() {
        if($('.update-user-username').val() == '') {
            $('.update-user-username-alert').show();
        } else {
            $('.update-user-username-alert').hide();
        }
    })

    var checkBars = false;
    $('#icon-bars').on('click', function() {
        if (!checkBars) {
            $('.layout-left').css('left', '0px');
        } else {
            $('.layout-left').css('left', '-230px');
        }
        checkBars = !checkBars;
    })

    $('form').on('click', '.install-btn-submit', function() {
        updateInfoInstall(this.form);
        return false;
    })

    getInfoInstall();

    $('.install-btn-change-favicon').on('click', function() {
        $('#install-favicon').click();
    })

    $('#install-favicon').change(function() {
        var avt = $('#install-favicon')[0].files[0];
        var previewAvatar = URL.createObjectURL(avt);
        $('.install-favicon-preview').attr('src', previewAvatar);
    })
})