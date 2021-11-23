<?php 

include '../layout/header-only.php';

?>

<?php if (empty($_SESSION['user'])): ?>
    <?php header('Location:' . BASE . 'admin') ?>
<?php else: ?>
  <div id="install-page">
    <div class="layout-wrap">
      <div class="layout-left">
        <?php include '../layout/menu-left.php'; ?>
      </div>
      <div class="layout-right">
        <div class="layout-right-header">
          <?php  include '../layout/header.php';  ?>
        </div>
        <div class="layout-right-content">
          <div class="layout-right-content-details">
            <div class="install m-3">
              <h3>Cài đặt</h3>
              <form action="" method="POST">
                <div class="form-group">
                  <label for="">Tên trang web</label>
                  <input type="text" class="form-control website_name" name="website_name">
                  <div class="text-danger website-name-error"></div>
                </div>

                <div class="form-group">
                  <label for="">Thông tin footer</label>
                  <input type="text" class="form-control footer_info" name="footer_info">
                  <div class="text-danger footer-info-error"></div>
                </div>

                <div class="form-group">
                  <label for="">Favicon</label><br>
                  <input type="file" name="favicon" id="install-favicon">
                  <button class="btn btn-outline-info btn-sm rounded-0 install-btn-change-favicon" type="button">Đổi favicon</button> <br>
                  <img src="" class="install-favicon-preview mt-3" alt="" style="width: 150px; height: 150px; object-fit: cover">
                </div>

                <div class="form-group">
                  <button type="button" class="btn btn-info rounded-0 install-btn-submit">Lưu thay đổi</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>

<?php include '../layout/footer-only.php' ?>
