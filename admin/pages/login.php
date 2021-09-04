<div id="login">
    <div class="login-wrap">
        <div class="container">
            <div class="login-form pt-3">
                <h2 class="text-info">Welcom to our Web</h2>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="login_username"><b>Tên đăng nhập <i class="text-danger">*</i></b></label>
                        <input type="text" class="form-control" id="login_username" name="username" placeholder="Tên đăng nhập...">
                    </div>
                    <div class="form-group pt-3">
                        <label for="login_password" class="d-flex justify-content-between">
                            <b>Mật khẩu <i class="text-danger">*</i></b>
                            <b class="forget-password" title="Bạn quên mật khẩu?">
                                <i class="far fa-hand-point-right"></i>
                                Quên mật khẩu
                            </b>
                        </label>
                        <input type="password" class="form-control" id="login_password" name="password" placeholder="Mật khẩu...">
                    </div>
                    <div class="button-group d-flex justify-content-between">
                        <button type="submit" class="btn btn-info" id="login_submit">Đăng nhập</button>
                        <a href="<?php echo BASE?>" class="pt-1"><b class="text-info">Trang chủ</b></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>