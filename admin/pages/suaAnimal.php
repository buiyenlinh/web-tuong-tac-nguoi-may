<?php
include '../../config.php';
include '../layout/header-only.php';
?>

<?php
if (isset($_GET["iddv"])) {
    $iddv = $_GET['iddv'];
    //echo $iddv;
    $con = new mysqli("localhost", "root", "", "web_animal");
    $con->set_charset("utf8");
    $sql = "SELECT * FROM dongvat WHERE id = " . $iddv . ";";
    // echo $sql;
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $tenkhoahoc = $row['tenkhoahoc'];
        $tentiengviet = $row['tentiengviet'];
        $tendiaphuong = $row['tendiaphuong'];
        $gioi = $row['gioi'];
        $nganh = $row['nganh'];
        $lop = $row['lop'];
        $bo = $row['bo'];
        $ho = $row['ho'];
        $hinhthai = $row['hinhthai'];
        $sinhthai = $row['sinhthai'];
        $giatri = $row['giatri'];
        $iucn = $row['iucn'];
        $sachdo = $row['sachdo'];
        $nghidinh = $row['nghidinh'];
        $cities = $row['cities'];
        $phanbo = $row['phanbo'];
        $tinhtrang = $row['tinhtrang'];
        $sinhcanh = $row['sinhcanh'];
        $diadiem = $row['diadiem'];
        $ngaythuthap = $row['ngaythuthap'];
        $nguoithuthap = $row['nguoithuthap'];
        $created_at = $row['created_at'];
        $updated_at = $row['updated_at'];
        $duongdan = $row['duongdan'];
    }

    $sql_1 = "SELECT * FROM hinhanh WHERE dongvat_id = " . $iddv . ";";
    //    echo $sql_1;
    $result = $con->query($sql_1);
    if ($result->num_rows > 0) {
        //$row = $result->fetch_assoc();
        $i = 0; //Dat bien i truoc tien de khoi tao chay trong while
        while ($row = $result->fetch_assoc()) {
            $hinh[$i] = $row['duongdan'];
            //           echo $hinh[$i];
            //           echo "<br>";
            $i++;
        }
    }

    $sql_2 = "SELECT count(dongvat_id) as tonghinh FROM hinhanh WHERE dongvat_id = " . $iddv . ";";
    $count = $con->query($sql_2);
    $row = $count->fetch_assoc();
    //echo $row['tonghinh'];
    $tonghinh = $row['tonghinh'];

    $sql = "SELECT * FROM toado WHERE dongvat_id = " . $iddv . "";
    // echo $sql;
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        $i = 0; //Dat bien i truoc tien de khoi tao chay trong while
        while ($row = $result->fetch_assoc()) {
            $toado[$i] = $row['toado'];
            //           echo $toado[$i];
            //            echo "<br>";
            $i++;
        }
    }
    $sql_2 = "SELECT count(dongvat_id) as tongtoado FROM toado WHERE dongvat_id = " . $iddv . ";";
    $count = $con->query($sql_2);
    $row = $count->fetch_assoc();
    //echo $row['tonghinh'];
    $tongtoado = $row['tongtoado'];
    //echo $tongtoado;
    for ($i = 0; $i < $tongtoado; $i++) {
        $td[$i] = isset($toado[$i]) ? $toado[$i] : null;
    }

    for ($i = 0; $i < $tonghinh; $i++) {
        $hinhanh[$i] = isset($hinh[$i]) ? '../../../' . $hinh[$i] : null;
    }
}
?>

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
                <div class="p-3">
                    <h3 class="text-center mt-4 mb-2">CHỈNH SỬA ĐỘNG VẬT</h3>
                    <form class="chinhsua" id="form-suachua" action="" method="post" enctype="multipart/form-data">
                        <div class="gridtable">
                            <table class="table table-striped table-bordered">
                                <thead class="bg-info text-center text-light">
                                    <tr>
                                        <th>Thông tin</th>
                                        <th>Dữ liệu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Tên khoa học:</td>
                                        <td><input type="text" class="form-control" size="20" name="tenkhoahocsua" value='<?php echo $tenkhoahoc; ?>' placeholder="Tên khoa học" /></td>
                                    </tr>
                                    <tr>
                                        <td>Tên tiếng Việt:</td>
                                        <td><input type="text" class="form-control" size="20" name="tentiengvietsua" value='<?php echo $tentiengviet; ?>' placeholder="Tên tiếng Việt" /></td>
                                    </tr>
                                    <tr>
                                        <td>Tên địa phương:</td>
                                        <td><input type="text" class="form-control" size="20" name="tendiaphuongsua" value='<?php echo $tendiaphuong; ?>' placeholder="Tên địa phương" /></td>
                                    </tr>
                                    <tr>
                                        <td>Giới:</td>
                                        <td><input type="text" class="form-control" size="20" name="gioisua" value='<?php echo $gioi; ?>' placeholder="Giới" /></td>
                                    </tr>
                                    <tr>
                                        <td>Bộ:</td>
                                        <td><input type="text" class="form-control" size="20" name="nganhsua" value='<?php echo $bo; ?>' placeholder="Bộ" /></td>
                                    </tr>
                                    <tr>
                                        <td>Lớp:</td>
                                        <td><input type="text" class="form-control" size="20" name="lopsua" value='<?php echo $lop; ?>' placeholder="Lớp" /></td>
                                    </tr>
                                    <tr>
                                        <td>Ngành:</td>
                                        <td><input type="text" class="form-control" size="20" name="bosua" value='<?php echo $nganh; ?>' placeholder="Ngành" /></td>
                                    </tr>
                                    <tr>
                                        <td>Họ:</td>
                                        <td><input type="text" class="form-control" size="20" name="hosua" value='<?php echo $ho; ?>' placeholder="Họ" /></td>
                                    </tr>
                                    <?php
                                    for ($i = 0; $i < $tonghinh; $i++) {
                                        if ($hinhanh[$i] != null) {
                                            echo "<tr>";
                                            echo "<td>Hình ảnh " . $i + 1 . ":</td>";
                                            echo "<td><input type='file' class='form-control' size='20' name='hinhanh" . $i . "'>";
                                            echo "<img src='" . $hinhanh[$i] . "' alt='hinhdongvat' class='imgSize' style='width: 100px; height: 100px; margin-right: 10px;'>";
                                            echo "</td>";
                                            echo "</tr>";
                                        }
                                    }
                                    ?>
                                    <tr>
                                        <td>Hình ảnh mới:</td>
                                        <td>
                                            <input type="file" id="files" name="fileupload[]" multiple="multiple" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Mô tả đặc điểm hình thái:</td>
                                        <td><input type="text" class="form-control" size="20" name="hinhthaisua" value='<?php echo $hinhthai; ?>' placeholder="Mô tả đặc điểm hình thái" /></td>
                                    </tr>
                                    <tr>
                                        <td>Mô tả đặc điểm sinh thái:</td>
                                        <td><input type="text" class="form-control" size="20" name="sinhthaisua" value='<?php echo $sinhthai; ?>' placeholder="Mô tả đặc điểm sinh thái" /></td>
                                    </tr>
                                    <tr>
                                        <td>Giá trị sử dụng:</td>
                                        <td><input type="text" class="form-control" size="20" name="giatrisua" value='<?php echo $giatri; ?>' placeholder="Giá trị sử dụng" /></td>
                                    </tr>
                                    <tr>
                                        <td>Tình trạng bảo tồn theo IUCN:</td>
                                        <td><input type="text" class="form-control" size="20" name="iucnsua" value='<?php echo $iucn; ?>' placeholder="Tình trạng bảo tồn theo IUCN" /></td>
                                    </tr>
                                    <tr>
                                        <td>Tình trạng bảo tồn theo sách đỏ Việt Nam:</td>
                                        <td><input type="text" class="form-control" size="20" name="sachdosua" value='<?php echo $sachdo; ?>' placeholder="Tình trạng bảo tồn theo sách đỏ Việt Nam" /></td>
                                    </tr>
                                    <tr>
                                        <td>Tình trạng bảo tồn theo Nghị định 32/2006/NĐCP:</td>
                                        <td><input type="text" class="form-control" size="20" name="ndcpsua" value='<?php echo $nghidinh; ?>' placeholder="Tình trạng bảo tồn theo Nghị định 32/2006/NĐCP" /></td>
                                    </tr>
                                    <tr>
                                        <td>Tình trạng bảo tồn theo CITES (40/2013/TT-BNNPTNT):</td>
                                        <td><input type="text" class="form-control" size="20" name="citessua" value='<?php echo $cities; ?>' placeholder="Tình trạng bảo tồn theo CITES (40/2013/TT-BNNPTNT)" /></td>
                                    </tr>
                                    <tr>
                                        <td>Phân bố:</td>
                                        <td><input type="text" class="form-control" size="20" name="phanbosua" value='<?php echo $phanbo; ?>' placeholder="Phân bố" /></td>
                                    </tr>
                                    <?php
                                    for ($i = 0; $i < $tongtoado; $i++) {
                                        if ($td[$i] != null) {
                                            echo "<tr>";
                                            echo "<td>Tạo độ " . $i + 1 . ":</td>";
                                            echo "<td><input type='text' class='form-control' size='20' name='toado" . $i . "' value='" . $td[$i] . "'></td>";
                                            echo "</tr>";
                                        }
                                    }
                                    ?>
                                    <tr>
                                        <td>Thêm tọa độ</td>
                                        <td>
                                            <div class="input_fields_wrap">
                                                <button class="add_field_button btn btn-info rounded-0">Thêm tọa độ</button>
                                                <div><input type="text" class="form-control" name="inputtoado1"></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tình trạng mẫu vật:</td>
                                        <td><input type="text" class="form-control" size="20" name="tinhtrangsua" value='<?php echo $tinhtrang; ?>' placeholder="Tình trạng mẫu vật" /></td>
                                    </tr>
                                    <tr>
                                        <td>Sinh cảnh:</td>
                                        <td><input type="text" class="form-control" size="20" name="sinhcanhsua" value='<?php echo $sinhcanh; ?>' placeholder="Sinh cảnh" /></td>
                                    </tr>
                                    <tr>
                                        <td>Địa điểm:</td>
                                        <td><input type="text" class="form-control" size="20" name="diadiemsua" value='<?php echo $diadiem; ?>' placeholder="Địa điểm" /></td>
                                    </tr>
                                    <tr>
                                        <td>Ngày thu mẫu:</td>
                                        <td><input type="text" class="form-control" size="20" name="ngaythuthapsua" value='<?php echo $ngaythuthap; ?>' placeholder="Ngày thu mẫu" /></td>
                                    </tr>
                                    <tr>
                                        <td>Người thu mẫu:</td>
                                        <td><input type="text" class="form-control" size="20" name="nguoithuthapsua" value='<?php echo $nguoithuthap; ?>' placeholder="Người thu mẫu" /></td>
                                    </tr>
                                    <tr>
                                        <td>Đường dẫn:</td>
                                        <td><input type="text" class="form-control" size="20" name="duongdansua" value='<?php echo $duongdan; ?>' placeholder="Đường dẫn" /></td>
                                        <input type="text" name="id" hidden value="<?php echo $iddv; ?>">
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <button type="submit" class="btn btn-info rounded-0" name="apply"  value="Upload File" style="float:right;">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js">
</script>


<script>
    $(document).ready(function() {
        if (window.File && window.FileList && window.FileReader) {
            $("#files").on("change", function(e) {
                var files = e.target.files,
                    filesLength = files.length;
                for (var i = 0; i < filesLength; i++) {
                    var f = files[i];
                    var fileReader = new FileReader();
                    fileReader.onload = function(e) {
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
                        $(".remove").click(function() {
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

<script>
    $(document).ready(function() {
        var max_fields = 10; //maximum input boxes allowed
        var wrapper = $(".input_fields_wrap"); //Fields wrapper
        var add_button = $(".add_field_button"); //Add button ID

        var x = 1; //initlal text box count
        $(add_button).click(function(e) { //on add input button click
            e.preventDefault();
            if (x < max_fields) { //max input box allowed
                x++; //text box increment
                $(wrapper).append('<div><input type="text" name="inputtoado' + x + '"/><a href="#" class="remove_field">Xóa</a></div>'); //add input box
            }
        });

        $(wrapper).on("click", ".remove_field", function(e) { //user click on remove text
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })
    });
</script>
<?php
//session_start();
if (isset($_POST["apply"])) {
    $iddv = $_POST['id'];
    $tenkhoahoc = $_POST['tenkhoahocsua'];
    $tentiengviet = $_POST['tentiengvietsua'];
    $tendiaphuong = $_POST['tendiaphuongsua'];
    $gioi = $_POST['gioisua'];
    $nganh = $_POST['nganhsua'];
    $lop = $_POST['lopsua'];
    $bo = $_POST['bosua'];
    $ho = $_POST['hosua'];
    for ($i = 0; $i < $tonghinh; $i++) {
        $hinhanh[$i] = $_FILES["hinhanh" . $i . ""];
    }
    $hinhthai = $_POST['hinhthaisua'];
    $sinhthai = $_POST['sinhthaisua'];
    $giatri = $_POST['giatrisua'];
    $iunc = $_POST['iucnsua'];
    $sachdo = $_POST['sachdosua'];
    $ndcp = $_POST['ndcpsua'];
    $cites = $_POST['citessua'];
    $phanbo = $_POST['phanbosua'];
    for ($i = 0; $i < $tongtoado; $i++) {
        $tdo[$i] = $_POST["toado" . $i . ""];
    }
    /*for ($i = $tongtoado; $i < 5; $i++) {
        $tdo[$i] = $_POST["toado" . $i . ""];
    }*/
    for ($i = 1; $i < 10; $i++) {
        $tdo[$i] = $_POST["inputtoado" . $i . ""];
        //echo $td[$i];
    }
    $tinhtrang = $_POST['tinhtrangsua'];
    $sinhcanh = $_POST['sinhcanhsua'];
    $diadiem = $_POST['diadiemsua'];
    $ngaythuthap = $_POST['ngaythuthapsua'];
    $nguoithumau = $_POST['nguoithuthapsua'];
    $duongdan = $_POST['duongdansua'];

    $con = new mysqli("localhost", "root", "", "web_animal");
    $con->set_charset("utf8");
    $sql = " UPDATE dongvat
        SET tenkhoahoc = '" . $tenkhoahoc . "' ,tentiengviet = '" . $tentiengviet . "',
            tendiaphuong = '" . $tendiaphuong . "' ,gioi = '" . $gioi . "' ,nganh = '" . $nganh . "' ,lop = '" . $lop . "' ,
            bo = '" . $bo . "' ,ho = '" . $ho . "' ,hinhthai = '" . $hinhthai . "' ,sinhthai = '" . $sinhthai . "' ,giatri = '" . $giatri . "' ,iucn = '" . $iucn . "' ,sachdo = '" . $sachdo
        . "' ,nghidinh = '" . $ndcp . "' ,cities = '" . $cities . "' ,phanbo = '" . $phanbo . "' ,tinhtrang = '" . $tinhtrang . "' ,sinhcanh = '" . $sinhcanh
        . "' ,diadiem = '" . $diadiem . "' ,ngaythuthap = '" . $ngaythuthap . "' ,nguoithuthap = '" . $nguoithumau . "' ,duongdan = '" . $duongdan . "'
        WHERE id = " . $iddv . ";";
    //return $sql;
    //echo $sql."<br>";
    $con->query($sql);

    $sql = "SELECT * from hinhanh WHERE dongvat_id = " . $iddv . ";";
    $result = $con->query($sql);
    //$row = $count->fetch_assoc();
    for ($i = 0; $i < $tonghinh; $i++) {
        $row = $result->fetch_assoc();
        move_uploaded_file($hinhanh[$i]['tmp_name'], '../../../uploads/' . $hinhanh[$i]['name']);
        $con = new mysqli("localhost", "root", "", "web_animal");
        $con->set_charset("utf8");
        if (!empty($hinhanh[$i]['name'])) {
            $sql = "UPDATE hinhanh SET duongdan = '" . 'uploads/' . $hinhanh[$i]['name'] . "' WHERE id = " . $row['id'] . ";";
            //echo $sql . "<br>";
            $con->query($sql);
        }
    }
    $sql = "SELECT * from toado WHERE dongvat_id = " . $iddv . ";";
    $result = $con->query($sql);
    for ($i = 0; $i < $tongtoado; $i++) {
        $row = $result->fetch_assoc();
        $con = new mysqli("localhost", "root", "", "web_animal");
        $con->set_charset("utf8");
        if (!empty($tdo[$i])) {
            $sql = " UPDATE toado SET toado = '" . $tdo[$i] . "' WHERE id = " . $row['id'] . ";";
            //echo $sql . "<br>";
            $con->query($sql);
        }
    }



    if (($_SERVER['REQUEST_METHOD'] === 'POST') && (isset($_FILES['fileupload']))) {

        $files = $_FILES['fileupload'];

        $names      = $files['name'];
        $types      = $files['type'];
        $tmp_names  = $files['tmp_name'];
        $errors     = $files['error'];
        $sizes      = $files['size'];


        $numitems = count($names);
        $numfiles = 0;

        $hinhname = array();
        for ($i = 0; $i < $numitems; $i++) {
            //Kiểm tra file thứ $i trong mảng file, up thành công không
            //$so=$i + 1;
            $kt = false;
            if ($errors[$i] == 0) {
                $numfiles++;
                $kt = true;
                //Code xử lý di chuyển file đến thư mục cần thiết ở đây (bạn tự thực hiện)
                move_uploaded_file($tmp_names[$i], '../../../uploads/' . $names[$i]);

                $path = '../../../uploads/' . $names[$i];
            }
        }
        //echo "Tổng số file upload: " .$numfiles;
        $con->set_charset("utf8");
        for ($i = 0; $i < $numfiles; $i++) {
            $sql = "insert into hinhanh(duongdan, dongvat_id) values ('" . 'uploads/' . $names[$i] . "', '" . $iddv . "');";
            //       echo $sql;
            $con->query($sql);
        }
    }

    //for ($i = $tongtoado; $i < 5; $i++) {
    for ($i = 1; $i < 10; $i++) {
        $row = $result->fetch_assoc();
        $con = new mysqli("localhost", "root", "", "web_animal");
        $con->set_charset("utf8");
        if (!empty($tdo[$i])) {
            $sql = "insert into toado (toado, dongvat_id) values ('" . $tdo[$i] . "', '" . $iddv . "');";
            //echo $sql . "<br>";
            $con->query($sql);
        }
    }
    header('Location: animal.php');
}
?>

<?php include '../layout/footer-only.php' ?>