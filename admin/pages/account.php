<?php 

// include '../../config.php';

include '../layout/header-only.php';

?>

<?php if (empty($_SESSION['user'])): ?>
    <?php header('Location:' . BASE . 'admin') ?>
<?php else: ?>
    <div id="account-page">
        <div class="layout-wrap">
            <div class="layout-left">
                <!-- <div class="account__left"> -->
                    <?php include '../layout/menu-left.php'; ?>
                <!-- </div> -->
            </div>
            <div class="layout-right">
                <div class="layout-right-header">
                    <?php  include '../layout/header.php';  ?>
                </div>
                <div class="layout-right-content">
                    <div class="layout-right-content-details">
                        <div class="account__right p-3">
                            <div class="account__right__info">
                                <div class="row">
                                    <div class="col-md-2 col-sm-5 col-xs-12 mb-2">
                                        <div class="account__info__left--avt">
                                            <img src="" alt="">
                                            <i class="fas fa-edit  icon-edit-avt" title="Thay đổi ảnh đại diện"></i>
                                            <input type="file" class="account__info__left--avt-file" id="account__info__left--avt-file">
                                        </div>
                                    </div>
                                    <div class="col-md-10 col-sm-7 col-xs-12">
                                        <div class="account__info__right">
                                            <h3 class="account__info__right--name"></h3>
                                            <div class="d-flex">
                                                <div class="account__info__right--role pr-3">
                                                    <i class="fas fa-user-circle"></i>
                                                    <span></span>
                                                </div>
                                                <div class="account__info__right--phone pr-3">
                                                    <i class="fas fa-phone-alt"></i>
                                                    <span></span>
                                                </div>
                                                <div class="account__info__right--address">
                                                    <i class="fas fa-map-marker-alt"></i>
                                                    <span></span>
                                                </div>
                                            </div>
                                            <ul class="d-flex mt-4 account-post-number">
                                                <li class="text-center mr-2">
                                                    <b class="sum-animal"></b>
                                                    <div>Bài đăng</div>
                                                </li> 
                                                <li class="text-center mr-2">
                                                    <b class="percent"></b>
                                                    <div>Phần trăm</div>
                                                </li>  
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="profile-details mt-4">
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <a data-toggle="tab" class="nav-link active" href="#profile-details-info">Thông tin</a>
                                        </li>
                                        <li class="nav-item">
                                            <a data-toggle="tab" class="nav-link" href="#change-password">Mật khẩu</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div id="profile-details-info" class="tab-pane active">
                                            <form action="" method="post">
                                                <div class="form-group">
                                                    <label for=""><b>Tên đăng nhập <span class="text-danger">*</span></b></label>
                                                    <input type="text" class="profile-details-info--username form-control rounded-0" name="account_username" >
                                                    <div class="alert alert-dismissible fade show text-danger profile-details-info--username-alert">
                                                        Tên đang nhập là bắt buộc!
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for=""><b>Tên hiển thị: </b></label>
                                                    <input type="text" class="profile-details-info--name form-control rounded-0" name="account_name" placeholder="Tên hiển thị...">
                                                </div>
                                                <div class="form-group">
                                                    <label for=""><b>Số điện thoại: </b></label>
                                                    <input type="text" class="profile-details-info--phone form-control rounded-0" name="account_phone" placeholder="Tên hiển thị...">
                                                </div>
                                                <div class="form-group">
                                                    <label for=""><b>Ngày sinh: </b></label>
                                                    <input type="date" class="profile-details-info--birthday form-control rounded-0" name="account_birthday">
                                                </div>
                                                <div class="form-group">
                                                    <label for=""><b>Giới tính: </b></label><br>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" class="form-check-input account_male" value="1" name="account_gender">Nam
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" class="form-check-input account_female" value="0" name="account_gender">Nữ
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for=""><b>Địa chỉ: </b></label>
                                                    <input type="text" class="profile-details-info--address form-control rounded-0" name="account_address" placeholder="Tên hiển thị...">
                                                </div>
                                                <div class="account__center__btn">
                                                    <button type="submit" class="btn btn-info rounded-0 profile-details-info--btn-change-info">Lưu thay đổi</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div id="change-password" class="tab-pane fade">
                                            <form action="" method="post">
                                                <div class="form-group">
                                                    <label for=""><b>Mật khẩu cũ <span class="text-danger">*</span> </b></label>
                                                    <input type="password" class="account__info__right__form--password form-control rounded-0" name="account_password" placeholder="Mật khẩu...">
                                                    <div class="alert text-danger change-password-old-password-alert">
                                                        Mật khẩu cũ là bắt buộc!
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for=""><b>Mật khẩu mới <span class="text-danger">*</span> </b></label>
                                                    <input type="password" class="account__info__right__form--new_password form-control rounded-0" name="account_new_password" placeholder="Mật khẩu mới...">

                                                    <div class="alert text-danger change-password-new-password-alert">
                                                        Mật khẩu mới là bắt buộc!
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for=""><b>Xác nhận mật khẩu mới <span class="text-danger">*</span> </b></label>
                                                    <input type="password" class="account__info__right__form--re_new_password form-control rounded-0" name="account_re_new_password" placeholder="Nhập lại mật khẩu mới...">
                                                    <div class="alert text-danger change-password-check-new-password-alert">
                                                        Xác nhận mật khẩu mới là bắt buộc!
                                                    </div>
                                                </div>

                                                <div class="account__left__btn">
                                                    <button type="submit" class="btn btn-info rounded-0 account__info__right__form--btn-change-password">Đổi mật khẩu</button>
                                                    <button type="reset" class="account__left__btn-reset d-none"></button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button class="account-page-show-dialog" style="display: none" data-toggle="modal" data-target="#account-page-modal"></button>

    <div class="modal fade" id="account-page-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <b>Thông báo</b>
                </div>
                <div class="modal-body">
                    <div class="account-noti-content"></div>
                    <div class="text-right">
                        <button type="button" class="btn btn-info btn-sm rounded-0" data-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php include '../layout/footer-only.php' ?>
