<?php 
include '../../config.php';
include '../layout/header-only.php';

?>

<?php if (empty($_SESSION['user'])): ?>
  <?php header('Location:' . BASE . 'admin') ?>
<?php else: ?>
    <?php include '../layout/header.php'; ?>
    <div id="users-page">
        <div class="container">
            <div class="users-page">
                <div class="layout-wrap">
                    <div class="layout-left">
                        <?php include '../layout/menu-left.php'; ?>
                    </div>
                    <div class="layout-right">
                      <div id="users">
                        <div class="users p-3">
                          <div class="d-flex justify-content-between">
                            <div class="list-users pr-3">
                                <h3>Danh sách người dùng</h3>
                                <table class="table table-striped table-bordered text-center">
                                  <thead class="bg-info text-light">
                                    <th>Tên đăng nhập</th>
                                    <th>Quyền người dùng</th>
                                    <th>Thời gian tạo</th>
                                    <th>Thao tác</th>
                                  </thead>
                                  <tbody class="list-users-body"></tbody>
                                </table>
                            </div>
                            <?php if ($_SESSION['user']['vaitro'] == 0 || $_SESSION['user']['vaitro'] == 1): ?>
                            <div class="user-form pl-3">
                              <h3>Thêm người dùng</h3>
                              <form action="" method="post">
                                <div class="form-group">
                                  <label for=""><b>Tên đăng nhập: <span class="text-danger">*</span></b></label>
                                  <input type="text" class="user-form__username form-control rounded-0" name="username" placeholder="Tên đăng nhập...">
                                </div>
                                <div class="form-group">
                                  <label for=""><b>Mật khẩu: <span class="text-danger">*</span></b></label>
                                  <input type="text" class="user-form__password form-control rounded-0" name="password" placeholder="Mật khẩu...">
                                </div>
                                <div class="form-group">
                                  <label for=""><b>Quyền người dùng: <span class="text-danger">*</span></b></label>
                                  <select name="user_role" id="user_role" class="form-control rounded-0">
                                      <option value="1">Administrator</option>
                                      <option value="2">Editor</option> 
                                  </select>
                                </div>
                                <div class="user-form__button">
                                  <button type="button" class="btn btn-info pl-4 pr-4 user-form__button__add rounded-0">Lưu</button>
                                  <button type="reset" class="user-form__button__reset d-none"></button>
                                </div>
                              </form>
                            </div>
                            <?php endif; ?>
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