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


// Lấy danh sách họ
function getListHo() {
    myPost('get-list-ho', '', function(json) {
        if (json.status == 'OK') {
            $('.bo-list').text("");
            for (let i in json.data.bo) {
                var tr_bo = document.createElement('tr');
                var td1 = document.createElement('td');
                var td_bo = document.createElement('td');
                td_bo.innerHTML = json.data.bo[i].ten;
                
                var icon_see = document.createElement('i');
                icon_see.setAttribute('title', "Xem");
                icon_see.className = "fas fa-eye icon-see-bo mr-2 rounded-0";  
                icon_see.onclick = function() {
                    $('.ho h4').text("Danh sách họ của bộ '" + json.data.bo[i].ten + "'");
                    getListHoByBoID(json.data.bo[i].id);
                }

                var icon_update1 = document.createElement('i');
                icon_update1.setAttribute('title', 'Cập nhật');
                icon_update1.className ="fas fa-edit text-info icon-update-bo mr-2 rounded-0";
                icon_update1.setAttribute("data-toggle", "modal");
                icon_update1.setAttribute("data-target", "#ho-page-modal-add-bo");
                icon_update1.onclick = function() {
                    $('.ho-page-modal-add-bo-button-add').css('display', 'none');
                    $('.ho-page-modal-add-bo-button-update').css('display', 'block');
                    getInfoBoById(json.data.bo[i].id);

                }

                var icon_delete1 = document.createElement('i');
                icon_delete1.setAttribute('title', 'Xóa');
                icon_delete1.className ="far fa-trash-alt text-danger icon-delele-bo rounded-0";
                icon_delete1.onclick = function() {
                    // $('.ho-noti-content').text("");
                    // var div = document.createElement('div');
                    // var button = document.createElement("button");
                    // var button_close = document.createElement("button");
                    // var div_button = document.createElement("div");

                    // button.className = "btn btn-danger btn-sm rounded-0 mr-2";
                    // button.innerHTML = "Xóa";
                    // button.onclick = function() {
                    //     deleteBo(json.data.bo[i].id);
                    //     button_close.click();
                    // }

                    // button_close.innerHTML = "Hủy";
                    // button_close.className = "btn btn-secondary btn-sm rounded-0";
                    // button_close.setAttribute("data-dismiss", "modal");

                    // div.innerHTML = "Khi xóa bộ các họ và động vật tương ứng sẽ bị xóa.<br>Bạn muốn xóa <b>"
                    //     + json.data.bo[i].ten + "</b> không?"
                    
                    // div_button.className = "text-right mt-1";
                    // div_button.append(button, button_close);

                    // $('.ho-noti-content').append(div, div_button);
                    // $('.ho-page-show-dialog').click();

                    var btnDeleteBo = document.createElement("button");
                    btnDeleteBo.className = "btn btn-danger btn-sm rounded-0 mr-2";
                    btnDeleteBo.innerHTML = "Xóa";
                    btnDeleteBo.onclick = function() {
                        deleteBo(json.data.bo[i].id);
                    }
                    showNotiForDelete('Nếu xóa bộ thì các họ, động vật thuộc bộ này sẽ bị xóa.<br>'
                    + 'Bạn có muốn xóa bộ <b>"' + json.data.bo[i].ten + '"</b> không?', btnDeleteBo);
                }

                td1.className = "text-right";
                td1.append(icon_see, icon_update1, icon_delete1);

                tr_bo.append(td_bo, td1);
                $('.bo-list').append(tr_bo);
            }
            for (let i in json.data.ho) {
                createItemHo(json.data.ho[i]);
            }
        } else {
            return "";
        }
    })
}

// Xóa bộ
function deleteBo(bo_id) {
    myPost("delete-bo", "bo_id=" + bo_id, function(json) {
        if (json.status == "OK") {
            $('.ho-page-modal-delete-close').click();
            getListHo();
                
            showNoti("Xóa bộ thành công");
        }
    })
}

// Lấy danh sách họ theo id bộ
function getListHoByBoID(bo_id) {
    if (bo_id != null && bo_id != "" && bo_id != undefined && bo_id > 0) {
        myPost('get-list-ho-by-bo-id', 'bo_id=' + bo_id, function(json) {
            if (json.status == 'OK') {
                $('.ho-list').text("");
                for (let i in json.data) {
                    createItemHo(json.data[i]);
                }
            }
        })
    }
}

function createItemHo(item) {
    var tr_ho = document.createElement('tr');
    var td2 = document.createElement('td');
    var td_ho = document.createElement('td');
    
    td_ho.innerHTML = item.ten;
    
    var icon_update2 = document.createElement('i');
    icon_update2.setAttribute('title', 'Cập nhật');
    icon_update2.className ="fas fa-edit text-info icon-update-ho mr-2 rounded-0";
    icon_update2.setAttribute("data-toggle", "modal");
    icon_update2.setAttribute("data-target", "#ho-page-modal-add-bo");
    icon_update2.onclick = function() {
        showInfoHo(item.id);
        $('.ho-page-modal-add-ho-button-add').hide();
        $('.ho-page-modal-add-ho-button-update').show();
        $('.add-bo').hide();
        $('.add-ho').show();
    }

    var icon_delete2 = document.createElement('i');
    icon_delete2.setAttribute('title', 'Xóa');
    icon_delete2.className ="far fa-trash-alt text-danger icon-delele-ho  rounded-0";
    icon_delete2.onclick = function() {
        var btnDeleteHo = document.createElement("button");
        btnDeleteHo.className = "btn btn-danger btn-sm rounded-0 mr-2";
        btnDeleteHo.innerHTML = "Xóa";
        btnDeleteHo.onclick = function() {
            deleteHo(item.id);
        }
        showNotiForDelete('Nếu xóa họ thì các động vật thuộc họ này sẽ bị xóa.<br>'
        + 'Bạn có muốn xóa họ <b>"' + item.ten + '"</b> không?', btnDeleteHo);
    }
    td2.className = "text-right";
    td2.append(icon_update2, icon_delete2);

    tr_ho.append(td_ho, td2);
    $('.ho-list').append(tr_ho);
}

// Lấy danh sách bộ theo id lớp
function getBoByLopID(lop_id) {
    return new Promise(function(resolve, reject) {
        if (lop_id != null && lop_id != "" && lop_id != undefined && lop_id > 0) {
            myPost('get-bo-by-lop-id', 'lop_id=' + lop_id, function(json) {
                console.log(json);
                if (json.status == 'OK') {
                    $('.add-ho-bo-select').text("");
                    var op = document.createElement('option');
                    op.innerHTML = "-- Chọn --";
                    op.setAttribute('value', "");
                    $('.add-ho-bo-select').append(op);
                    for (let i in json.data) {
                        var op = document.createElement('option');
                        op.innerHTML = json.data[i].ten;
                        op.setAttribute('value', json.data[i].id);
                        $('.add-ho-bo-select').append(op);
                    }
                    resolve(json);
                } else {
                    reject('');
                }
            })
        }
    })
    
}

// Lấy danh sách lớp theo ngành id
function getLopByNganhID(nganh_id) {
    return new Promise(function(resolve, reject){
        if (nganh_id != null && nganh_id != "" && nganh_id != undefined && nganh_id > 0) {
            myPost('get-lop-by-nganh-id', 'nganh_id=' + nganh_id, function(json) {
                if (json.status == 'OK') {
                    $('.add-bo-lop-select').text("");
                    var op = document.createElement('option');
                    op.innerHTML = "-- Chọn --";
                    op.setAttribute('value', "");
                    $('.add-bo-lop-select').append(op);
                    for (let i in json.data) {
                        var op = document.createElement('option');
                        op.innerHTML = json.data[i].ten;
                        op.setAttribute('value', json.data[i].id);
                        $('.add-bo-lop-select').append(op);
                    }

                    resolve(json);
                } else {
                    reject('');
                }
            })
        }
    })
}

// Lấy danh sách ngành theo giới id
function getNganhByGioiID(gioi_id) {
    return new Promise(function(resolve, reject){
        if (gioi_id != null && gioi_id != "" && gioi_id != undefined && gioi_id > 0) {
            myPost('get-nganh-by-gioi-id', 'gioi_id=' + gioi_id, function(json) {
                if (json.status == 'OK') {
                    $('.add-bo-nganh-select').text("");
                    var op = document.createElement('option');
                    op.innerHTML = "-- Chọn --";
                    $('.add-bo-nganh-select').append(op);
                    for (let i in json.data) {
                        var op = document.createElement('option');
                        op.innerHTML = json.data[i].ten;
                        op.setAttribute('value', json.data[i].id);
                        $('.add-bo-nganh-select').append(op);
                    }
                    resolve(json);
                } else {
                    reject('');
                }
            })
        }
    })
}

// Lấy danh sách giới
function getListGioi() {
    myPost('get-list-gioi', '', function(json) {
        if (json.status == 'OK') {
            $('.add-bo-gioi-select').text("");
            var op = document.createElement('option');
            op.innerHTML = "-- Chọn --";
            op.setAttribute('value', "");
            $('.add-bo-gioi-select').append(op);
            
            for (let i in json.data) {
                var op = document.createElement('option');
                op.innerHTML = json.data[i].ten;
                op.setAttribute('value', json.data[i].id);
                $('.add-bo-gioi-select').append(op);
            }
        }
    })
}


// Thêm bộ
function addBo() {
    var bo = $('#ho-page-modal-add-bo .bo_name').val();
    var gioi = $('.add-bo-gioi-select').val();
    var nganh = $('.add-bo-gioi-select').val();
    var lop = $('.add-bo-gioi-select').val();
    if (gioi == "" || nganh == "" || lop == "" || bo == "") {
        console.log("Nhập đủ thông tin");
        return;
    }

    myPost("add-bo", 'lop=' + lop + '&bo=' + bo, function(json) {
        if (json.status == "OK") {
            $('.ho-page-modal-add-bo-button-close').click();
            $('.ho-noti-content').text("");
            var button = document.createElement("button");
            var div_1 = document.createElement("div");
            div_1.className = "text-right";
            button.className = "btn btn-secondary btn-sm rounded-0 mt-2";
            button.setAttribute("data-dismiss", "modal");
            button.innerHTML = "Đóng";
            div_1.append(button);
            var div = document.createElement("div");
            div.innerHTML = "Thêm bộ thành công";
            $('.ho-noti-content').append(div, div_1);
            $('.ho-page-show-dialog').click();

            $('.bo_name').val("");
            getListHo();
        } else {
            $('.add-bo-error').text(json.error);
        }
    })
}

// Thêm họ
function addHo() {
    var gioi = $('.add-bo-gioi-select').val();
    var nganh = $('.add-bo-gioi-select').val();
    var lop = $('.add-bo-gioi-select').val();
    var bo = $('.add-ho-bo-select').val();
    var ho = $('.ho_name').val();
    
    if (gioi == "" || nganh == "" || lop == "" || bo == "" || ho == "") {
        console.log("Nhập đủ thông tin");
        return;
    }
    myPost("add-ho", "bo_id=" + bo + "&ho=" + ho, function(json) {
        if (json.status == "OK") {
            $('.ho-page-modal-add-bo-button-close').click();
            showNoti("Thêm họ thành công");
            getListHo();
        } else {
            $('.add-bo-error').text(json.error);
        }
    })
}


var bo = {
    id : 0
}
// Lấy thông tin bộ theo id bộ
function getInfoBoById(bo_id) {
    bo.id = bo_id;
    myPost("get-info-bo-by-id", "bo_id=" + bo_id, function(json) {
        if (json.status == "OK") {
            $('.add-bo-gioi-select option[value=' + json.data.gioi.id +']').attr('selected','selected');
            getNganhByGioiID(json.data.gioi.id).then(function() {
                $('.add-bo-nganh-select option[value=' + json.data.nganh.id +']').attr('selected','selected');
            });
            
            getLopByNganhID(json.data.nganh.id).then(function(){
                $('.add-bo-lop-select option[value=' + json.data.lop.id +']').attr('selected','selected');
            });
            $('.bo_name').val(json.data.bo.ten);
        }
    })
}

function showNoti(strNoti) {
    $('.ho-noti-content').text("");
    var div = document.createElement("div");
    var button = document.createElement("button");
    var text = document.createElement("div");
    text.innerHTML = strNoti;
    div.className = "text-right";
    button.className = "btn btn-secondary btn-sm rounded-0";
    button.setAttribute("data-dismiss", "modal");
    button.innerHTML = "Đóng";
    div.append(button);
    $('.ho-noti-content').append(text, div);
    $('.ho-page-show-dialog').click();
}

function showNotiForDelete(strNoti, elButton) {
    $('.ho-noti-content-delete').text("");
    var div = document.createElement("div");
    var button = document.createElement("button");
    var text = document.createElement("div");

    text.innerHTML = strNoti;
    div.className = "text-right mt-2";
    button.className = "btn btn-secondary btn-sm rounded-0 ho-page-modal-delete-close";
    button.setAttribute("data-dismiss", "modal");
    button.innerHTML = "Đóng";
    div.append(elButton, button);

    $('.ho-noti-content-delete').append(text, div);
    $('.ho-page-show-dialog-delete').click();
}

// Xóa họ
function deleteHo(ho_id) {
    if (ho_id > 0) {
        myPost("delete-ho", "ho_id=" + ho_id, function(json) {
            if (json.status == "OK") {
                console.log(json);
                $('.ho-page-modal-delete-close').click();
                getListHo();
                
                showNoti("Xóa họ thành công");
            }
        })
    }
}

// Cập nhật bộ
function updateBo() {
    if (bo.id > 0) {
        var lop_id = $('.add-bo-lop-select').val();
        var bo_name = $('.bo_name').val();
        myPost("update-bo", "lop_id=" + lop_id + "&bo_id=" + bo.id + "&bo_name=" + bo_name, function(json) {
            if (json.status == 'OK') {
                $('.bo_name').val("");
                getListHo();
                $('.ho-page-modal-add-bo-button-close').click();
                
                showNoti("Cập nhật thành công");
            }
        })
    }
}

// hiển thị thông tin họ
var ho = {
    id: 0
}
function showInfoHo(ho_id) {
    if (ho_id > 0) {
        ho.id = ho_id;
        myPost("get-info-ho", "ho_id=" + ho_id, function(json) {
            if (json.status == "OK") {
                $('.add-bo-gioi-select option[value=' + json.data.gioi.id +']').attr('selected','selected');

                getNganhByGioiID(json.data.gioi.id).then(function() {
                    $('.add-bo-nganh-select option[value=' + json.data.nganh.id +']').attr('selected','selected');
                });
                
                getLopByNganhID(json.data.nganh.id).then(function(){
                    $('.add-bo-lop-select option[value=' + json.data.lop.id +']').attr('selected','selected');
                });

                getBoByLopID(json.data.lop.id).then(function(){
                    $('.add-ho-bo-select option[value=' + json.data.bo.id +']').attr('selected','selected');
                });
                $('.ho_name').val(json.data.ho.ten);
            }
        })
    }
}

// Cập nhật bộ
function updateHo() {
    if (ho.id > 0) {
        var bo_id = $('.add-ho-bo-select').val();
        var ho_name = $('.ho_name').val();
        myPost("update-ho", "bo_id=" + bo_id + "&ho_id=" + ho.id + "&ho_name=" + ho_name, function(json) {
            if (json.status == 'OK') {
                $('.ho_name').val("");
                getListHo();
                $('.ho-page-modal-add-bo-button-close').click();
                
                showNoti("Cập nhật thành công");
            }
        })
    }
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

    // Lấy danh sách họ động vật cùng các thông tin bộ, lớp, ngành, giới
    getListHo();

    getListGioi();

    $('.button-add-bo').on('click', function() {
        $('.ho-page-modal-add-bo-button-add').css('display', 'block');
        $('.ho-page-modal-add-bo-button-update').css('display', 'none');
        $('.add-bo').show();
        $('.add-ho').hide();
    })
    // thêm 1 bộ
    $('.ho-page-modal-add-bo-button-add').on('click', function() {
        addBo();
    })

    $('.ho-page-modal-add-bo-button-update').on('click', function() {
        updateBo();
    })

    $('.button-add-ho').on('click', function() {
        $('.ho-page-modal-add-ho-button-add').show();
        $('.ho-page-modal-add-ho-button-update').hide();
        $('.add-bo').hide();
        $('.add-ho').show();
    })
    // Thêm họ
    $('.ho-page-modal-add-ho-button-add').on('click', function() {
        addHo();
    })

    // Cập nhật họ
    $('.ho-page-modal-add-ho-button-update').on('click', function() {
        updateHo();
    })

    // Đặt lại form add-update ho-bo
    $('.ho-page-modal-add-bo-button-close').on('click', function() {
        $('.add-bo-gioi-select').text("");
        $('.add-bo-nganh-select').text("");
        $('.add-bo-lop-select').text("");
        $('.add-bo-bo-select').text("");
        $('.bo_name').text("");
        $('.ho_name').text("");
        ho.id = 0;
        bo.id = 0;
        $('.add-bo-error').text("");
    })

})