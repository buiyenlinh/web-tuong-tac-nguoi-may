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
                    <div class="search-box search-animal">
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
                            <button type="button" class="btn btn-primary" id="btn-animal-chitiet" onclick="HideShow_chitiet()" style="background-color: #0e768d;">
                            <b>Danh sách Animal</b>
                            </button>

                            <button type="button" class="btn btn-primary" id="btn-animal-cn" onclick="HideShow()" style="background-color: #0e768d;">
                            <b>Thêm Animal</b>
                            </button>
                        </div>
                    </div>
                    <!--Button Thêm -->




                    <!--Form THÊM -->
                    <div class="col-md-6 offset-md-3 mt-5" id="form-cn">
                        <form action="themAnimal.php"  accept-charset="UTF-8" enctype="multipart/form-data" method="POST"  target="">
                            <div class="form-group">
                                <label for="exampleInputName">Tên khoa học</label>
                                <input type="text" name="inputkhoahoc" class="form-control" id="inputkhoahoc" placeholder="Nhập tên Khoa học" required="required">
                                <label for="exampleInputEmail1" required="required">Tên tiếng Việt</label>
                                <input type="email" name="inputtiengviet" class="form-control" id="inputtiengviet" aria-describedby="emailHelp" placeholder="Nhập tên tiếng Việt">
                                <label for="exampleInputEmail1" required="required">Tên địa phương</label>
                                <input type="email" name="inputdiaphuong" class="form-control" id="inputdiaphuong" aria-describedby="emailHelp" placeholder="Nhập tên địa phương">
                                <label for="exampleInputEmail1" required="required">Giới</label>
                                <input type="email" name="inputgioi" class="form-control" id="inputgioi" aria-describedby="emailHelp" placeholder="Nhập giới">
                                <label for="exampleInputEmail1" required="required">Ngành</label>
                                <input type="email" name="inputnganh" class="form-control" id="inputnganh" aria-describedby="emailHelp" placeholder="Nhập ngành">
                                <label for="exampleInputEmail1" required="required">Lớp</label>
                                <input type="email" name="inputlop" class="form-control" id="inputlop" aria-describedby="emailHelp" placeholder="Nhập lớp">
                                <label for="exampleInputEmail1" required="required">Bộ</label>
                                <input type="email" name="inputbo" class="form-control" id="inputbo" aria-describedby="emailHelp" placeholder="Nhập bộ">
                                <label for="exampleInputEmail1" required="required">Họ</label>
                                <input type="email" name="inputho" class="form-control" id="inputho" aria-describedby="emailHelp" placeholder="Nhập họ">
                                <label for="exampleInputName">Mô tả đặc điểm hình thái</label>
                                <input type="text" name="inputhinhthai" class="form-control" id="inputhinhthai" placeholder="Nhập Mô tả đặc điểm hình thái" required="required">
                                <label for="exampleInputEmail1" required="required">Mô tả đặc điểm sinh thái</label>
                                <input type="email" name="inputsinhthai" class="form-control" id="inputsinhthai" aria-describedby="emailHelp" placeholder="Nhập Mô tả đặc điểm sinh thái">
                                <label for="exampleInputEmail1" required="required">Giá trị sử dụng:</label>
                                <input type="email" name="inputgiatri" class="form-control" id="inputgiatri" aria-describedby="emailHelp" placeholder="Nhập Giá trị sử dụng">
                                <label for="exampleInputEmail1" required="required">Tình trạng bảo tồn theo IUCN:</label>
                                <input type="email" name="inputiucn" class="form-control" id="inputiucn" aria-describedby="emailHelp" placeholder="Nhập Tình trạng bảo tồn theo IUCN">
                                <label for="exampleInputEmail1" required="required">Tình trạng bảo tồn theo sách đỏ Việt Nam:</label>
                                <input type="email" name="inputsachdo" class="form-control" id="inputsachdo" aria-describedby="emailHelp" placeholder="Nhập Tình trạng bảo tồn theo sách đỏ Việt Nam">
                                <label for="exampleInputEmail1" required="required">Tình trạng bảo tồn theo Nghị định 32/2006/NĐCP:</label>
                                <input type="email" name="inputndcp" class="form-control" id="inputndcp" aria-describedby="emailHelp" placeholder="Nhập Tình trạng bảo tồn theo Nghị định 32/2006/NĐCP">
                                <label for="exampleInputEmail1" required="required">Tình trạng bảo tồn theo CITES (40/2013/TT-BNNPTNT):</label>
                                <input type="email" name="inputcites" class="form-control" id="inputcites" aria-describedby="emailHelp" placeholder="Nhập Tình trạng bảo tồn theo CITES (40/2013/TT-BNNPTNT)">
                                <label for="exampleInputEmail1" required="required">Phân bố:</label>
                                <input type="text" name="inputphanbo" class="form-control" id="inputphanbo" placeholder="Nhập Phân bố" required="required">
                                <label for="exampleInputEmail1" required="required">Tọa độ 1</label>
                                <input type="email" name="inputtoado1" class="form-control" id="inputtoado1" aria-describedby="emailHelp" placeholder="Nhập Tọa độ 1">
                                <label for="exampleInputEmail1" required="required">Tọa độ 2</label>
                                <input type="email" name="inputtoado2" class="form-control" id="inputtoado2" aria-describedby="emailHelp" placeholder="Nhập tên địa Tọa độ 2">
                                <label for="exampleInputEmail1" required="required">Tọa độ 3</label>
                                <input type="email" name="inputtoado3" class="form-control" id="inputtoado3" aria-describedby="emailHelp" placeholder="Nhập Tọa độ 3">
                                <label for="exampleInputEmail1" required="required">Tọa độ 4</label>
                                <input type="email" name="inputtoado4" class="form-control" id="inputtoado4" aria-describedby="emailHelp" placeholder="Nhập Tọa độ 4">
                                <label for="exampleInputEmail1" required="required">Tọa độ 5</label>
                                <input type="email" name="inputtoado5" class="form-control" id="inputtoado5" aria-describedby="emailHelp" placeholder="Nhập Tọa độ 5">
                                <label for="exampleInputEmail1" required="required">Tình trạng mẫu vật:</label>
                                <input type="email" name="inputtinhtrang" class="form-control" id="inputtinhtrang" aria-describedby="emailHelp" placeholder="Nhập Tình trạng mẫu vật">
                                <label for="exampleInputEmail1" required="required">Sinh cảnh</label>
                                <input type="email" name="inputsinhcanh" class="form-control" id="inputsinhcanh" aria-describedby="emailHelp" placeholder="Nhập Sinh cảnh">
                                <label for="exampleInputEmail1" required="required">Địa điểm</label>
                                <input type="email" name="inputdiadiem" class="form-control" id="inputdiadiem" aria-describedby="emailHelp" placeholder="Nhập Địa điểm">
                                <label for="exampleInputEmail1" required="required">Ngày thu mẫu</label>
                                <input type="email" name="inputngaythuthap" class="form-control" id="inputngaythuthap" aria-describedby="emailHelp" placeholder="Nhập Ngày thu mẫu">
                                <label for="exampleInputEmail1" required="required">Người thu mẫu</label>
                                <input type="email" name="inputnguoithumau" class="form-control" id="inputnguoithumau" aria-describedby="emailHelp" placeholder="Nhập Người thu mẫu">
                            </div>
                            <hr>
                            <div class="form-group mt-3">
                                    <label for="exampleInputEmail1" required="required">Thêm hình</label>
                                    <input type="file" name="fileupload[]" multiple="multiple" />
                                <!--<p><input type="submit" name="upload" value="Upload File"/></p>-->
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-primary" name="submit" value="Upload File">Thêm</button>
                        </form>
                    </div> 
                    <!--Form THÊM -->









                    <?php
                        $con=new mysqli("localhost","root","","web_animal");
                        $con->set_charset("utf8");
                        $sql = " SELECT * FROM dongvat ";
                        // echo $sql;
                        $result = $con->query($sql);
                    ?>
                        <hr>
                        <form class="chitiet" id="form-chitiet">
                            <P><b>SÁCH ĐỘNG VẬT</b></P>
                            <table class="table table-striped table-bordered">
                                <thead class="bg-info text-light">
                                    <tr>
                                        <th>STT</th>
                                        <th>TÊN KHOA HỌC</th>
                                        <th>TÊN TIẾNG VIỆT</th>
                                        <th colspan=3>Lựa chọn</th>
                                    </tr>
                                </thead>    
                                <tbody>
                                    <?php
                                    if($result->num_rows > 0) {
                                        $i = 1; //Dat bien i truoc tien de khoi tao chay trong while
                                        while($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>".$i."</td>";
                                        echo "<td>".$row['tenkhoahoc']."</td>";
                                        echo "<td>".$row['tentiengviet']."</td>";
                                        //Ở sau  ko cần dấu ?idsp='". $var ."' Nên dùng  ?idsp=".$row['idsp']."'
                                        echo "<td><a href='./chitiet.php?idsp=".$row['id']."'>Xem chi tiết</a></td>";
                                        echo "<td><a href='suasanpham.php?idsp=".$row['id']."'><i class='fas fa-pen'></i></a></td>";
                                        echo "<td><a href='xoasanpham.php?idsp=".$row['id']."'><img src='../icon/delete.png' width ='20' height = '20'></a></td>";
                                        echo "</tr>";
                                        $i++;
                                        }
                                    }
                                    ?>
                            </tbody>
                            </table>
                        </form>

                        <i class="fa fa-picture-o"></i>
                        <i class="fa fa-picture-o"></i>
                        <i class="fa fa-pencil"></i>
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

            function HideShow_chitiet() {
                let star_current = document.getElementById('form-chitiet').style.display;
                if (star_current === "none") {
                    document.getElementById('form-chitiet').style.display = "block";
                    document.getElementById('btn-animal-chitiet').innerHTML = 'Quay lại';
                }else{
                    document.getElementById('form-chitiet').style.display = "none";
                    document.getElementById('btn-animal-chitiet').innerHTML = 'Danh sách Animal';
                }
            }
        </script>
        <!-- JS-->




<?php endif; ?>
<?php include '../layout/footer-only.php' ?>