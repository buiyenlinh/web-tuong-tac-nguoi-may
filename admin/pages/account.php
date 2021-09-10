<?php 

include '../../config.php';

include '../layout/header-only.php';

?>

<?php if (empty($_SESSION['user'])): ?>
    <?php header('Location:' . BASE . 'admin') ?>
<?php else: ?>
    <?php  include '../layout/header.php';  ?>

    <div id="account-page">
        <div class="container">
          <div class="account-page">
            <div class="layout-wrap">
                <div class="layout-left">
                    <div class="account__left">
                        <?php include '../layout/menu-left.php'; ?>
                    </div>
                </div>
                <div class="layout-right">
                    <div class="account__right p-3">
                        <div class="account__right__info">
                            <div class="row">
                                <div class="col-2">
                                    <div class="account__info__left--avt">
                                        <img src="" alt="">
                                        <i class="fas fa-edit  icon-edit-avt" title="Thay đổi ảnh đại diện"></i>
                                        <input type="file" class="account__info__left--avt-file" id="account__info__left--avt-file">
                                    </div>
                                </div>
                                <div class="col-10">
                                    <div class="account__info__right">
                                        <h3 class="account__info__right--name"></h3>
                                        <div class="d-flex">
                                            <div class="account__info__right--role pr-3">
                                                <i class="far fa-user-circle"></i>
                                                <span></span>
                                            </div>
                                            <div class="account__info__right--phone pr-3">
                                                <i class="fas fa-phone-alt"></i>
                                                <span>0987654321</span>
                                            </div>
                                            <div class="account__info__right--address">
                                                <i class="fas fa-map-marker-alt"></i>
                                                <span>Cần Thơ</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="profile-details">
                                <h3>Thông tin chi tiết</h3>
                                <div class="profile-details-info">
                                    <form action="" method="post">
                                        <div class="form-group">
                                            <label for=""><b>Tên đăng nhập <span class="text-danger">*</span></b></label>
                                            <input type="text" class="account__info__center__form--username form-control rounded-0" name="account_username" >
                                        </div>
                                        <div class="form-group">
                                            <label for=""><b>Tên hiển thị: </b></label>
                                            <input type="text" class="account__info__center__form--name form-control rounded-0" name="account_name" placeholder="Tên hiển thị...">
                                        </div>
                                        <div class="form-group">
                                            <label for=""><b>Số điện thoại: </b></label>
                                            <input type="text" class="account__info__center__form--name form-control rounded-0" name="account_name" placeholder="Tên hiển thị...">
                                        </div>
                                        <div class="form-group">
                                            <label for=""><b>Ngày sinh: </b></label>
                                            <input type="date" class="account__info__center__form--birthday form-control rounded-0" name="account_birthday" placeholder="Tên hiển thị...">
                                        </div>
                                        <div class="form-group">
                                            <label for=""><b>Giới tính: </b></label><br>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input male" value="1" name="account_gender">Nam
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input female" value="0" name="account_gender">Nữ
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for=""><b>Địa chỉ: </b></label>
                                            <input type="text" class=" form-control rounded-0" name="account_birthday" placeholder="Tên hiển thị...">
                                        </div>
                                        <div class="account__center__btn">
                                            <button type="submit" class="btn btn-info rounded-0 account__info__center__form--btn-change-info">Lưu thay đổi</button>
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
<?php endif; ?>

<?php include '../layout/footer-only.php' ?>
