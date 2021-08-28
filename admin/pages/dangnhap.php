<div id="login">
    <div class="login-wrap">
        <div class="container">
            <div class="row">
                <div class="login__left col-12 col-sm-12 col-md-12 col-lg-6 p-0">
                    <div class="login-img">
                        <img src="<?php echo BASE ?>/images/login-img.jpg" class="w-100 d-none d-lg-block">
                        <img src="<?php echo BASE ?>/images/login-img-mobile.jpg" class="w-100 d-lg-none">
                    </div>
                </div>
                <div class="login-right col-12 col-sm-12 col-md-12 col-lg-6">
                    <div class="login__right__inner p-3">
                        <div class="login-form pt-3">
                            <h2>Welcom to our Web</h2>
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="login_username"><b>Tên đăng nhập:</b></label>
                                    <input type="text" class="form-control" id="login_username" name="username" placeholder="Tên đăng nhập...">
                                </div>
                                <div class="form-group pt-3">
                                    <label for="login_password" class="d-flex justify-content-between">
                                        <b>Mật khẩu:</b>
                                        <b class="forget-password" title="Bạn quên mật khẩu?">
                                            <i class="far fa-hand-point-right"></i>
                                            Quên mật khẩu
                                        </b>
                                    </label>
                                    <input type="password" class="form-control" id="login_password" name="password" placeholder="Mật khẩu...">
                                </div>
                                <div class="button-group d-flex justify-content-between">
                                    <button type="submit" class="btn btn-primary" id="login_submit">Đăng nhập</button>
                                    <a href="trang-chu" class="pt-1"><b>Trang chủ</b></a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>