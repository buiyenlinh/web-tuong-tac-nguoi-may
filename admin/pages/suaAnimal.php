<?php
// include '../../config.php';
include '../layout/header-only.php';
?>
<?php
ob_start();
?>
<?php

function to_slug($str)
{
    $str = trim(mb_strtolower($str));
    $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
    $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
    $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
    $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
    $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
    $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
    $str = preg_replace('/(đ)/', 'd', $str);
    $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
    $str = preg_replace('/([\s]+)/', '-', $str);
    return $str;
}

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
        //$gioi = $row['gioi'];
        //$nganh = $row['nganh'];
        //$lop = $row['lop'];
        //$bo = $row['bo'];
        $hoid = $row['ho_id'];
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
    //Tim ten ho 
    $sql_1 = "SELECT * FROM ho WHERE id = " . $hoid . ";";
    $result = $con->query($sql_1);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $ho = $row['ten'];
        $boid = $row['bo_id'];
    }
    //Tim ten bo
    $sql_1 = "SELECT * FROM bo WHERE id = " . $boid . ";";
    $result = $con->query($sql_1);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $bo = $row['ten'];
        $lopid = $row['lop_id'];
    }
    //Tim nganh
    $sql_1 = "SELECT * FROM lop WHERE id = " . $lopid . ";";
    $result = $con->query($sql_1);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $lop = $row['ten'];
        $nganhid = $row['nganh_id'];
    }
    //Tim nganh
    $sql_1 = "SELECT * FROM nganh WHERE id = " . $nganhid . ";";
    $result = $con->query($sql_1);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nganh = $row['ten'];
        $gioiid = $row['gioi_id'];
    }
    //Tim gioi
    $sql_1 = "SELECT * FROM gioi WHERE id = " . $gioiid . ";";
    $result = $con->query($sql_1);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $gioi = $row['ten'];
    }


    $sql_1 = "SELECT * FROM hinhanh WHERE dongvat_id = " . $iddv . ";";
    //    echo $sql_1;
    $result = $con->query($sql_1);
    if ($result->num_rows > 0) {
        //$row = $result->fetch_assoc();
        $i = 0; //Dat bien i truoc tien de khoi tao chay trong while
        while ($row = $result->fetch_assoc()) {
            $hinh[$i] = $row['duongdan'];
            $idhinh[$i] = $row['id'];
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
                <div class="col-md-12" id="form-cn">
                    <h3 class="text-center mt-2 mb-2">CHỈNH SỬA ĐỘNG VẬT</h3>
                    <form class="chinhsua" id="form-suachua" action="" method="post" enctype="multipart/form-data">

                        <div class="card">
                            <div class="card-body">

                                <div class="form-group row">
                                    <div class="col-12 col-lg-9">
                                        <div class="trang-1" id="trang-1">
                                            <div class="form-group row">
                                                <div class="col-12 col-lg-6">
                                                    <label for="inputSupplierName">Tên khoa học <strong style="color: red;">(*)</strong></label>
                                                    <input type="text" class="form-control" size="20" name="tenkhoahocsua" value='<?php echo $tenkhoahoc; ?>' placeholder="Nhập tên khoa học" required />
                                                    <label for="inputSupplierName">Tên tiếng việt <strong style="color: red;">(*)</strong></label>
                                                    <input type="text" class="form-control" size="20" name="tentiengvietsua" value='<?php echo $tentiengviet; ?>' placeholder="Nhập tên tiếng Việt" />
                                                    <label for="inputSupplierName">Tên tiếng việt <strong style="color: red;">(*)</strong></label>
                                                    <input type="text" class="form-control" size="20" name="tendiaphuongsua" value='<?php echo $tendiaphuong; ?>' placeholder="Nhập tên địa phương" />
                                                    <label for="inputSupplierName">Người thu mẩu <strong style="color: red;">(*)</strong></label>
                                                    <input type="text" class="form-control" size="20" name="nguoithuthapsua" value='<?php echo $nguoithuthap; ?>' placeholder="Nhập người thu mẫu" />
                                                </div>
                                                <div class="col-12 col-lg-6">
                                                    <label for="inputSupplierName">Giá trị sử dụng</label>
                                                    <input type="text" class="form-control" size="20" name="giatrisua" value='<?php echo $giatri; ?>' placeholder="Nhập giá trị sử dụng" />
                                                    <label for="inputSupplierName">Tình trạng bảo tồn theo IUCN</label>
                                                    <input type="text" class="form-control" size="20" name="iucnsua" value='<?php echo $iucn; ?>' placeholder="Nhập IUCN" />
                                                    <label for="inputSupplierName">Tình trạng bảo tồn theo sách đỏ Việt Nam</label>
                                                    <input type="text" class="form-control" size="20" name="sachdosua" value='<?php echo $sachdo; ?>' placeholder="Nhập tình trạng bảo tồn theo sách đỏ Việt Nam" />
                                                    <label for="inputSupplierName">Tình trạng bảo tồn theo CITES (40/2013/TT-BNNPTNT)</label>
                                                    <input type="text" class="form-control" size="20" name="citessua" value='<?php echo $cities; ?>' placeholder="Nhập CITES" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="trang-2" id="trang-2" style="display: none;">
                                            <div class="form-group row">
                                                <div class="col-12 col-lg-6">
                                                    <label for="inputSupplierName">Tình trạng bảo tồn theo Nghị định 32/2006/NĐCP</label>
                                                    <input type="text" class="form-control" size="20" name="ndcpsua" value='<?php echo $nghidinh; ?>' placeholder="Nhập NĐCP" />
                                                    <label for="inputSupplierName">Phân bố</label>
                                                    <input type="text" class="form-control" size="20" name="phanbosua" value='<?php echo $phanbo; ?>' placeholder="Nhập phân bố" />
                                                    <label for="inputSupplierName">Địa điểm</label>
                                                    <input type="text" class="form-control" size="20" name="diadiemsua" value='<?php echo $diadiem; ?>' placeholder="Nhập địa điểm" />
                                                    <label for="inputSupplierName">Ngày thu thập</label>
                                                    <input type="date" class="form-control" size="20" name="ngaythuthapsua" value='<?php echo $ngaythuthap; ?>' placeholder="Ngày thu mẫu" />
                                                    <label for="inputSupplierName">Ngày cập nhật</label>
                                                    <input type="text" class="form-control" size="20" name="ngaycapnhatsua" value='<?php echo $updated_at; ?>' disabled />
                                                    <label for="inputSupplierName">Đường dẫn</label>
                                                    <input type="text" class="form-control" size="20" disabled name="duongdansua" value='<?php echo $duongdan; ?>' placeholder="Nhập đường dẫn" />
                                                    <input type="text" name="id" hidden value="<?php echo $iddv; ?>">
                                                </div>
                                                <div class="col-12 col-lg-6">
                                                    <label for="inputSupplierName">Tình trạng mẫu vật</label>
                                                    <input type="text" class="form-control" size="20" name="tinhtrangsua" value='<?php echo $tinhtrang; ?>' placeholder="hập tình trạng mẫu vật" />
                                                    <label for="inputSupplierName">Sinh cảnh</label>
                                                    <input type="text" class="form-control" size="20" name="sinhcanhsua" value='<?php echo $sinhcanh; ?>' placeholder="Nhập sinh cảnh" />
                                                    <label for="inputSupplierName">Mô tả đặc điểm hình thái</label>
                                                    <textarea class="form-control" id="inputhinhthai" placeholder="Nhập đặc điểm hình thái" name="hinhthaisua" rows="3" class="form-control"><?php echo $hinhthai; ?></textarea>
                                                    <label for="inputSupplierName">Mô tả đặc điểm sinh thái</label>
                                                    <textarea class="form-control" id="inputsinhthai" placeholder="Nhập đặc điểm sinh thái" name="sinhthaisua" rows="3" class="form-control"><?php echo $sinhthai; ?></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="trang-3" id="trang-3" style="display: none;">
                                            <div class="form-group row">
                                                <div class="col-12 col-lg-6">
                                                    <?php
                                                    for ($i = 0; $i < $tongtoado; $i++) {
                                                        if ($td[$i] != null) {
                                                            echo "<div class='col-12 col-lg-12'>";
                                                            echo "<label for='inputAnimail' required='required'>Tọa độ " . ($i + 1) . ":</label>";
                                                            echo "<input type='text' class='form-control' size='20' name='toado" . $i . "' value='" . $td[$i] . "'></td>";
                                                            echo "</div>";
                                                        }
                                                    }
                                                    ?>

                                                    <div class="input_fields_wrap">
                                                        <div class="form-group row">
                                                            <div class="col-12 col-lg-12" style="margin-left:15px;">
                                                                <label for="inputAnimail" required="required">Thêm tọa độ</label>
                                                                <button class="add_field_button btn btn-primary" style="margin-top:10px; margin-left:20px">Thêm tọa độ</button>
                                                                <div>
                                                                    <br>
                                                                    <input type="text" class="form-control" name="inputtoado1" style="width:90%;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-6">
                                                    <div class="form-group row">
                                                        <div class="col-12 col-lg-6">
                                                            <label for="inputAnimail" required="required">Thêm hình <strong style="color: red;">(*)</strong></label>
                                                            <input type="file" name="fileupload[]" id="files" multiple style="width:86%;">
                                                            <div class="form-group">
                                                                <div id="image_preview"></div>
                                                            </div>
                                                        </div>

                                                        <div class="col-12 col-lg-6">
                                                            <div class="form-group row" id="data">

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <p style="font-weight: italic;"><strong style="color: red;">(*)</strong> Thông tin bắt buộc </p>
                                    </div>

                                    <div class="col-12 col-lg-3">
                                        <div class="form-group row">
                                            <div class="col-12 col-lg-12">
                                                <label for="gioisua">Giới <strong style="color: red;">(*)</strong></label>
                                                <select name="gioisua" id="inputgioi" class="form-control">
                                                    <option value='0'><?php echo $gioi; ?></option>
                                                    <?php
                                                    $con = new mysqli("localhost", "root", "", "web_animal");
                                                    $con->set_charset("utf8");
                                                    $sql = "SELECT * FROM gioi ;";
                                                    $result = $con->query($sql);
                                                    if ($result->num_rows > 0) {
                                                        while ($row = $result->fetch_assoc()) {
                                                            echo "<option value='" . $row['id'] . "'>" . $row['ten'] . "</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>

                                                <label for="inputnganh">Ngành <strong style="color: red;">(*)</strong></label>
                                                <select name="nganhsua" id="inputnganh" class="form-control">
                                                    <option value='0'><?php echo $nganh; ?></option>
                                                </select>

                                                <label for="inputlop">Lớp <strong style="color: red;">(*)</strong></label>
                                                <select name="lopsua" id="inputlop" class="form-control">
                                                    <option value='0'><?php echo $lop; ?></option>
                                                </select>

                                                <label for="bosua">Bộ <strong style="color: red;">(*)</strong></label>
                                                <select name="bosua" id="inputbo" class="form-control">
                                                    <option value='0'><?php echo $bo; ?></option>
                                                </select>

                                                <label for="inputho">Họ <strong style="color: red;">(*)</strong></label>
                                                <select name="hosua" id="inputho" class="form-control">
                                                    <option value='0'><?php echo $ho; ?></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer p-2">
                                            <button type="button" class="btn btn-primary col-sm-3" onclick="HideShow_2()">
                                                Quay lại
                                            </button>
                                            <button type="button" class="btn btn-primary col-sm-3" onclick="HideShow()">
                                                Tiếp
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer p-2">
                                    <button type="submit" class="btn btn-primary" name="apply"  value="Upload File" style="float:right; width: 10rem;">
                                        <i class="far fa-edit"></i>
                                        Cập nhật
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
    function DisplayData() { //hàm hiển thị dữ liệu ra

        $.ajax({
            url: 'data_query.php', //lấy dữ liệu ra từ csdl và hiển thị tại 
            type: 'POST',
            data: {
                'res': '<?php echo $iddv; ?>'
            },
            success: function(response) {
                console.log(response);
                $('#data').html(response); //hiển thị dữ liệu ra 
            }
        });

    }
</script>

<script>
    function DeleteData(id) { //hàm hiển thị dữ liệu ra

        $.ajax({
            url: 'delete_animal.php', //lấy dữ liệu ra từ csdl và hiển thị tại 
            type: 'POST',
            data: {
                'id': id,
                'res': '<?php echo $iddv; ?>'
            },
            success: function(response) {
                console.log(response);
                $('#data').html(response); //hiển thị dữ liệu ra 
            }
        });

    }
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js">
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>



<script>
    $(document).ready(function() {
        var fileArr = [];

        //Hien thi hinh anh
        DisplayData();
        //console.log("hi");
        //Xoa hinh anh
        $(document).on('click', '.btn-xoa', function() {
            var dt = $(this).attr("id");
            DeleteData(dt);
        });

        //Upload nhieu hinh
        $("#files").change(function() {
            // check if fileArr length is greater than 0
            if (fileArr.length > 0) fileArr = [];

            $("#image_preview").html("");
            var total_file = document.getElementById("files").files;
            if (!total_file.length) return;
            for (var i = 0; i < total_file.length; i++) {
                if (total_file[i].size > 1048576) {
                    return false;
                } else {
                    fileArr.push(total_file[i]);
                    $("#image_preview").append(
                        "<div class='img-div' id='img-div" +
                        i +
                        "'><img src='" +
                        URL.createObjectURL(event.target.files[i]) +
                        "' class='img-responsive image img-thumbnail' title='" +
                        total_file[i].name +
                        "'><div class='middle'><button id='action-icon' value='img-div" +
                        i +
                        "' class='btn btn-danger' role='" +
                        total_file[i].name +
                        "'><i class='fa fa-trash'></i></button></div></div>"
                    );
                }
            }
        });

        $("body").on("click", "#action-icon", function(evt) {
            var divName = this.value;
            var fileName = $(this).attr("role");
            $(`#${divName}`).remove();

            for (var i = 0; i < fileArr.length; i++) {
                if (fileArr[i].name === fileName) {
                    fileArr.splice(i, 1);
                }
            }
            document.getElementById("files").files = FileListItem(fileArr);
            evt.preventDefault();
        });

        function FileListItem(file) {
            file = [].slice.call(Array.isArray(file) ? file : arguments);
            for (var c, b = (c = file.length), d = !0; b-- && d;)
                d = file[b] instanceof File;
            if (!d)
                throw new TypeError(
                    "expected argument to FileList is File or array of File objects"
                );
            for (b = new ClipboardEvent("").clipboardData || new DataTransfer(); c--;)
                b.items.add(file[c]);
            return b.files;
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
                $(wrapper).append('<div><input type="text" class="form-control" name="inputtoado' + x + '" style="margin-bottom:5px; width:90%; margin-left:15px; margin-top:5px;" /><a href="#" class="remove_field" style="margin-left:15px;">Xóa</a></div>'); //add input box
            }
        });

        $(wrapper).on("click", ".remove_field", function(e) { //user click on remove text
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })
    });
</script>

<!--PHÂN CẤP-->
<script>
    jQuery(document).ready(function($) {
        $("#inputgioi").change(function(event) {
            inputgioiId = $("#inputgioi").val();
            $.post('nganh.php', {
                "inputgioiid": inputgioiId
            }, function(data) {
                $("#inputnganh").html(data);
            });
        });
    });
    jQuery(document).ready(function($) {
        $("#inputnganh").change(function(event) {
            inputnganhId = $("#inputnganh").val();
            $.post('lop.php', {
                "inputnganhid": inputnganhId
            }, function(data) {
                $("#inputlop").html(data);
            });
        });
    });
    jQuery(document).ready(function($) {
        $("#inputlop").change(function(event) {
            inputlopId = $("#inputlop").val();
            $.post('bo.php', {
                "inputlopid": inputlopId
            }, function(data) {
                $("#inputbo").html(data);
            });
        });
    });
    jQuery(document).ready(function($) {
        $("#inputbo").change(function(event) {
            inputboId = $("#inputbo").val();
            $.post('ho.php', {
                "inputboid": inputboId
            }, function(data) {
                $("#inputho").html(data);
            });
        });
    });
</script>

<script>
    function HideShow() {
        let trang_1 = document.getElementById('trang-1').style.display;
        let trang_2 = document.getElementById('trang-2').style.display;
        let trang_3 = document.getElementById('trang-3').style.display;
        if (trang_1 !== "none") {
            document.getElementById('trang-2').style.display = "block";
            document.getElementById('trang-1').style.display = "none";
        }
        if (trang_2 !== "none") {
            document.getElementById('trang-3').style.display = "block";
            document.getElementById('trang-1').style.display = "none";
            document.getElementById('trang-2').style.display = "none";
        }
    }
</script>

<script>
    function HideShow_2() {
        let trang_1 = document.getElementById('trang-1').style.display;
        let trang_2 = document.getElementById('trang-2').style.display;
        let trang_3 = document.getElementById('trang-3').style.display;
        if (trang_2 !== "none") {
            document.getElementById('trang-2').style.display = "none";
            document.getElementById('trang-1').style.display = "block";
        }
        if (trang_3 !== "none") {
            document.getElementById('trang-3').style.display = "none";
            document.getElementById('trang-1').style.display = "none";
            document.getElementById('trang-2').style.display = "block";
        }
    }
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
        $tdo[$i] = $_POST["toado" . $i];
        //echo $tdo[$i] . "<br>";
    }
    /*for ($i = $tongtoado; $i < 5; $i++) {
        $tdo[$i] = $_POST["toado" . $i . ""];
    }*/
    for ($i = 1; $i < 10; $i++) {
        if (!empty($_POST["inputtoado" . $i])) {
            $addtoado[$i] = $_POST["inputtoado" . $i];
            //echo $tdo[$i];
        }
    }
    $tinhtrang = $_POST['tinhtrangsua'];
    $sinhcanh = $_POST['sinhcanhsua'];
    $diadiem = $_POST['diadiemsua'];
    $ngaythuthap = $_POST['ngaythuthapsua'];
    $nguoithumau = $_POST['nguoithuthapsua'];
    $duongdan = to_slug($tenkhoahoc);

    date_default_timezone_set("Asia/Ho_Chi_Minh");
    //$today = now();

    $con = new mysqli("localhost", "root", "", "web_animal");
    $con->set_charset("utf8");
    if($ho != 0){
        $sql = " UPDATE dongvat
        SET tenkhoahoc = '" . $tenkhoahoc . "' ,tentiengviet = '" . $tentiengviet . "',
            tendiaphuong = '" . $tendiaphuong . "' ,ho_id = '" . $ho . "' ,hinhthai = '" . $hinhthai . "' ,sinhthai = '" . $sinhthai . "' ,giatri = '" . $giatri . "' ,iucn = '" . $iucn . "' ,sachdo = '" . $sachdo
        . "' ,nghidinh = '" . $ndcp . "' ,cities = '" . $cities . "' ,phanbo = '" . $phanbo . "' ,tinhtrang = '" . $tinhtrang . "' ,sinhcanh = '" . $sinhcanh
        . "' ,diadiem = '" . $diadiem . "' ,ngaythuthap = '" . $ngaythuthap . "' ,nguoithuthap = '" . $nguoithumau . "' ,updated_at = now(), duongdan = '" . $duongdan . "'
        WHERE id = " . $iddv . ";";
        $con->query($sql);
    }
    //return $sql;
    //echo $sql."<br>";
    

    $sql_1 = "SELECT * from hinhanh WHERE dongvat_id = " . $iddv . ";";
    $result = $con->query($sql_1);
    //$row = $count->fetch_assoc();
    for ($i = 0; $i < $tonghinh; $i++) {
        $row = $result->fetch_assoc();
        move_uploaded_file($hinhanh[$i]['tmp_name'], '../../../uploads/' . $hinhanh[$i]['name']);
        $con = new mysqli("localhost", "root", "", "web_animal");
        $con->set_charset("utf8");
        if (!empty($hinhanh[$i]['name'])) {
            $sql_2 = "UPDATE hinhanh SET duongdan = '" . 'uploads/' . $hinhanh[$i]['name'] . "' WHERE id = " . $row['id'] . ";";
            //echo $sql . "<br>";
            $con->query($sql_2);
        }
    }

    $sql_3 = "SELECT * from toado WHERE dongvat_id = " . $iddv . ";";
    $result = $con->query($sql_3);
    for ($i = 0; $i < $tongtoado; $i++) {
        $row = $result->fetch_assoc();
        $con = new mysqli("localhost", "root", "", "web_animal");
        $con->set_charset("utf8");
        if (!empty($tdo[$i])) {
            $sql_4 = " UPDATE toado SET toado = '" . $tdo[$i] . "' WHERE id = " . $row['id'] . ";";
            //echo $sql_4 . "<br>";
            $con->query($sql_4);
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
            $sql_5 = "insert into hinhanh(duongdan, dongvat_id) values ('" . 'uploads/' . $names[$i] . "', '" . $iddv . "');";
            //echo $sql;
            $con->query($sql_5);
        }
    }

    //for ($i = $tongtoado; $i < 5; $i++) {
    for ($i = 1; $i < 10; $i++) {
        //$row = $result->fetch_assoc();
        $con = new mysqli("localhost", "root", "", "web_animal");
        $con->set_charset("utf8");
        if (!empty($addtoado[$i])) {
            $sql_6 = "insert into toado (toado, dongvat_id) values ('" . $addtoado[$i] . "', '" . $iddv . "');";
            //echo $sql_6 . "<br>";
            $con->query($sql_6);
        }
    }

    header('Location: animal.php');
}
ob_flush();
?>

<?php include '../layout/footer-only.php' ?>