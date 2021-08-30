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
                    <div class="account__right">
                        <div class="account__right--title mt-2 mb-1">
                            <h3>Tài khoản</h3>
                        </div>

                        <div class="account__right__info">
                            <div class="row">
                                <div class="col-2">
                                    <div class="account__info__left--avt">
                                        <img src="<?php echo BASE ?>images/avt-default.jpg" class="rounded-circle" alt="">
                                        <i class="fas fa-edit  icon-edit-avt" title="Thay đổi ảnh đại diện"></i>
                                        <input type="file" class="account__info__left--avt-file" id="account__info__left--avt-file">
                                    </div>
                                    <div class="account__info__left--name text-center"> </div>
                                </div>
                                <div class="col-5">
                                    <div class="account__info__center">
                                        <div class="account__info__center__form">
                                            <form action="" method="post">
                                                <div class="form-group">
                                                    <label for=""><b>Tên đăng nhập <span class="text-danger">*</span></b></label>
                                                    <input type="text" class="account__info__center__form--username form-control rounded-0" name="account_username" >
                                                </div>
                                                <div class="form-group">
                                                    <label for=""><b>Tên hiển thị: </b></label>
                                                    <input type="text" class="account__info__center__form--name form-control rounded-0" name="account_name" placeholder="Tên hiển thị...">
                                                </div>
                                                <div class="account__center__btn">
                                                    <button type="submit" class="btn btn-info rounded-0 account__info__center__form--btn-change-info">Lưu thay đổi</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-5">
                                    <div class="account__info__right">
                                        <div class="account__info__right--title mb-3 text-info">
                                            <i class="far fa-hand-point-right"></i> Thay đổi mật khẩu
                                        </div>
                                        <div class="account__info__right__form">
                                            <form action="" method="post">
                                                <div class="form-group">
                                                    <label for=""><b>Mật khẩu cũ <span class="text-danger">*</span> </b></label>
                                                    <input type="password" class="account__info__right__form--password form-control rounded-0" name="account_password" placeholder="Mật khẩu...">
                                                </div>
                                                <div class="form-group">
                                                    <label for=""><b>Mật khẩu mới <span class="text-danger">*</span> </b></label>
                                                    <input type="password" class="account__info__right__form--new_password form-control rounded-0" name="account_new_password" placeholder="Mật khẩu mới...">
                                                </div>
                                                <div class="form-group">
                                                    <label for=""><b>Nhập lại mật khẩu mới <span class="text-danger">*</span> </b></label>
                                                    <input type="password" class="account__info__right__form--re_new_password form-control rounded-0" name="account_re_new_password" placeholder="Nhập lại mật khẩu mới...">
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
    </div>
<?php endif; ?>

<?php include '../layout/footer-only.php' ?>
