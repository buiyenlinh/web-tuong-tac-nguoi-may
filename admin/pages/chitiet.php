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
                <h3 class="text-center">TH??NG TIN CHI TI???T ?????NG V???T</h3>
                <div class="card chi-tiet">
                    <div class="card-body">

                        <div class="form-group row">
                            <div class="col-12 col-lg-9">
                                <div class="trang-1" id="trang-1">
                                    <div class="form-group row">
                                        <div class="col-12 col-lg-6">
                                            <div class="form-group">
                                                <b for="pSupplierName">T??n khoa h???c</b>
                                                <p size="20" name="tenkhoahocsua" value='' placeholder="Nh???p t??n khoa h???c" required><?php echo $tenkhoahoc; ?></p>
                                            </div>
                                            <div class="form-group">
                                                <b for="pSupplierName">T??n ti???ng vi???t</b>
                                                <p size="20" name="tentiengvietsua" value='' placeholder="Nh???p t??n ti???ng Vi???t"><?php echo $tentiengviet; ?></p>
                                            </div>
                                            <div class="form-group">
                                                <b for="pSupplierName">T??n ?????a ph????ng</b>
                                                <p size="20" name="tendiaphuongsua" value='' placeholder="Nh???p t??n ?????a ph????ng"><?php echo $tendiaphuong; ?></p>
                                            </div>
                                            <div class="form-group">
                                                <b for="pSupplierName">Ng?????i thu m???u</b>
                                                <p size="20" name="nguoithuthapsua" value='' placeholder="Nh???p ng?????i thu m???u"><?php echo $nguoithuthap; ?></p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <div class="form-group">
                                                <b for="pSupplierName">Gi?? tr??? s??? d???ng</b>
                                                <p size="20" name="giatrisua" value='' placeholder="Nh???p gi?? tr??? s??? d???ng"><?php echo $giatri; ?></p>
                                            </div>
                                            <div class="form-group">
                                                <b for="pSupplierName">T??nh tr???ng b???o t???n theo IUCN</b>
                                                <p size="20" name="iucnsua" value='' placeholder="Nh???p IUCN"><?php echo $iucn; ?></p>
                                            </div>
                                            <div class="form-group">
                                                <b for="pSupplierName">T??nh tr???ng b???o t???n theo s??ch ????? Vi???t Nam</b>
                                                <p size="20" name="sachdosua" value='' placeholder="Nh???p t??nh tr???ng b???o t???n theo s??ch ????? Vi???t Nam"><?php echo $sachdo; ?></p>
                                            </div>
                                            <div class="form-group">
                                                <b for="pSupplierName">T??nh tr???ng b???o t???n theo CITES (40/2013/TT-BNNPTNT)</b>
                                                <p size="20" name="citessua" value='' placeholder="Nh???p CITES"><?php echo $cities; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="trang-2" id="trang-2" style="display: none;">
                                    <div class="form-group row">
                                        <div class="col-12 col-lg-4">
                                            <div class="form-group">
                                                <b for="pSupplierName">T??nh tr???ng b???o t???n theo Ngh??? ?????nh 32/2006/N??CP</b>
                                                <p size="20" name="ndcpsua" value='' placeholder="Nh???p N??CP"><?php echo $nghidinh; ?></p>
                                            </div>
                                            <div class="form-group">
                                                <b for="pSupplierName">Ph??n b???</b>
                                                <p size="20" name="phanbosua" value='' placeholder="Nh???p ph??n b???"><?php echo $phanbo; ?></p>
                                            </div>
                                            <div class="form-group">
                                                <b for="pSupplierName">?????a ??i???m</b>
                                                <p size="20" name="diadiemsua" value='' placeholder="Nh???p ?????a ??i???m"><?php echo $diadiem; ?></p>
                                            </div>
                                            <div class="form-group">
                                                <b for="pSupplierName">Ng??y thu th???p</b>
                                                <p type="date" size="20" name="ngaythuthapsua" value='' placeholder="Ng??y thu m???u"><?php echo $ngaythuthap; ?></p>
                                            </div>
                                            <div class="form-group">
                                                <b for="pSupplierName">Ng??y c???p nh???t</b>
                                                <p size="20" name="ngaycapnhatsua" value='' disabled><?php echo $updated_at; ?></p>
                                            </div>
                                            <div class="form-group">
                                                <b for="pSupplierName">???????ng d???n</b>
                                                <p size="20" disabled name="duongdansua" value='' placeholder="Nh???p ???????ng d???n"><?php echo $duongdan; ?></p>
                                                <p name="id" hidden value="<?php echo $iddv; ?>">
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-8">
                                            <div class="form-group">
                                                <b for="pSupplierName">T??nh tr???ng m???u v???t</b>
                                                <p size="20" name="tinhtrangsua" value='' placeholder="h???p t??nh tr???ng m???u v???t"><?php echo $tinhtrang; ?></p>
                                            </div>
                                            <div class="form-group">
                                                <b for="pSupplierName">Sinh c???nh</b>
                                                <p size="20" name="sinhcanhsua" value='' placeholder="Nh???p sinh c???nh"><?php echo $sinhcanh; ?></p>
                                            </div>
                                            <div class="form-group">
                                                <b for="pSupplierName">M?? t??? ?????c ??i???m h??nh th??i</b>
                                                <textarea id="phinhthai" placeholder="Nh???p ?????c ??i???m h??nh th??i" name="hinhthaisua" class="form-control" rows="3"><?php echo $hinhthai; ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <b for="pSupplierName">M?? t??? ?????c ??i???m sinh th??i</b>
                                                <textarea id="psinhthai" placeholder="Nh???p ?????c ??i???m sinh th??i" name="sinhthaisua" class="form-control" rows="3"><?php echo $sinhthai; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="trang-3" id="trang-3" style="display: none;">
                                    <div class="form-group row">
                                        <div class="col-12 col-lg-5">
                                            <div class="form-group">
                                                <ol style="margin: 0px">
                                                    <b>C??c t???o ????? x??c ?????nh:</b></br>
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
                                                        <b>H??nh ???nh:</b></br>
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
                                            echo "<b>Gi???i</b> </br>";
                                            if ($gioi != null) {
                                                echo $gioi;
                                            } else {
                                                echo "Kh??ng x??c ?????nh ???????c Gi???i ?????ng v???t";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-12">
                                        <div class="form-group">
                                            <?php
                                            echo "<b>Ng??nh:</b> </br>";
                                            if ($nganh != null) {
                                                echo $nganh;
                                            } else {
                                                echo "Kh??ng x??c ?????nh ???????c Ng??nh ?????ng v???t";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-12">
                                        <div class="form-group">
                                            <?php
                                            echo "<b>L???p:</b> </br>";
                                            if ($lop != null) {
                                                echo $lop;
                                            } else {
                                                echo "Kh??ng x??c ?????nh ???????c L???p ?????ng v???t";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-12">
                                        <div class="form-group">
                                            <?php
                                            echo "<b>B???:</b> </br>";
                                            if ($bo != null) {
                                                echo $bo;
                                            } else {
                                                echo "Kh??ng x??c ?????nh ???????c B??? ?????ng v???t";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-12">
                                        <div class="form-group">
                                            <?php
                                            echo "<b>H???:</b> </br>";
                                            echo $ho;
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer p-2">
                                    <button type="button" class="btn btn-info rounded-0 btn-sm" onclick="HideShow_2()" style="width:5rem;">
                                        Quay l???i
                                    </button>
                                    <button type="button" class="btn btn-info rounded-0 btn-sm" onclick="HideShow()" style="width:5rem;">
                                        Ti???p
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