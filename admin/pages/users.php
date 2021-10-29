<?php 
// include '../../config.php';
include '../layout/header-only.php';

?>

<?php if (empty($_SESSION['user'])): ?>
  <?php header('Location:' . BASE . 'admin') ?>
<?php else: ?>
   
    <div id="users-page">
      <div class="layout-wrap">
          <div class="layout-left">
              <?php include '../layout/menu-left.php'; ?>
          </div>
          <div class="layout-right">
            <div class="layout-right-header">
              <?php include '../layout/header.php'; ?>
            </div>
            <div class="layout-right-content">
              <div class="layout-right-content-details">
                <div id="users">
                  <div class="users p-3">
                    <div class="list-users">
                      <div class="d-flex justify-content-between mb-2">
                        <h3>Danh sách người dùng</h3>
                        <button type="button" class="btn btn-info btn-sm rounded-0 btn-add-user" data-toggle="modal" data-target="#add-user-modal">
                          + Thêm
                        </button>
                      </div>
                      <div class="table-responsive">
                        <table class="table table-striped table-bordered text-center">
                          <thead class="bg-info text-light">
                            <th>Tên đăng nhập</th>
                            <th>Tên hiển thị</th>
                            <th>Quyền người dùng</th>
                            <th>Ngày sinh</th>
                            <th>Giới tính</th>
                            <th>Số điện thoại</th>
                            <th>Địa chỉ</th>
                            <th>Thời gian tạo</th>
                            <th>Thao tác</th>
                          </thead>
                          <tbody class="list-users-body"></tbody>
                        </table>
                      </div>
                      <div class="modal fade" id="add-user-modal">
                        <div class="modal-dialog modal-dialog-scrollable">
                          <div class="modal-content">
                            <form action="" method="post">
                              <div class="modal-header">
                                <b class="modal-title">Thêm người dùng</b>
                                <button type="button" class="close close-modal-add-user" data-dismiss="modal">x</button>
                              </div>
                              <div class="modal-body">
                                <div class="alert alert-danger text-danger add-user-error-alert"></div>
                                <div class="form-group">
                                  <label for="">Tên đăng nhập: <span class="text-danger">*</span></label>
                                  <input type="text" class="user-form__username form-control rounded-0" name="username" placeholder="Tên đăng nhập...">
                                  <div class="alert text-danger user-form__username-alert">
                                    Tên đăng nhập là bắt buộc!
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="">Mật khẩu: <span class="text-danger">*</span></label>
                                  <input type="password" class="user-form__password form-control rounded-0" name="password" placeholder="Mật khẩu...">
                                  
                                  <div class="alert text-danger user-form__password-alert">
                                    Mật khẩu là bắt buộc!
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="">Quyền người dùng: <span class="text-danger">*</span></label>
                                  <select name="user_role" class="form-control rounded-0 user_role_list"></select>
                                </div>
                              
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-info pl-4 pr-4 user-form__button__add rounded-0">Lưu</button>
                                <button type="reset" class="user-form__button__reset d-none"></button>
                                <button type="button" class="btn btn-light rounded-0 close-modal-add-user" data-dismiss="modal">Thoát</button>
                              </div>
                              </form>
                          </div>
                        </div>
                      </div>

                      <div class="modal fade" id="update-user-modal">
                        <div class="modal-dialog modal-dialog-scrollable modal-lg">
                          <div class="modal-content">
                              <div class="modal-header">
                                <b class="modal-title">Cập nhật người dùng</b>
                                <button type="button" class="close close-modal-add-user" data-dismiss="modal">x</button>
                              </div>
                              <div class="modal-body">
                                <form action="" method="post" name="user-update-form" class="row">
                                  <div class="form-group col-md-6">
                                    <label for="">Tên đăng nhập: <span class="text-danger">*</span></label>
                                    <input type="text" class="update-user-username form-control rounded-0" name="username" placeholder="Tên đăng nhập...">

                                    <div class="alert text-danger update-user-username-alert">
                                      Tên đăng nhập là bắt buộc!
                                    </div>

                                  </div>
                                  
                                  <div class="form-group col-md-6">
                                    <label for="">Tên hiển thị: <span class="text-danger">*</span></label>
                                    <input type="text" class="update-user-name form-control rounded-0" name="name" placeholder="Tên hiển thị...">
                                  </div>

                                  <div class="form-group col-md-6">
                                    <label for="">Ngày sinh: <span class="text-danger">*</span></label>
                                    <input type="date" class="update-user-birthday form-control rounded-0" name="birthday" placeholder="Ngày sinh...">
                                  </div>

                                  <div class="form-group col-md-6 update-user-gender">
                                    <label for="">Giới tính: <span class="text-danger">*</span></label><br>
                                    <div class="form-check-inline">
                                      <label class="form-check-label">
                                          <input type="radio" class="form-check-input" id="user_male" value="1" name="gender">Nam
                                      </label>
                                    </div>
                                    <div class="form-check-inline">
                                      <label class="form-check-label">
                                          <input type="radio" class="form-check-input" id="user_female" value="0" name="gender">Nữ
                                      </label>
                                    </div>
                                  </div>

                                  <div class="form-group col-md-6">
                                    <label for="">Số điện thoại: <span class="text-danger">*</span></label>
                                    <input type="text" class="update-user-phone form-control rounded-0" name="phone" placeholder="Số điện thoại...">
                                  </div>

                                  <div class="form-group col-md-6">
                                    <label for="">Quyền người dùng: <span class="text-danger">*</span></label>
                                    <select name="role" class="user_role_list form-control rounded-0"></select>
                                  </div>

                                  <div class="form-group col-md-12">
                                    <label for="">Địa chỉ: <span class="text-danger">*</span></label>
                                    <input type="text" class="update-user-address form-control rounded-0" name="address" placeholder="Địa chỉ...">
                                  </div>

                                </form>  
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-info pl-4 pr-4 update-user-button rounded-0">Lưu</button>
                                <button type="button" class="btn btn-light rounded-0 close-modal-update-user" data-dismiss="modal">Đóng</button>
                              </div>
                          </div>
                        </div>
                      </div>

                      <button class="btn btn-light toggle-delete-modal" type="button" data-toggle="modal" data-target="#delete-user-modal"></button>
                      <div class="modal fade" id="delete-user-modal">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-body">
                              <div class="text-modal-delete-user">Bạn muốn xóa người dùng <b></b> ?</div>
                              <div class="text-right btn-group-modal-delete-user"></div>
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
    </div>

    <button class="users-page-show-dialog" style="display: none" data-toggle="modal" data-target="#users-page-modal"></button>
    <div class="modal fade" id="users-page-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <b>Thông báo</b>
                </div>
                <div class="modal-body">
                    <div class="users-noti-content"></div>
                    <div class="text-right">
                        <button type="button" class="btn btn-info btn-sm rounded-0" data-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>
<?php include '../layout/footer-only.php' ?>