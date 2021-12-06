<?php
// include '../../config.php';
include '../layout/header-only.php';
?>

<?php
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
    /* $gioi = $row['gioi'];
        $nganh = $row['nganh'];
        $lop = $row['lop'];
        $bo = $row['bo'];*/
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
    $i = 1; //Dat bien i truoc tien de khoi tao chay trong while
    while ($row = $result->fetch_assoc()) {
        $hinh[$i] = $row['duongdan'];
        //           echo $hinh[$i];
        //           echo "<br>";
        $i++;
    }
}

// $sql = "SELECT * FROM toado WHERE dongvat_id = ".$iddv."";

$hinhanhList = $db->query('Select * from hinhanh where dongvat_id = ' . intval($iddv))->fetchAll();
$toaDoList = $db->query('Select * from toado where dongvat_id = ' . intval($iddv))->fetchAll();

// echo $sql;
//     $result = $con->query($sql);
//     if($result -> num_rows > 0) {
//         $i = 1; //Dat bien i truoc tien de khoi tao chay trong while
//         while($row = $result->fetch_assoc()) {
//             $toado[$i] = $row['toado'];
//  //           echo $toado[$i];
// //            echo "<br>";
//             $i++;
//         }
//     }

// $hinhanh[1] = isset($hinh[1])?'../../../'.$hinh[1]:null;
// $hinhanh[2] = isset($hinh[2])?'../../../'.$hinh[2]:null;
// $hinhanh[3] = isset($hinh[3])?'../../../'.$hinh[3]:null;
// $hinhanh[4] = isset($hinh[4])?'../../../'.$hinh[4]:null;
// $hinhanh[5] = isset($hinh[5])?'../../../'.$hinh[5]:null;

// $td1 = isset($toado[1])?$toado[1]:null;
// $td2 = isset($toado[2])?$toado[2]:null;
// $td3 = isset($toado[3])?$toado[3]:null;
// $td4 = isset($toado[4])?$toado[4]:null;
// $td5 = isset($toado[5])?$toado[5]:null;


?>

<div class="layout-wrap">
    <div class="layout-bg"></div>
    <div class="layout-left">
        <?php include '../layout/menu-left.php'; ?>
    </div>
    <div class="layout-right">
        <div class="layout-right-header">
            <?php include '../layout/header.php'; ?>
        </div>
        <div class="layout-right-content">
            <div class="layout-right-content-details">
                <h3 class="text-center">THÔNG TIN CHI TIẾT ĐỘNG VẬT</h3>
                <div class="card chi-tiet">
                    <div class="card-body">

                        <div class="form-group row">
                            <div class="col-12 col-lg-9">
                                <div class="trang-1" id="trang-1">
                                    <div class="form-group row">
                                        <div class="col-12 col-lg-6">
                                            <div class="form-group">
                                                <b for="pSupplierName">Tên khoa học</b>
                                                <p size="20" name="tenkhoahocsua" value='' placeholder="Nhập tên khoa học" required><?php echo $tenkhoahoc; ?></p>
                                            </div>
                                            <div class="form-group">
                                                <b for="pSupplierName">Tên tiếng việt</b>
                                                <p size="20" name="tentiengvietsua" value='' placeholder="Nhập tên tiếng Việt"><?php echo $tentiengviet; ?></p>
                                            </div>
                                            <div class="form-group">
                                                <b for="pSupplierName">Tên địa phương</b>
                                                <p size="20" name="tendiaphuongsua" value='' placeholder="Nhập tên địa phương"><?php echo $tendiaphuong; ?></p>
                                            </div>
                                            <div class="form-group">
                                                <b for="pSupplierName">Người thu mẩu</b>
                                                <p size="20" name="nguoithuthapsua" value='' placeholder="Nhập người thu mẫu"><?php echo $nguoithuthap; ?></p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <div class="form-group">
                                                <b for="pSupplierName">Giá trị sử dụng</b>
                                                <p size="20" name="giatrisua" value='' placeholder="Nhập giá trị sử dụng"><?php echo $giatri; ?></p>
                                            </div>
                                            <div class="form-group">
                                                <b for="pSupplierName">Tình trạng bảo tồn theo IUCN</b>
                                                <p size="20" name="iucnsua" value='' placeholder="Nhập IUCN"><?php echo $iucn; ?></p>
                                            </div>
                                            <div class="form-group">
                                                <b for="pSupplierName">Tình trạng bảo tồn theo sách đỏ Việt Nam</b>
                                                <p size="20" name="sachdosua" value='' placeholder="Nhập tình trạng bảo tồn theo sách đỏ Việt Nam"><?php echo $sachdo; ?></p>
                                            </div>
                                            <div class="form-group">
                                                <b for="pSupplierName">Tình trạng bảo tồn theo CITES (40/2013/TT-BNNPTNT)</b>
                                                <p size="20" name="citessua" value='' placeholder="Nhập CITES"><?php echo $cities; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="trang-2" id="trang-2" style="display: none;">
                                    <div class="form-group row">
                                        <div class="col-12 col-lg-4">
                                            <div class="form-group">
                                                <b for="pSupplierName">Tình trạng bảo tồn theo Nghị định 32/2006/NĐCP</b>
                                                <p size="20" name="ndcpsua" value='' placeholder="Nhập NĐCP"><?php echo $nghidinh; ?></p>
                                            </div>
                                            <div class="form-group">
                                                <b for="pSupplierName">Phân bố</b>
                                                <p size="20" name="phanbosua" value='' placeholder="Nhập phân bố"><?php echo $phanbo; ?></p>
                                            </div>
                                            <div class="form-group">
                                                <b for="pSupplierName">Địa điểm</b>
                                                <p size="20" name="diadiemsua" value='' placeholder="Nhập địa điểm"><?php echo $diadiem; ?></p>
                                            </div>
                                            <div class="form-group">
                                                <b for="pSupplierName">Ngày thu thập</b>
                                                <p type="date" size="20" name="ngaythuthapsua" value='' placeholder="Ngày thu mẫu"><?php echo $ngaythuthap; ?></p>
                                            </div>
                                            <div class="form-group">
                                                <b for="pSupplierName">Ngày cập nhật</b>
                                                <p size="20" name="ngaycapnhatsua" value='' disabled><?php echo $updated_at; ?></p>
                                            </div>
                                            <div class="form-group">
                                                <b for="pSupplierName">Đường dẫn</b>
                                                <p size="20" disabled name="duongdansua" value='' placeholder="Nhập đường dẫn"><?php echo $duongdan; ?></p>
                                                <p name="id" hidden value="<?php echo $iddv; ?>">
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-8">
                                            <div class="form-group">
                                                <b for="pSupplierName">Tình trạng mẫu vật</b>
                                                <p size="20" name="tinhtrangsua" value='' placeholder="hập tình trạng mẫu vật"><?php echo $tinhtrang; ?></p>
                                            </div>
                                            <div class="form-group">
                                                <b for="pSupplierName">Sinh cảnh</b>
                                                <p size="20" name="sinhcanhsua" value='' placeholder="Nhập sinh cảnh"><?php echo $sinhcanh; ?></p>
                                            </div>
                                            <div class="form-group">
                                                <b for="pSupplierName">Mô tả đặc điểm hình thái</b>
                                                <textarea id="phinhthai" placeholder="Nhập đặc điểm hình thái" name="hinhthaisua" class="form-control" rows="3"><?php echo $hinhthai; ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <b for="pSupplierName">Mô tả đặc điểm sinh thái</b>
                                                <textarea id="psinhthai" placeholder="Nhập đặc điểm sinh thái" name="sinhthaisua" class="form-control" rows="3"><?php echo $sinhthai; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="trang-3" id="trang-3" style="display: none;">
                                    <div class="form-group row">
                                        <div class="col-12 col-lg-5">
                                            <div class="form-group">
                                                <ol style="margin: 0px">
                                                    <b>Các tạo độ xác định:</b></br>
                                                    <?php foreach ($toaDoList as $tdo) : ?>
                                                        <li>
                                                            <?php echo $tdo["toado"]; ?>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ol>

                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-7">
                                            <div class="form-group row" style="width: 240%;">
                                                <div class="col-12 col-lg-4">
                                                    <div class="form-group">
                                                        <b>Hình ảnh:</b></br>
                                                        <?php foreach ($hinhanhList as $ha) : ?>
                                                            <img src="<?php echo BASE_IMG . $ha["duongdan"] ?>" alt="anh dong vat" style='width: 100px; height: 100px; border-radius: 50px; margin-top: 20px; object-fit: cover;'>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-3">
                                <div class="form-group row">
                                    <div class="col-12 col-lg-12">
                                        <div class="form-group">
                                            <?php
                                            echo "<b>Giới</b> </br>";
                                            if ($gioi != null) {
                                                echo $gioi;
                                            } else {
                                                echo "Không xác định được Giới động vật";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-12">
                                        <div class="form-group">
                                            <?php
                                            echo "<b>Ngành:</b> </br>";
                                            if ($nganh != null) {
                                                echo $nganh;
                                            } else {
                                                echo "Không xác định được Ngành động vật";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-12">
                                        <div class="form-group">
                                            <?php
                                            echo "<b>Lớp:</b> </br>";
                                            if ($lop != null) {
                                                echo $lop;
                                            } else {
                                                echo "Không xác định được Lớp động vật";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-12">
                                        <div class="form-group">
                                            <?php
                                            echo "<b>Bộ:</b> </br>";
                                            if ($bo != null) {
                                                echo $bo;
                                            } else {
                                                echo "Không xác định được Bộ động vật";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-12">
                                        <div class="form-group">
                                            <?php
                                            echo "<b>Họ:</b> </br>";
                                            echo $ho;
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer p-2">
                                    <button type="button" class="btn btn-info rounded-0 btn-sm" onclick="HideShow_2()" style="width:5rem;">
                                        Quay lại
                                    </button>
                                    <button type="button" class="btn btn-info rounded-0 btn-sm" onclick="HideShow()" style="width:5rem;">
                                        Tiếp
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
    <?php include '../layout/footer-only.php' ?>