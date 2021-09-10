<?php 
include '../../config.php';
include '../layout/header-only.php';

?>

<?php if (empty($_SESSION['user'])): ?>
    <?php header('Location:' . BASE . 'admin') ?>
<?php else: ?>
    <?php include '../layout/header.php'; ?>
    <div id="animal-list">
        <div class="container">
            <div class="layout-wrap">
                <div class="layout-left">
                    <?php include '../layout/menu-left.php'; ?>
                </div>
                <div class="layout-right">
                    <!--Tìm kiếm -->
                    <div class="main-search">
                        <form action="danhsachtimkiem.php" accept-charset="UTF-8" enctype="multipart/form-data" method="POST">
                        <!-- Another variation with a button -->
                            <div class="input-group search-box" style="margin-top: -30px;">
                                <div class="input-group">
                                    <input type="text" name="input_search" class="form-control rounded-0" placeholder="Search Animal" onkeyup='livesearch(this.value);'>
                                    <div class="input-group-append">
                                        <button type="submit" name="submit" class="btn btn-secondary rounded-0" type="button" style="background-color: #0e768d;">
                                            <i class="fa fa-search"></i>
                                        </button> 
                                    </div>
                                </div>

                                <div id='result'></div>
                            </div>
                        </form>
                    </div>
                    <!--Tìm kiếm -->

                    <!--Button Thêm -->
                    <div class="d-flex justify-content-between mb-3">
                        <h3 class="mb-0" id="animal-list-title text-center"></h3>
                        <button type="button" class="btn btn-primary rounded-0" id="btn-animal-cn" onclick="HideShow()" style="background-color: #0e768d;">
                            <b>Thêm Animal</b>
                        </button>
                    </div>
                    <!--Button Thêm -->

                    <!--Form THÊM -->
                    <div class="col-md-6 offset-md-3" id="form-cn">
                        <h3 class="text-center">THÊM ĐỘNG VẬT</h3>
                        <form action="themAnimal.php"  accept-charset="UTF-8" enctype="multipart/form-data" method="POST"  target="">
                            <div class="form-group">
                                <div class="gridtable">
                                    <table class="table table-striped table-bordered">
                                        <thead class="bg-primary text-center">
                                            <tr>
                                            </tr>
                                        </thead>    
                                        <tbody>
                                            <tr>
                                                <td>
                                                <label for="exampleInputName">Tên khoa học</label>
                                                </td>
                                                <td>
                                                <input type="text" name="inputkhoahoc" class="form-control" id="inputkhoahoc" placeholder="Nhập tên Khoa học" required="required">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                <label for="exampleInputEmail1" required="required">Tên tiếng Việt</label>
                                                </td>
                                                <td>
                                                <input type="email" name="inputtiengviet" class="form-control" id="inputtiengviet" aria-describedby="emailHelp" placeholder="Nhập tên tiếng Việt">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                <label for="exampleInputEmail1" required="required">Tên địa phương</label>
                                                </td>
                                                <td>
                                                <input type="email" name="inputdiaphuong" class="form-control" id="inputdiaphuong" aria-describedby="emailHelp" placeholder="Nhập tên địa phương">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                <label for="exampleInputEmail1" required="required">Giới</label>
                                                </td>
                                                <td>
                                                <input type="email" name="inputgioi" class="form-control" id="inputgioi" aria-describedby="emailHelp" placeholder="Nhập giới">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                <label for="exampleInputEmail1" required="required">Ngành</label>
                                                </td>
                                                <td>
                                                <input type="email" name="inputnganh" class="form-control" id="inputnganh" aria-describedby="emailHelp" placeholder="Nhập ngành">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                <label for="exampleInputEmail1" required="required">Lớp</label>
                                                </td>
                                                <td>
                                                <input type="email" name="inputlop" class="form-control" id="inputlop" aria-describedby="emailHelp" placeholder="Nhập lớp">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                <label for="exampleInputEmail1" required="required">Bộ</label>
                                                </td>
                                                <td>
                                                <input type="email" name="inputbo" class="form-control" id="inputbo" aria-describedby="emailHelp" placeholder="Nhập bộ">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                <label for="exampleInputEmail1" required="required">Họ</label>                                          
                                                </td>
                                                <td>
                                                <input type="email" name="inputho" class="form-control" id="inputho" aria-describedby="emailHelp" placeholder="Nhập họ">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                <label for="exampleInputName">Mô tả đặc điểm hình thái</label>
                                                </td>
                                                <td>   
                                                <input type="text" name="inputhinhthai" class="form-control" id="inputhinhthai" placeholder="Nhập Mô tả đặc điểm hình thái" required="required">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                <label for="exampleInputEmail1" required="required">Mô tả đặc điểm sinh thái</label>
                                                </td>
                                                <td>
                                                <input type="email" name="inputsinhthai" class="form-control" id="inputsinhthai" aria-describedby="emailHelp" placeholder="Nhập Mô tả đặc điểm sinh thái">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                <label for="exampleInputEmail1" required="required">Giá trị sử dụng:</label>
                                                </td>
                                                <td> 
                                                <input type="email" name="inputgiatri" class="form-control" id="inputgiatri" aria-describedby="emailHelp" placeholder="Nhập Giá trị sử dụng">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                <label for="exampleInputEmail1" required="required">Tình trạng bảo tồn theo IUCN:</label>
                                                </td>
                                                <td>
                                                <input type="email" name="inputiucn" class="form-control" id="inputiucn" aria-describedby="emailHelp" placeholder="Nhập Tình trạng bảo tồn theo IUCN">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                <label for="exampleInputEmail1" required="required">Tình trạng bảo tồn theo sách đỏ Việt Nam:</label>
                                                </td>
                                                <td>
                                                <input type="email" name="inputsachdo" class="form-control" id="inputsachdo" aria-describedby="emailHelp" placeholder="Nhập Tình trạng bảo tồn theo sách đỏ Việt Nam">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                <label for="exampleInputEmail1" required="required">Tình trạng bảo tồn theo Nghị định 32/2006/NĐCP:</label>
                                                </td>
                                                <td>
                                                <input type="email" name="inputndcp" class="form-control" id="inputndcp" aria-describedby="emailHelp" placeholder="Nhập Tình trạng bảo tồn theo Nghị định 32/2006/NĐCP">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                <label for="exampleInputEmail1" required="required">Tình trạng bảo tồn theo CITES (40/2013/TT-BNNPTNT):</label>
                                                </td>
                                                <td>
                                                <input type="email" name="inputcites" class="form-control" id="inputcites" aria-describedby="emailHelp" placeholder="Nhập Tình trạng bảo tồn theo CITES (40/2013/TT-BNNPTNT)">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                <label for="exampleInputEmail1" required="required">Phân bố:</label>
                                                </td>
                                                <td>
                                                <input type="text" name="inputphanbo" class="form-control" id="inputphanbo" placeholder="Nhập Phân bố" required="required">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                <label for="exampleInputEmail1" required="required">Tọa độ 1</label>
                                                </td>
                                                <td>
                                                <input type="email" name="inputtoado1" class="form-control" id="inputtoado1" aria-describedby="emailHelp" placeholder="Nhập Tọa độ 1">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                <label for="exampleInputEmail1" required="required">Tọa độ 2</label>
                                                </td>
                                                <td>
                                                <input type="email" name="inputtoado2" class="form-control" id="inputtoado2" aria-describedby="emailHelp" placeholder="Nhập Tọa độ 2">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                <label for="exampleInputEmail1" required="required">Tọa độ 3</label>
                                                </td>
                                                <td>
                                                <input type="email" name="inputtoado3" class="form-control" id="inputtoado3" aria-describedby="emailHelp" placeholder="Nhập Tọa độ 3">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                <label for="exampleInputEmail1" required="required">Tọa độ 4</label>
                                                </td>
                                                <td>
                                                <input type="email" name="inputtoado4" class="form-control" id="inputtoado4" aria-describedby="emailHelp" placeholder="Nhập Tọa độ 4">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                <label for="exampleInputEmail1" required="required">Tọa độ 5</label>
                                                </td>
                                                <td>
                                                <input type="email" name="inputtoado5" class="form-control" id="inputtoado5" aria-describedby="emailHelp" placeholder="Nhập Tọa độ 5"> 
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                <label for="exampleInputEmail1" required="required">Tình trạng mẫu vật:</label>
                                                </td>
                                                <td>
                                                <input type="email" name="inputtinhtrang" class="form-control" id="inputtinhtrang" aria-describedby="emailHelp" placeholder="Nhập Tình trạng mẫu vật">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                <label for="exampleInputEmail1" required="required">Sinh cảnh</label>  
                                                </td>
                                                <td>
                                                <input type="email" name="inputsinhcanh" class="form-control" id="inputsinhcanh" aria-describedby="emailHelp" placeholder="Nhập Sinh cảnh">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                <label for="exampleInputEmail1" required="required">Địa điểm</label>
                                                </td>
                                                <td>
                                                <input type="email" name="inputdiadiem" class="form-control" id="inputdiadiem" aria-describedby="emailHelp" placeholder="Nhập Địa điểm">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                <label for="exampleInputEmail1" required="required">Ngày thu mẫu</label>
                                                </td>
                                                <td>
                                                <input type="email" name="inputngaythuthap" class="form-control" id="inputngaythuthap" aria-describedby="emailHelp" placeholder="Nhập Ngày thu mẫu">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                <label for="exampleInputEmail1" required="required">Người thu mẫu</label>
                                                </td>
                                                <td>
                                                <input type="email" name="inputnguoithumau" class="form-control" id="inputnguoithumau" aria-describedby="emailHelp" placeholder="Nhập Người thu mẫu">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                <label for="exampleInputEmail1" required="required">Đường dẫn</label>
                                                </td>
                                                <td>
                                                <input type="email" name="inputduongdan" class="form-control" id="inputduongdan" aria-describedby="emailHelp" placeholder="Đường dẫn">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <!-- <hr> -->
                                                    <div class="form-group mt-3 field">
                                                        <label for="exampleInputEmail1" required="required">Thêm hình</label>
                                                        <!--<input type="file" name="fileupload[]" multiple="multiple" /> -->
                                                </td>
                                                <td>
                                                        <input type="file" id="files" name="fileupload[]" multiple="multiple" />
                                                        <!--<p><input type="submit" name="upload" value="Upload File"/></p>-->
                                                    </div>
                                                    <!-- <hr> -->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                </td>
                                                <td>
                                                <button type="submit" class="btn btn-info" name="submit" value="Upload File">Thêm Dộng Vật</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </form>
                    </div> 
                    <!--Form THÊM -->

                    <!--Danh sách động vật -->
                    <?php
                        $con=new mysqli("localhost","root","","web_animal");
                        $con->set_charset("utf8");
                        $sql = " SELECT * FROM dongvat ";
                        // echo $sql;
                        $result = $con->query($sql);
                    ?>
                        <!-- <hr> -->
                        <form class="danhsach" id="form-danhsach">
                            <div class="gridtable">
                                <h3 class="text-center">DANH SÁCH ĐỘNG VẬT</h3>
                                <table class="table table-striped table-bordered">
                                    <thead class="bg-info text-center">
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
                                                echo "<td><a href='./chitiet.php?iddv=".$row['id']."'>Xem chi tiết</a></td>";
                                                echo "<td><a href='suaAnimal.php?iddv=".$row['id']."'><i class='fas fa-pen'></i></a></td>";
                                                echo "<td><a href='./xoaAnimal.php?iddv=".$row['id']."'><i class='fas fa-trash-alt text-danger'></i></a></td>";
                                                echo "</tr>";
                                                $i++;
                                                }
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </form>
                </div>
            </div>
        </div>
        <!--Danh sách động vật -->
        
    </div>



        <!-- JS-->
        <script>
            function HideShow() {
                let star_current = document.getElementById('form-cn').style.display;
                if (star_current === "none") {
                    document.getElementById('form-danhsach').style.display = "none";
                    document.getElementById('form-cn').style.display = "block";
                    document.getElementById('btn-animal-cn').innerHTML = 'Quay lại';
                    document.getElementById('animal-list-title').innerHTML = "Thêm động vật";
                }else{
                    document.getElementById('form-danhsach').style.display = "block";
                    document.getElementById('form-cn').style.display = "none";
                    document.getElementById('btn-animal-cn').innerHTML = 'Thêm Animal';
                    document.getElementById('animal-list-title').innerHTML = "Danh sách động vật";
                }
            }

            function livesearch(data){
                var xmlhttp;
                var result;
                xmlhttp = new XMLHttpRequest();
                if(data != ""){
                    xmlhttp.onreadystatechange = function(){
                        if(xmlhttp.readyState==4 && xmlhttp.status==200){
                            result = xmlhttp.responseText;
                            document.getElementById("result").innerHTML = result;
                        }
                    }
                }
                else {
                    document.getElementById("result").innerHTML = "";
                }
                xmlhttp.open("GET", "./xuly_timkiem.php?data=" + data, true);
                xmlhttp.send();
            }
            
            function timkiem(data){
                var xmlhttp;
                var result;
                xmlhttp = new XMLHttpRequest();
                if(data != ""){
                    xmlhttp.onreadystatechange = function(){
                        if(xmlhttp.readyState==4 && xmlhttp.status==200){
                            result = xmlhttp.responseText;
                            document.getElementById("result").innerHTML = result;
                        }
                    }
                }
                else {
                    document.getElementById("result").innerHTML = "";
                }
                xmlhttp.open("GET", "./xuly_timkiem.php?data=" + data, true);
                xmlhttp.send();
            }

        </script>


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js">
        </script>    


        <script>
            $(document).ready(function () {
            if (window.File && window.FileList && window.FileReader) {
            $("#files").on("change", function (e) {
            var files = e.target.files,
            filesLength = files.length;
            for (var i = 0; i < filesLength; i++) {
            var f = files[i];
            var fileReader = new FileReader();
            fileReader.onload = function (e) {
            var file = e.target;
            $(
            '<span class="pip">' +
              '<img class="imageThumb" src="' +
              e.target.result +
              '" title="' +
              file.name +
              '"/>' +
              '<br/><span class="remove">Xóa ảnh</span>' +
              "</span>"
            ).insertAfter("#files");
            $(".remove").click(function () {
            $(this).parent(".pip").remove();
            });

          // Old code here
          /*$("<img></img>", {
            class: "imageThumb",
            src: e.target.result,
            title: file.name + " | Click to remove"
          }).insertAfter("#files").click(function(){$(this).remove();});*/
        };
        fileReader.readAsDataURL(f);
        }
        console.log(files);
        });
        } else {
        alert("Your browser doesn't support to File API");
        }
        });
        </script>
        <!-- JS-->




<?php endif; ?>
<?php include '../layout/footer-only.php' ?>