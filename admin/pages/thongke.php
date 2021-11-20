<?php include '../layout/header-only.php'; ?>

<?php 
$gioi = $db->query("SELECT COUNT(*) FROM gioi")->fetchColumn();
$nganh = $db->query("SELECT COUNT(*) FROM nganh")->fetchColumn();
$lop = $db->query("SELECT COUNT(*) FROM lop")->fetchColumn();
$bo = $db->query("SELECT COUNT(*) FROM bo")->fetchColumn();
$ho = $db->query("SELECT COUNT(*) FROM ho")->fetchColumn();
$dongvat = $db->query("SELECT COUNT(*) FROM dongvat")->fetchColumn();

?>

<?php if (empty($_SESSION['user'])): ?>
    <?php header('Location:' . BASE . 'admin') ?>
<?php else: ?>
    <div id="thong-ke">
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
                      <div class="thong-ke p-4">
                        <div class="row">
                          <div class="col-md-3 col-sm-4 col-xs-12">
                            <div class="item">
                              <div>
                                <span>Số Lượng</span><br>
                                <b>GIỚI</b><br>
                                <b class="number"><?php echo $gioi ?></b>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-3 col-sm-4 col-xs-12">
                            <div class="item">
                              <div>
                                <span>Số Lượng</span><br>
                                <b>NGÀNH</b><br>
                                <b class="number"><?php echo $nganh ?></b>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-3 col-sm-4 col-xs-12">
                            <div class="item">
                              <div>
                                <span>Số Lượng</span><br>
                                <b>LỚP</b><br>
                                <b class="number"><?php echo $lop ?></b>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-3 col-sm-4 col-xs-12">
                            <div class="item">
                              <div>
                                <span>Số Lượng</span><br>
                                <b>BỘ</b><br>
                                <b class="number"><?php echo $bo ?></b>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-3 col-sm-4 col-xs-12">
                            <div class="item">
                              <div>
                                <span>Số Lượng</span><br>
                                <b>HỌ</b><br>
                                <b class="number"><?php echo $ho ?></b>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-3 col-sm-4 col-xs-12">
                            <div class="item">
                              <div>
                                <span>Số Lượng</span><br>
                                <b>ĐỘNG VẬT</b><br>
                                <b class="number"><?php echo $dongvat ?></b>
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
