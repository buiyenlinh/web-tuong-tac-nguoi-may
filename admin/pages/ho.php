<?php include '../layout/header-only.php'; ?>

<?php if (empty($_SESSION['user'])): ?>
    <?php header('Location:' . BASE . 'admin') ?>
<?php else: ?>
    <div id="ho-page">
        <div class="layout-wrap">
            <div class="layout-left">
              <?php include '../layout/menu-left.php'; ?>
            </div>
            <div class="layout-right" style="background: #eaeaea">
                <div class="layout-right-header">
                    <?php  include '../layout/header.php';  ?>
                </div>
                <div class="layout-right-content">
                    <div class="layout-right-content-details">
                      <div class="row p-3">
                        <div class="col-md-6">
                          <div class="bo" style="border: 1px solid #ddd; border-radius: 10px; padding: 15px; background: #fff">
                            <div class="row">
                              <div class="col-md-9 col-sm-12">             
                                <h4>Danh sách bộ động vật</h4>
                              </div>
                              <div class="col-md-3 col-sm-12 text-right">
                                <button
                                  class="btn btn-info btn-sm rounded-0 mb-2 button-add-bo"
                                  type="button"
                                  data-toggle="modal"
                                  data-target="#ho-page-modal-add-bo"
                                >Thêm</button>
                              </div>
                            </div>
                            <div class="table-responsive">
                              <table class="table table-striped">
                                <tbody class="bo-list"> </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="ho" style="border: 1px solid #ddd; border-radius: 10px; padding: 15px; background: #fff">
                            <div class="row">
                              <div class="col-md-9 col-sm-12">             
                                <h4>Danh sách họ động vật</h4>
                              </div>
                              <div class="col-md-3 col-sm-12 text-right">
                                <button
                                  class="btn btn-info btn-sm rounded-0 mb-2 button-add-ho"
                                  type="button"
                                  data-toggle="modal"
                                  data-target="#ho-page-modal-add-bo"
                                >Thêm</button>
                              </div>
                            </div>
                            <div class="table-responsive">
                              <table class="table table-striped">
                                <tbody class="ho-list"> </tbody>
                              </table>
                            </div>
                          </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button class="ho-page-show-dialog" style="display: none" data-toggle="modal" data-target="#ho-page-modal"></button>
    <button class="ho-page-show-dialog-delete" style="display: none" data-toggle="modal" data-target="#ho-page-modal-delete"></button>

    <div class="modal fade" id="ho-page-modal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <b>Thông báo</b>
          </div>
          <div class="modal-body">
            <div class="ho-noti-content"></div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="ho-page-modal-delete">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <b>Thông báo</b>
          </div>
          <div class="modal-body">
            <div class="ho-noti-content-delete"></div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="ho-page-modal-add-bo">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <b>Thêm bộ</b>
          </div>
          <div class="modal-body">
            <form action="">
              <div class="text-danger add-bo-error"></div>
              <div class="form-group">
                <label for="">Giới <span class="text-danger">*</span></label>
                <select name="gioi_name" class="add-bo-gioi-select form-control" onchange="getNganhByGioiID(value)">
                  
                </select>
              </div>
              <div class="form-group">
                <label for="">Ngành <span class="text-danger">*</span></label>
                <select name="nganh_name" class="add-bo-nganh-select form-control" onchange="getLopByNganhID(value)">
                  
                </select>
              </div>
              <div class="form-group">
                <label for="">Lớp <span class="text-danger">*</span></label>
                <select name="lop_name" class="add-bo-lop-select form-control" onchange="getBoByLopID(value)">
                  
                </select>
              </div>
              <div class="add-bo">
                <div class="form-group">
                  <label for="">Bộ <span class="text-danger">*</span></label>
                  <input type="text" name="bo_name" class="form-control bo_name">
                </div>
              </div>
              
              <div class="add-ho" style="display: none">
                <div class="form-group">
                  <label for="">Bộ <span class="text-danger">*</span></label>
                  <select name="bo_name" class="add-ho-bo-select form-control">
                    
                  </select>
                </div>
                <div class="form-group">
                  <label for="">Họ <span class="text-danger">*</span></label>
                  <input type="text" name="ho_name" class="form-control ho_name">
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <div class="add-bo">
              <button
                class="btn btn-info btn-sm rounded-0 ho-page-modal-add-bo-button-add"
                type="button"
              >
                Thêm
              </button>

              <button
                style="display: none"
                class="btn btn-info btn-sm rounded-0 ho-page-modal-add-bo-button-update"
                type="button"
              >
                Cập nhật
              </button>
            </div>

            <div class="add-ho">
              <button
                class="btn btn-info btn-sm rounded-0 ho-page-modal-add-ho-button-add"
                type="button"
              >
                Thêm
              </button>

              <button
                style="display: none"
                class="btn btn-info btn-sm rounded-0 ho-page-modal-add-ho-button-update"
                type="button"
              >
                Cập nhật
              </button>
            </div>

            <button type="button"
              class="btn btn-secondary btn-sm rounded-0 ho-page-modal-add-bo-button-close"
              data-dismiss="modal">
              Đóng
            </button>
          </div>
        </div>
      </div>
    </div>

<?php endif; ?>

<?php include '../layout/footer-only.php' ?>
