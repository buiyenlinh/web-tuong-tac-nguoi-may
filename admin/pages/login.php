<div id="login">
    <div class="login-wrap">
        <div class="container">
            <div class="login-form pt-3">
                <h2 class="text-info">Đăng nhập !!!</h2>
                <form action="" method="post">
                    <div class="text-danger error-login"></div>
                    <div class="form-group">
                        <label for="login_username"><b>Tên đăng nhập <i class="text-danger">*</i></b></label>
                        <input type="text" class="form-control" id="login_username" name="username" placeholder="Nhập...">
                        <div class="alert alert-dismissible fade show text-danger login-alert-username">
                            Tên đăng nhập là bắt buộc!
                        </div>
                    </div>
                    <div class="form-group pt-3">
                        <span class="d-flex justify-content-between">
                            <label for="login_password">
                                <b>Mật khẩu <i class="text-danger">*</i></b>    
                            </label>
                            <b class="go-forget-password" title="Quên mật khẩu">
                                <i class="far fa-hand-point-right"></i>
                                Quên mật khẩu
                            </b>
                        </span>
                        <input type="password" class="form-control" id="login_password" name="password" placeholder="Nhập...">
                        <div class="alert alert-dismissible fade show text-danger login-alert-password">
                            Mật khẩu là bắt buộc!
                        </div>
                    </div>
                    <div class="button-group d-flex justify-content-between">
                        <button type="submit" class="btn btn-info" id="login_submit">Đăng nhập</button>
                        <a href="<?php echo BASE?>" class="pt-1 go-home"><b class="text-info">Trang chủ</b></a>
                    </div>
                </form>
            </div>
            
            <div class="forget-password-form">
                <h2 class="text-info mb-4">Quên mật khẩu !!!</h2>
                <form action="" method="post">
                    <div class="text-danger error-change-password"></div>
                    <div class="form-group">
                        <label for="login_username"><b>Tên đăng nhập <i class="text-danger">*</i></b></label>
                        <input type="text" class="form-control" id="forget_username" name="username" placeholder="Nhập...">
                        <div class="alert alert-dismissible fade show text-danger forget-alert-username">
                            Tên đăng nhập là bắt buộc!
                        </div>
                    </div>

                    <div class="form-group pt-3">
                        <label for="login_password">
                            <b>Mật khẩu mới <i class="text-danger">*</i></b>
                        </label>
                        <input type="password" class="form-control" id="forget_new_password" name="new_password" placeholder="Nhập...">
                        <div class="alert alert-dismissible fade show text-danger forget-alert-password">
                            Mật khẩu là bắt buộc!
                        </div>
                    </div>

                    <div class="form-group pt-3">
                        <label for="login_password">
                            <b>Xác nhận mật khẩu <i class="text-danger">*</i></b>
                        </label>
                        <input type="password" class="form-control" id="forget_check_password" name="check_password" placeholder="Nhập...">
                        <div class="alert alert-dismissible fade show text-danger forget-alert-check-password">
                            <span>Xác nhận mật khẩu là bắt buộc!</span>
                        </div>
                    </div>
                    <div class="button-group d-flex justify-content-between">
                        <span>
                            <button type="submit" class="btn btn-info" id="forget_password_submit">Thay đổi</button>
                            <button type="button" class="btn btn-outline-info login-back">Trở lại</button>
                        </span>
                        <a href="<?php echo BASE?>" class="pt-1 go-home"><b class="text-info">Trang chủ</b></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>