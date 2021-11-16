var api = BASE + 'ad_api.php';

var gioi = { id : 0 }
var nganh = { id: 0 }
var lop = { id: 0 }
var bo = { id : 0 }
var ho = { id: 0 }


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
                icon_see.className = "far fa-eye icon-see-bo mr-2 rounded-0";  
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
                    getListGioi('.add-bo-gioi-select');
                    $('.add-ho').hide();
                    $('.add-bo').show();
                    $('.ho-page-modal-add-bo-button-add').hide();
                    $('.ho-page-modal-add-bo-button-update').show();
                    getInfoBoById(json.data.bo[i].id);

                }

                var icon_delete1 = document.createElement('i');
                icon_delete1.setAttribute('title', 'Xóa');
                icon_delete1.className ="far fa-trash-alt text-danger icon-delele-bo rounded-0";
                icon_delete1.onclick = function() {
                    var btnDeleteBo = document.createElement("button");
                    btnDeleteBo.className = "btn btn-danger btn-sm rounded-0 mr-2";
                    btnDeleteBo.innerHTML = "Xóa";
                    btnDeleteBo.onclick = function() {
                        deleteBo(json.data.bo[i].id);
                    }
                    showNotiForDelete('Nếu xóa bộ thì các họ, động vật thuộc bộ này sẽ bị xóa.<br>'
                        + 'Bạn có muốn xóa bộ <b>"' + json.data.bo[i].ten + '"</b> không?',
                        btnDeleteBo,
                        '.ho-noti-content-delete',
                        '.ho-page-show-dialog-delete'
                    );
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
                
            showNoti("Xóa bộ thành công", '.ho-noti-content', '.ho-page-show-dialog');
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
        getListGioi('.add-bo-gioi-select');
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
            + 'Bạn có muốn xóa họ <b>"' + item.ten + '"</b> không?',
            btnDeleteHo,
            '.ho-noti-content-delete',
            '.ho-page-show-dialog-delete'
        );
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
function getNganhByGioiID(gioi_id, el_select) {
    return new Promise(function(resolve, reject){
        if (gioi_id != null && gioi_id != "" && gioi_id != undefined && gioi_id > 0) {
            myPost('get-nganh-by-gioi-id', 'gioi_id=' + gioi_id, function(json) {
                if (json.status == 'OK') {
                    $(el_select).text("");
                    var op = document.createElement('option');
                    op.innerHTML = "-- Chọn --";
                    $(el_select).append(op);
                    for (let i in json.data) {
                        var op = document.createElement('option');
                        op.innerHTML = json.data[i].ten;
                        op.setAttribute('value', json.data[i].id);
                        $(el_select).append(op);
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
function getListGioi(el_select) {
    return new Promise(function(resolve, reject){
        myPost('get-list-gioi', '', function(json) {
            if (json.status == 'OK') {
                $(el_select).text("");
                var op = document.createElement('option');
                op.innerHTML = "-- Chọn --";
                op.setAttribute('value', "");
                $(el_select).append(op);
                
                for (let i in json.data) {
                    var op = document.createElement('option');
                    op.innerHTML = json.data[i].ten;
                    op.setAttribute('value', json.data[i].id);
                    $(el_select).append(op);
                }
                resolve(json);
            } else {
                reject('');
            }
        })
    })
}

function getListNganh(el_select) {
    return new Promise(function(resolve, reject){
        myPost('get-list-nganh', '', function(json) {
            if (json.status == 'OK') {
                $(el_select).text("");
                var op = document.createElement('option');
                op.innerHTML = "-- Chọn --";
                op.setAttribute('value', "");
                $(el_select).append(op);
                
                for (let i in json.data) {
                    var op = document.createElement('option');
                    op.innerHTML = json.data[i].ten;
                    op.setAttribute('value', json.data[i].id);
                    $(el_select).append(op);
                }
                resolve(json);
            } else {
                reject('');
            }
        })
    })
}

// Thêm bộ
function addBo() {
    var bo = $('#ho-page-modal-add-bo .bo_name').val();
    var gioi = $('.add-bo-gioi-select').val();
    var nganh = $('.add-bo-nganh-select').val();
    var lop = $('.add-bo-lop-select').val();

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
    var nganh = $('.add-bo-nganh-select').val();
    var lop = $('.add-bo-lop-select').val();
    var bo = $('.add-ho-bo-select').val();
    var ho = $('.ho_name').val();
    
    if (gioi == "" || nganh == "" || lop == "" || bo == "" || ho == "") {
        console.log("Nhập đủ thông tin");
        return;
    }
    myPost("add-ho", "bo_id=" + bo + "&ho=" + ho, function(json) {
        if (json.status == "OK") {
            $('.ho-page-modal-add-bo-button-close').click();
            showNoti("Thêm họ thành công", '.ho-noti-content', '.ho-page-show-dialog');
            getListHo();
        } else {
            $('.add-bo-error').text(json.error);
        }
    })
}

// Lấy thông tin bộ theo id bộ
function getInfoBoById(bo_id) {
    bo.id = bo_id;
    myPost("get-info-bo-by-id", "bo_id=" + bo_id, function(json) {
        if (json.status == "OK") {
            $('.add-bo-gioi-select option[value=' + json.data.gioi.id +']').attr('selected','selected');
            getNganhByGioiID(json.data.gioi.id, '.add-bo-nganh-select').then(function() {
                $('.add-bo-nganh-select option[value=' + json.data.nganh.id +']').attr('selected','selected');
            });
            
            getLopByNganhID(json.data.nganh.id).then(function(){
                $('.add-bo-lop-select option[value=' + json.data.lop.id +']').attr('selected','selected');
            });
            $('.bo_name').val(json.data.bo.ten);
        }
    })
}

function showNoti(strNoti, el_content, el_click) {
    $(el_content).text("");
    var div = document.createElement("div");
    var button = document.createElement("button");
    var text = document.createElement("div");
    text.innerHTML = strNoti;
    div.className = "text-right";
    
    button.className = "btn btn-secondary btn-sm rounded-0";
    button.setAttribute("data-dismiss", "modal");
    button.innerHTML = "Đóng";
    
    div.append(button); 
    $(el_content).append(text, div);
    $(el_click).click();

}

function showNotiForDelete(strNoti, elButton, elContent, elClickShow) {
    $(elContent).text("");
    var div = document.createElement("div");
    var button = document.createElement("button");
    var text = document.createElement("div");

    text.innerHTML = strNoti;
    div.className = "text-right mt-2";
    button.className = "btn btn-secondary btn-sm rounded-0 ho-page-modal-delete-close";
    button.setAttribute("data-dismiss", "modal");
    button.innerHTML = "Đóng";
    div.append(elButton, button);

    $(elContent).append(text, div);
    $(elClickShow).click();
}

// Xóa họ
function deleteHo(ho_id) {
    if (ho_id > 0) {
        myPost("delete-ho", "ho_id=" + ho_id, function(json) {
            if (json.status == "OK") {
                console.log(json);
                $('.ho-page-modal-delete-close').click();
                getListHo();
                
                showNoti("Xóa họ thành công", '.ho-noti-content', '.ho-page-show-dialog');
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
                
                showNoti("Cập nhật bộ thành công", '.ho-noti-content', '.ho-page-show-dialog');
            }
        })
    }
}

// hiển thị thông tin họ
function showInfoHo(ho_id) {
    if (ho_id > 0) {
        ho.id = ho_id;
        myPost("get-info-ho", "ho_id=" + ho_id, function(json) {
            if (json.status == "OK") {
                $('.add-bo-gioi-select option[value=' + json.data.gioi.id +']').attr('selected','selected');

                getNganhByGioiID(json.data.gioi.id, '.add-bo-nganh-select').then(function() {
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
                
                showNoti("Cập nhật họ thành công", '.ho-noti-content', '.ho-page-show-dialog');
            }
        })
    }
}

// Lấy danh sách giới ngành lớp
function getGioiNganhLopList() {
    myPost("get-gioi-nganh-lop", "", function(json) {
        if (json.status == "OK") {
            $(".gioi-list").text("");
            $(".nganh-list").text("");
            $(".lop-list").text("");

            for (let i in json.data.gioi) {
                createItemGioi(json.data.gioi[i]);
            }

            for (let i in json.data.nganh) {
                createItemNganh(json.data.nganh[i]);
            }

            for (let i in json.data.lop) {
                createItemLop(json.data.lop[i]);
            }
        }
    })
}

function createItemGioi(item) {
    var tr = document.createElement("tr");
    var tdname = document.createElement("td");
    var td = document.createElement("td");
    var icon_delete = document.createElement("i");
    var icon_update = document.createElement("i");
    var icon_see = document.createElement("i");

    icon_delete.className = "far fa-trash-alt text-danger";
    icon_delete.onclick = function() {
        var btnDeleteGioi = document.createElement("button");
        btnDeleteGioi.className = "btn btn-danger btn-sm rounded-0 mr-2";
        btnDeleteGioi.innerHTML = "Xóa";
        btnDeleteGioi.onclick = function() {
            deleteGioi(item.id);
        }
        showNotiForDelete('Nếu xóa giới thì các ngành, lớp, bộ, họ và động vật thuộc giới này sẽ bị xóa.<br>'
            + 'Bạn có muốn xóa họ <b>"' + item.ten + '"</b> không?',
            btnDeleteGioi,
            '.gioi-nganh-lop-noti-content-delete',
            '.gioi-nganh-lop-show-dialog-delete'
        );
    }

    icon_update.className = "fas fa-edit text-info mr-1";
    icon_update.setAttribute("data-toggle", "modal");
    icon_update.setAttribute("data-target", "#gioi-nganh-lop-modal-add-gioi");
    icon_update.onclick = function() {
        gioi.id = item.id;
        $('.gioi-nganh-lop-modal-add-gioi-button-add').hide();
        $('.gioi-nganh-lop-modal-add-gioi-button-update').show();
        $(".add-gioi-name").val(item.ten);
    }

    icon_see.className = "far fa-eye mr-1";
    td.className = "text-right";
    icon_see.onclick = function() {
        seeNganhInGioi(item.id);
    }

    tdname.innerHTML = item.ten;
    td.append(icon_see, icon_update, icon_delete);
    tr.append(tdname, td);
    $(".gioi-list").append(tr);
}

function createItemNganh(item) {
    var tr = document.createElement("tr");
    var tdname = document.createElement("td");
    var td = document.createElement("td");
    var icon_delete = document.createElement("i");
    var icon_update = document.createElement("i");
    var icon_see = document.createElement("i");

    icon_delete.className = "far fa-trash-alt text-danger";
    icon_delete.onclick = function() {
        var button = document.createElement("button");
        button.className = "btn btn-danger btn-sm rounded-0 mr-2";
        button.innerHTML = "Xóa";
        button.onclick = function() {
            deleteNganh(item.id);
        }
        var str = "Xóa ngành thì tất cả các lớp, bộ, họ và động vật thuộc ngành này sẽ bị xóa.<br>" + 
            "Bạn có muốn xóa ngành '<b>" + item.ten + "'</b> không?";
        showNotiForDelete(str, button,
            ".gioi-nganh-lop-noti-content-delete",
            ".gioi-nganh-lop-show-dialog-delete");
    }
    icon_update.className = "fas fa-edit text-info mr-1";
    icon_update.setAttribute("data-toggle", "modal");
    icon_update.setAttribute("data-target", "#gioi-nganh-lop-modal-add-nganh-lop");
    icon_see.className = "far fa-eye mr-1";

    icon_see.onclick = function() {
        seeLopInNganh(item.id);
    }

    icon_update.onclick = function() {
        $('.add-nganh').show();
        $('.add-lop').hide();
        $('.gioi-nganh-lop-modal-add-nganh-button-update').show();
        $('.gioi-nganh-lop-modal-add-nganh-button-add').hide();

        $('.nganh-name-input').val(item.ten);
        getListGioi(".gioi-name-select").then(function() {
            $('.gioi-name-select option[value=' + item.gioi_id + ']').attr("selected", "selected");
        });

        nganh.id= item.id;
    }

    tdname.innerHTML = item.ten;
    td.className = "text-right";
    td.append(icon_see, icon_update, icon_delete);
    tr.append(tdname, td);
    $(".nganh-list").append(tr);
}

function createItemLop(item) {
    var tr = document.createElement("tr");
    var tdname = document.createElement("td");
    var td = document.createElement("td");
    var icon_delete = document.createElement("i");
    var icon_update = document.createElement("i");
    var icon_see = document.createElement("i");

    td.className = "text-right";
    icon_delete.className = "far fa-trash-alt text-danger";
    icon_delete.onclick = function() {
        var button = document.createElement("button");
        button.className = "btn btn-danger btn-sm rounded-0 mr-2";
        button.innerHTML = "Xóa";
        button.onclick = function() {
            deleteLop(item.id);
        }
        var str = "Xóa lớp thì tất cả các bộ, họ và động vật thuộc lớp này sẽ bị xóa.<br>" + 
            "Bạn có muốn xóa lớp '<b>" + item.ten + "'</b> không?";
        showNotiForDelete(str, button,
            ".gioi-nganh-lop-noti-content-delete",
            ".gioi-nganh-lop-show-dialog-delete");
    }

    icon_update.className = "fas fa-edit text-info mr-1";
    icon_update.setAttribute("data-toggle", "modal");
    icon_update.setAttribute("data-target", "#gioi-nganh-lop-modal-add-nganh-lop");
    icon_update.onclick = function() {
        $('.add-nganh').hide();
        $('.add-lop').show();
        $('.gioi-nganh-lop-modal-add-lop-button-add').hide();
        $('.gioi-nganh-lop-modal-add-lop-button-update').show();
        lop.id = item.id;
        showInfoLopForUpdate(item);   
    }
    
    tdname.innerHTML = item.ten;
    td.append(icon_see, icon_update, icon_delete);
    tr.append(tdname, td);
    $(".lop-list").append(tr);
}


// xem các ngành trong giới
function seeNganhInGioi(gioi_id) {
    if (gioi_id > 0) {
        myPost("see-nganh-in-gioi", "gioi_id=" + gioi_id, function(json) {
            $(".nganh-list").text("");
            for (let i in json.data) {
                createItemNganh(json.data[i]);
            }
        })
    }
}

// xem các lớp trong ngành
function seeLopInNganh(nganh_id) {
    if (nganh_id > 0) {
        myPost("see-lop-in-nganh", "nganh_id=" + nganh_id, function(json) {
            $(".lop-list").text("");
            for (let i in json.data) {
                createItemLop(json.data[i]);
            }
        })
    }
}

// thêm giới
function addGioi() {
    var gioi = $('.add-gioi-name').val();
    if (gioi == "") {
        $('.add-gioi-error').text("Vui lòng nhập giới");
        return;
    }
    myPost("add-gioi", "gioi=" + gioi, function(json) {
        if (json.status == "OK") {
            $('.gioi-nganh-lop-modal-add-gioi-button-close').click();
            getGioiNganhLopList();
            showNoti("Thêm giới thành công", '.gioi-nganh-lop-noti-content', '.gioi-nganh-lop-show-dialog');
        } else {
            $('.add-gioi-error').text(json.error);
        }
    })
}

function updateGioi() {
    if (gioi.id > 0) {
        var gioi_name = $('.add-gioi-name').val();
        console.log(gioi_name);
        if (gioi_name == "") {
            $('.add-gioi-error').text("Vui lòng nhập giới");
            return;
        }
        myPost("update-gioi","gioi=" + gioi_name + "&gioi_id=" + gioi.id, function(json) {
            if (json.status == "OK") {
                $('.gioi-nganh-lop-modal-add-gioi-button-close').click();
                getGioiNganhLopList();
                showNoti("Cập nhật giới thành công", '.gioi-nganh-lop-noti-content', '.gioi-nganh-lop-show-dialog');
            }
        })
    }
}

function deleteGioi(gioi_id) {
    if (gioi_id > 0) {
        myPost("delete-gioi", "gioi_id=" + gioi_id, function(json) {
            if (json.status == "OK") {
                $('.ho-page-modal-delete-close').click();
                getGioiNganhLopList();
                showNoti("Xóa giới thành công", '.gioi-nganh-lop-noti-content', '.gioi-nganh-lop-show-dialog');
            }
        })
    }
}


// lấy thông in cho cập nhật lớp
function showInfoLopForUpdate(item) {
    $('.lop-name-input').val(item.ten);
    myPost("get-gioi-nganh-for-lop", "nganh_id=" + item.nganh_id, function(json) {
        if (json.status == "OK") {
            getListGioi(".gioi-name-select").then(function() {
                $('.gioi-name-select option[value=' + json.data.gioi.id + ']').attr("selected", "selected");
            });

            getListNganh(".nganh-name-select").then(function() {
                $('.nganh-name-select option[value=' + json.data.nganh.id + ']').attr("selected", "selected");
            })
        }
    })

}


// Thêm ngành
function addNganh() {
    var nganh_name = $('.nganh-name-input').val();
    var gioi = $('.gioi-name-select').val();
    
    if (nganh_name == "") {
        $('.add-nganh-lop-error').text("Vui lòng nhập ngành");
        return;
    }
    if (gioi > 0) {
        myPost("add-nganh", "gioi_id=" + gioi + "&nganh_name=" + nganh_name, function(json) {
            if (json.status == "OK") {
                $('.gioi-nganh-lop-modal-add-gioi-button-close').click();
                showNoti("Thêm ngành thành công", '.gioi-nganh-lop-noti-content', '.gioi-nganh-lop-show-dialog');
                getGioiNganhLopList();
            } else {
                $('.add-nganh-lop-error').text(json.error);
            }
        })
    }

}

// Thêm lớp
function addLop() {
    var gioi = $('.gioi-name-select').val();
    var nganh = $('.nganh-name-select').val();
    var lop_name = $('.lop-name-input').val();
    
    if (lop_name == "") {
        $('.add-nganh-lop-error').text("Vui lòng nhập lớp");
        return;
    }
    if (gioi > 0 && nganh > 0) {
        myPost("add-lop", "gioi_id=" + gioi + "&nganh_id=" + nganh + "&lop_name=" + lop_name, function(json) {
            if (json.status == "OK") {
                $('.gioi-nganh-lop-modal-add-gioi-button-close').click();
                showNoti("Thêm lớp thành công", '.gioi-nganh-lop-noti-content', '.gioi-nganh-lop-show-dialog');
                getGioiNganhLopList();
            } else {
                $('.add-nganh-lop-error').text(json.error);
            }
        })
    }
}

// Cập nhật ngành
function updateNganh() {
    var nganh_name = $('.nganh-name-input').val();
    var gioi_id = $('.gioi-name-select').val();
    if (nganh_name == "") {
        $('.add-nganh-lop-error').text("Ngành là bắt buộc");
    }
    if (gioi_id > 0 && nganh.id > 0) {
        myPost("update-nganh", "gioi_id=" + gioi_id + "&nganh_name=" + nganh_name + "&nganh_id=" + nganh.id, function(json) {
            if (json.status == "OK") {
                $('.gioi-nganh-lop-modal-add-gioi-button-close').click();   
                getGioiNganhLopList();
                showNoti("Cập nhật ngành thành công", '.gioi-nganh-lop-noti-content', '.gioi-nganh-lop-show-dialog');
            } else {
                $('.add-nganh-lop-error').text(json.error);
            }
        })
    }
}

// Xóa ngành
function deleteNganh(nganh_id) {
    if (nganh_id > 0) {
        myPost("delete-nganh", "nganh_id=" + nganh_id, function(json) {
            if (json.status == "OK") {
                $('.ho-page-modal-delete-close').click();
                getGioiNganhLopList();
                showNoti("Xóa ngành thành công", '.gioi-nganh-lop-noti-content', '.gioi-nganh-lop-show-dialog');
            } else {
                $('.add-nganh-lop-error').text(json.error);
            }
        })
    }
}

// Xóa lớp
function deleteLop(lop_id) {
    if (lop_id > 0) {
        myPost("delete-lop", "lop_id=" + lop_id, function(json) {
            if (json.status == "OK") {
                $('.ho-page-modal-delete-close').click();
                getGioiNganhLopList();
                showNoti("Xóa lớp thành công", '.gioi-nganh-lop-noti-content', '.gioi-nganh-lop-show-dialog');
            } else {
                $('.add-nganh-lop-error').text(json.error);
            }
        });
    }
}


// Cập nhật lớp
function updateLop() {
    var gioi = $('.gioi-name-select').val();
    var nganh = $('.nganh-name-select').val();
    var lop_name = $('.lop-name-input').val();
    
    if (lop_name == "") {
        $('.add-nganh-lop-error').text("Lớp là bắt buộc");
        return;
    }

    if (lop.id > 0 && gioi > 0 && nganh > 0) {
        myPost("update-lop", "lop_name=" + lop_name + "&lop_id=" + lop.id + "&nganh_id=" + nganh, function(json) {
            if (json.status == "OK") {
                $('.gioi-nganh-lop-modal-add-gioi-button-close').click();
                getGioiNganhLopList();
                showNoti("Cập nhật lớp thành công", '.gioi-nganh-lop-noti-content', '.gioi-nganh-lop-show-dialog');
            } else {
                $('.add-nganh-lop-error').text(json.error);
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

    getListGioi('.add-bo-gioi-select');

    $('.button-add-bo').on('click', function() {
        getListGioi('.add-bo-gioi-select');
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
        getListGioi('.add-bo-gioi-select');
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

    // Lấy danh sách giới ngành lớp
    getGioiNganhLopList();

    // Thêm giới
    $('.gioi-nganh-lop-modal-add-gioi-button-add').on('click', function() {
        addGioi();
    })

    $('.button-add-gioi').on('click', function() {
        $('.gioi-nganh-lop-modal-add-gioi-button-add').show();
        $('.gioi-nganh-lop-modal-add-gioi-button-update').hide();
    })

    $('.gioi-nganh-lop-modal-add-gioi-button-close').on("click", function() {
        $('.add-gioi-name').val("");
        $('.nganh-name-input').val("");
        $('.lop-name-input').val("");
        $('.add-gioi-error').text("");
    })

    $(".gioi-nganh-lop-modal-add-gioi-button-update").on('click', function() {
        updateGioi();
    })


    // Add ngành - lớp
    $('.button-add-nganh').on('click', function() {
        $('.add-nganh').show();
        $('.add-lop').hide();
        $('.gioi-nganh-lop-modal-add-nganh-button-update').hide();
        $('.gioi-nganh-lop-modal-add-nganh-button-add').show();
        getListGioi(".gioi-name-select");
    })

    $('.button-add-lop').on('click', function() {
        $('.add-lop').show();
        $('.add-nganh').hide();
        $('.gioi-nganh-lop-modal-add-lop-button-update').hide();
        $('.gioi-nganh-lop-modal-add-lop-button-add').show();
        getListGioi(".gioi-name-select");
        getListNganh(".nganh-name-select");
    })

    // Thêm ngành
    $('.gioi-nganh-lop-modal-add-nganh-button-add').on('click', function() {
        addNganh();
    })

    // Thêm lớp
    $('.gioi-nganh-lop-modal-add-lop-button-add').on('click', function() {
        addLop();
    })

    $('.gioi-nganh-lop-modal-add-gioi-button-close').on("click", function() {
        $('.add-nganh-lop-error').text("");
        gioi.id = 0;
        nganh.id= 0;
        lop.id= 0;
        bo.id = 0;
        ho.id= 0;
    })

    // Cập nhật ngành
    $('.gioi-nganh-lop-modal-add-nganh-button-update').on('click', function() {
        updateNganh();
    })

    $('.ho-page-modal-delete-close').on('click', function() {
        $('.gioi-nganh-lop-noti-content-delete').text("");
    })

    // Cập nhật lớp
    $('.gioi-nganh-lop-modal-add-lop-button-update').on('click', function() {
        updateLop();
    })

})