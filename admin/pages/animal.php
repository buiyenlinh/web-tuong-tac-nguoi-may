<?php 
include '../../config.php';
include '../layout/header-only.php';

?>

<?php if (empty($_SESSION['user'])): ?>
    <?php include './pages/login.php' ?>
<?php else: ?>
    <?php include '../layout/header.php'; ?>
        <div class="container">
            <div class="layout-wrap">
                <div class="layout-left">
                    <?php include '../layout/menu-left.php'; ?>
                </div>
                <div class="layout-right">
                    <!--Tìm kiếm -->
                    <div class="search-animal">
                        <b style="font-size:20px; margin-left:400px;">Search Animal: </b>
                        <input type="text" class="search-input" style="width:400px; padding-left:600px; margin-top:20px;";>
                        <button class="btn btn-light">
                        <i class="fas fa-search text-info"></i>
                        </button>
                    </div>
                    <!--Tìm kiếm -->



                    <!--Button Thêm -->
                    <hr>
                    <div class="row">
                        <div class="col-12 col-lg-4 btn-submit">
                            
                        </div>
                        <div class="col-12 col-lg-4 btn-submit">
                            
                        </div>
                        <div class="col-12 col-lg-4 btn-submit">
                            <button type="button" class="btn btn-primary" id="btn-animal-cn" onclick="HideShow()">
                            <b>Thêm Animal</b>
                            </button>
                        </div>
                    </div>
                    <!--Button Thêm -->




                    <!--Form THÊM -->
                    <div class="col-md-6 offset-md-3 mt-5" id="form-cn">
                        <form accept-charset="UTF-8" action="" method="POST"  target="_blank">
                            <div class="form-group">
                                <label for="exampleInputName">Tên khoa học</label>
                                <input type="text" name="fullname" class="form-control" id="inputkhoahoc" placeholder="Nhập tên Khoa học" required="required">
                                <label for="exampleInputEmail1" required="required">Tên tiếng Việt</label>
                                <input type="email" name="email" class="form-control" id="inputtiengviet" aria-describedby="emailHelp" placeholder="Nhập tên tiếng Việt">
                                <label for="exampleInputEmail1" required="required">Tên địa phương</label>
                                <input type="email" name="email" class="form-control" id="inputdiaphuong" aria-describedby="emailHelp" placeholder="Nhập tên địa phương">
                                <label for="exampleInputEmail1" required="required">Giới</label>
                                <input type="email" name="email" class="form-control" id="inputgioi" aria-describedby="emailHelp" placeholder="Nhập giới">
                                <label for="exampleInputEmail1" required="required">Ngành</label>
                                <input type="email" name="email" class="form-control" id="inputnganh" aria-describedby="emailHelp" placeholder="Nhập ngành">
                                <label for="exampleInputEmail1" required="required">Lớp</label>
                                <input type="email" name="email" class="form-control" id="inputlop" aria-describedby="emailHelp" placeholder="Nhập lớp">
                                <label for="exampleInputEmail1" required="required">Bộ</label>
                                <input type="email" name="email" class="form-control" id="inputbo" aria-describedby="emailHelp" placeholder="Nhập bộ">
                                <label for="exampleInputEmail1" required="required">Họ</label>
                                <input type="email" name="email" class="form-control" id="inputho" aria-describedby="emailHelp" placeholder="Nhập họ">
                                <label for="exampleInputName">Mô tả đặc điểm hình thái</label>
                                <input type="text" name="fullname" class="form-control" id="inputhinhthai" placeholder="Nhập Mô tả đặc điểm hình thái" required="required">
                                <label for="exampleInputEmail1" required="required">Mô tả đặc điểm sinh thái</label>
                                <input type="email" name="email" class="form-control" id="inputsinhthai" aria-describedby="emailHelp" placeholder="Nhập Mô tả đặc điểm sinh thái">
                                <label for="exampleInputEmail1" required="required">Giá trị sử dụng:</label>
                                <input type="email" name="email" class="form-control" id="inputgiatri" aria-describedby="emailHelp" placeholder="Nhập Giá trị sử dụng">
                                <label for="exampleInputEmail1" required="required">Tình trạng bảo tồn theo IUCN:</label>
                                <input type="email" name="email" class="form-control" id="inputiucn" aria-describedby="emailHelp" placeholder="Nhập Tình trạng bảo tồn theo IUCN">
                                <label for="exampleInputEmail1" required="required">Tình trạng bảo tồn theo sách đỏ Việt Nam:</label>
                                <input type="email" name="email" class="form-control" id="inputsachdo" aria-describedby="emailHelp" placeholder="Nhập Tình trạng bảo tồn theo sách đỏ Việt Nam">
                                <label for="exampleInputEmail1" required="required">Tình trạng bảo tồn theo Nghị định 32/2006/NĐCP:</label>
                                <input type="email" name="email" class="form-control" id="inputndcp" aria-describedby="emailHelp" placeholder="Nhập Tình trạng bảo tồn theo Nghị định 32/2006/NĐCP">
                                <label for="exampleInputEmail1" required="required">Tình trạng bảo tồn theo CITES (40/2013/TT-BNNPTNT):</label>
                                <input type="email" name="email" class="form-control" id="inputcites" aria-describedby="emailHelp" placeholder="Nhập Tình trạng bảo tồn theo CITES (40/2013/TT-BNNPTNT)">
                                <label for="exampleInputEmail1" required="required">Phân bố:</label>
                                <input type="text" name="fullname" class="form-control" id="inputphanbo" placeholder="Nhập Phân bố" required="required">
                                <label for="exampleInputEmail1" required="required">Tọa độ 1</label>
                                <input type="email" name="email" class="form-control" id="inputtoado1" aria-describedby="emailHelp" placeholder="Nhập Tọa độ 1">
                                <label for="exampleInputEmail1" required="required">Tọa độ 2</label>
                                <input type="email" name="email" class="form-control" id="inputtoado2" aria-describedby="emailHelp" placeholder="Nhập tên địa Tọa độ 2">
                                <label for="exampleInputEmail1" required="required">Tọa độ 3</label>
                                <input type="email" name="email" class="form-control" id="inputtoado3" aria-describedby="emailHelp" placeholder="Nhập Tọa độ 3">
                                <label for="exampleInputEmail1" required="required">Tọa độ 4</label>
                                <input type="email" name="email" class="form-control" id="inputtoado4" aria-describedby="emailHelp" placeholder="Nhập Tọa độ 4">
                                <label for="exampleInputEmail1" required="required">Tọa độ 5</label>
                                <input type="email" name="email" class="form-control" id="inputtoado5" aria-describedby="emailHelp" placeholder="Nhập Tọa độ 5">
                                <label for="exampleInputEmail1" required="required">Tình trạng mẫu vật:</label>
                                <input type="email" name="email" class="form-control" id="inputtinhtrang" aria-describedby="emailHelp" placeholder="Nhập Tình trạng mẫu vật">
                                <label for="exampleInputEmail1" required="required">Sinh cảnh</label>
                                <input type="email" name="email" class="form-control" id="inputsinhcanh" aria-describedby="emailHelp" placeholder="Nhập Sinh cảnh">
                                <label for="exampleInputEmail1" required="required">Địa điểm</label>
                                <input type="email" name="email" class="form-control" id="inputdiadiem" aria-describedby="emailHelp" placeholder="Nhập Địa điểm">
                                <label for="exampleInputEmail1" required="required">Ngày thu mẫu</label>
                                <input type="email" name="email" class="form-control" id="inputngaythuthap" aria-describedby="emailHelp" placeholder="Nhập Ngày thu mẫu">
                                <label for="exampleInputEmail1" required="required">Người thu mẫu</label>
                                <input type="email" name="email" class="form-control" id="inputnguoithuthap" aria-describedby="emailHelp" placeholder="Nhập Người thu mẫu">
                            </div>
                            <hr>
                            <div class="form-group mt-3">
                                
                                <form action="demo_upload.php" enctype="multipart/form-data" method="POST">
                                    <label for="exampleInputEmail1" required="required">Thêm hình</label>
                                    <input type="file" name="file[]" multiple />
                                <!--<p><input type="submit" name="upload" value="Upload File"/></p>-->
                                </form>

                            </div>
                            <hr>
                            <button type="submit" class="btn btn-primary" name="upload" value="Upload File">Thêm</button>
                        </form>
                    </div> 
                    <!--Form THÊM -->






                </div>
            </div>
        </div>



        <!-- JS-->
        <script>
            function HideShow() {
                let star_current = document.getElementById('form-cn').style.display;
                if (star_current === "none") {
                    document.getElementById('form-cn').style.display = "block";
                    document.getElementById('btn-animal-cn').innerHTML = 'Quay lại';
                }else{
                    document.getElementById('form-cn').style.display = "none";
                    document.getElementById('btn-animal-cn').innerHTML = 'Thêm Animal';
                }
            }
        </script>
        <!-- JS-->




<?php endif; ?>
<?php include '../layout/footer-only.php' ?>