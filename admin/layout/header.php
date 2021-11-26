<div id="header">
    <div class="header d-flex justify-content-between p-3">
        <i class="fas fa-bars text-light" style="font-size: 25px; display: none" id="icon-bars"></i>
        <i class="fas fa-bars text-light" style="font-size: 25px;" id="icon-bars-dev"></i>
        <div class="header__slogan text-light">
            <i class="fas fa-frog"></i>
            <b>TRANG QUẢN LÝ ĐỘNG VẬT</b>
        </div>
        <div class="header__logout">
            <span class="header-avt-user">
                <img src="" alt="">
            </span>
            <div class="header-account">
                <ul>
                    <li style="display: flex; align-items: center">
                        <img src="" alt="">
                        <div class="ml-2">
                            <span class="header-account-name"></span>
                            <span class="header-account-username" style="font-size: 14px"></span>
                        </div>
                    </li>
                    <li class="mt-2">
                        <span
                            class="pr-2 text-light"
                            id="logout"
                            data-target="#logout-modal"
                            data-toggle="modal"
                        >
                            <span class="text-info text-logout">
                                <i class="fas fa-sign-out-alt pr-1"></i><b>Đăng xuất</b>
                            </span>
                        </span>
                    </li>
                </ul>
                
            </div>
            
        </div>
    </div>

    <div class="modal fade" id="logout-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div>Bạn muốn đăng xuất?</div>
                    <div class="btn-group-logout text-right"></div>
                </div>
            </div>
        </div>
    </div>
</div>