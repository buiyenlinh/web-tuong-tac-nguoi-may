<?php include '../layout/header-only.php'; ?>

<?php if (empty($_SESSION['user'])): ?>
    <?php header('Location:' . BASE . 'admin') ?>
<?php else: ?>
    <div id="gioi-nganh-lop-page">
        <div class="layout-wrap">
            <div class="layout-left">
              <?php include '../layout/menu-left.php'; ?>
            </div>
            <div class="layout-right">
                <div class="layout-right-header">
                    <?php  include '../layout/header.php';?>
                </div>
                <div class="layout-right-content">
                    <div class="layout-right-content-details">
                      <div class="row p-3">
                        <div class="col-md-4">
                          <div class="bo" style="border: 1px solid #ddd; border-radius: 10px; padding: 15px; background: #fff">
                            <div class="row">
                              <div class="col-md-8 col-sm-12">             
                                <h4>Danh sách giới</h4>
                              </div>
                              <div class="col-md-4 col-sm-12 text-right">
                                <button
                                  class="btn btn-info btn-sm rounded-0 mb-2 button-add-gioi"
                                  type="button"
                                  data-toggle="modal"
                                  data-target="#gioi-nganh-lop-modal-add-gioi"
                                >Thêm Giới</button>
                              </div>
                            </div>
                            <div class="table-responsive">
                              <table class="table table-striped">
                                <tbody class="gioi-list"> </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="ho" style="border: 1px solid #ddd; border-radius: 10px; padding: 15px; background: #fff">
                            <div class="row">
                            <div class="col-md-8 col-sm-12">             
                                <h4>Danh sách ngành</h4>
                              </div>
                              <div class="col-md-4 col-sm-12 text-right">
                                <button
                                  class="btn btn-info btn-sm rounded-0 mb-2 button-add-nganh"
                                  type="button"
                                  data-toggle="modal"
                                  data-target="#gioi-nganh-lop-modal-add-nganh-lop"
                                >Thêm Ngành</button>
                              </div>
                            </div>
                            <div class="table-responsive">
                              <table class="table table-striped">
                                <tbody class="nganh-list"> </tbody>
                              </table>
                            </div>
                          </div>
                      </div>

                      <div class="col-md-4">
                          <div class="ho" style="border: 1px solid #ddd; border-radius: 10px; padding: 15px; background: #fff">
                            <div class="row">
                              <div class="col-md-8 col-sm-12">             
                                <h4>Danh sách lớp</h4>
                              </div>
                              <div class="col-md-4 col-sm-12 text-right">
                                <button
                                  class="btn btn-info btn-sm rounded-0 mb-2 button-add-lop"
                                  type="button"
                                  data-toggle="modal"
                                  data-target="#gioi-nganh-lop-modal-add-nganh-lop"
                                >Thêm Lớp</button>
                              </div>
                            </div>
                            <div class="table-responsive">
                              <table class="table table-striped">
                                <tbody class="lop-list"> </tbody>
                              </table>
                            </div>
                          </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button class="gioi-nganh-lop-show-dialog" style="display: none" data-toggle="modal" data-target="#gioi-nganh-lop-modal"></button>
    <button class="gioi-nganh-lop-show-dialog-delete" style="display: none" data-toggle="modal" data-target="#gioi-nganh-lop-modal-delete"></button>

    <div class="modal fade" id="gioi-nganh-lop-modal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <b>Thông báo</b>
          </div>
          <div class="modal-body">
            <div class="gioi-nganh-lop-noti-content"></div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="gioi-nganh-lop-modal-delete">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <b>Thông báo</b>
          </div>
          <div class="modal-body">
            <div class="gioi-nganh-lop-noti-content-delete"></div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="gioi-nganh-lop-modal-add-gioi">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <b>Giới</b>
          </div>
          <div class="modal-body">
            <form action="">
              <div class="text-danger add-gioi-error"></div>
              <div class="form-group">
                <label for="">Giới <span class="text-danger">*</span></label>
                <input type="text" class="add-gioi-name form-control">
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button"
              class="btn btn-info btn-sm rounded-0 gioi-nganh-lop-modal-add-gioi-button-add">Thêm
            </button>

            <button style="display: none" type="button"
              class="btn btn-info btn-sm rounded-0 gioi-nganh-lop-modal-add-gioi-button-update">Cập nhật
            </button>
            <button type="button"
              class="btn btn-secondary btn-sm rounded-0 gioi-nganh-lop-modal-add-gioi-button-close"
              data-dismiss="modal">
              Đóng
            </button>
          </div>
        </div>
      </div>
    </div>
   

    <div class="modal fade" id="gioi-nganh-lop-modal-add-nganh-lop">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <div class="add-nganh">
              <b>Ngành</b>
            </div>
            <div class="add-lop" style="display: none">
              <b>Lớp</b>
            </div>
          </div>
          <div class="modal-body">
            <form action="">
              <div class="text-danger add-nganh-lop-error"></div>
              <div class="form-group">
                <label for="">Giới <span class="text-danger">*</span></label>
                <select name="gioi_name_select" id="element" class="gioi-name-select form-control" onchange="getNganhByGioiID(value, '.nganh-name-select')"></select>
              </div>

              <div class="add-nganh">
                <div class="form-group">
                  <label for="">Ngành <span class="text-danger">*</span></label>
                  <input type="text" class="form-control nganh-name-input" name="nganh-name-input">
                </div>
              </div>

              <div class="add-lop" style="display: none">
                <div class="form-group">
                  <label for="">Ngành <span class="text-danger">*</span></label>
                  <select name="nganh_name_select" class="nganh-name-select  form-control"></select>
                </div>

                <div class="form-group">
                  <label for="">Lớp <span class="text-danger">*</span></label>
                  <input type="text" class="form-control lop-name-input" name="lop-name-input">
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <div class="add-nganh">
              <button type="button"
                class="btn btn-info btn-sm rounded-0 gioi-nganh-lop-modal-add-nganh-button-add">Thêm
              </button>
              <button style="display: none" type="button"
                class="btn btn-info btn-sm rounded-0 gioi-nganh-lop-modal-add-nganh-button-update">Cập nhật
              </button>
            </div>

            <div class="add-lop" style="display: none">
              <button type="button"
                class="btn btn-info btn-sm rounded-0 gioi-nganh-lop-modal-add-lop-button-add">Thêm
              </button>
              <button style="display: none" type="button"
                class="btn btn-info btn-sm rounded-0 gioi-nganh-lop-modal-add-lop-button-update">Cập nhật
              </button>
            </div>
            
            <button type="button"
              class="btn btn-secondary btn-sm rounded-0 gioi-nganh-lop-modal-add-gioi-button-close"
              data-dismiss="modal">
              Đóng
            </button>
          </div>
        </div>
      </div>
    </div>

<?php endif; ?>

<?php include '../layout/footer-only.php' ?>
