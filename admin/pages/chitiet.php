<?php 
    include '../../config.php';
    include '../layout/header-only.php';
?>

<?php
    $iddv = $_GET['iddv'];
    //echo $iddv;
    $con=new mysqli("localhost","root","","web_animal");
    $con->set_charset("utf8");
    $sql = "SELECT * FROM dongvat WHERE id = ".$iddv.";";
 // echo $sql;
    $result = $con->query($sql);
    if($result -> num_rows > 0) {
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

    $sql_1 = "SELECT * FROM hinhanh WHERE dongvat_id = ".$iddv.";";
//    echo $sql_1;
    $result = $con->query($sql_1);
    if($result -> num_rows > 0) {
        //$row = $result->fetch_assoc();
        $i = 1; //Dat bien i truoc tien de khoi tao chay trong while
        while($row = $result->fetch_assoc()) {
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
                    <h3 class="text-center">THÔNG TIN ĐỘNG VẬT</h3>
                    <ol class="list-numbered">
                        <li>
                            <?php 
                                echo "<b>Tên khoa học</b> </br>";
                                echo $tenkhoahoc;
                            ?>
                        </li>
                        <li>
                        <?php
                            echo "<b>Tên tiếng việt</b> </br>"; 
                            echo $tentiengviet;
                            
                        ?>
                        </li>
                        <li>
                        <?php
                            echo "<b>Tên địa phương</b> </br>"; 
                            echo $tendiaphuong;
                            
                        ?>
                        </li>
                        <li>
                        <?php
                            echo "<b>Giới</b> </br>";
                            echo $gioi;
                            
                        ?>
                        </li>
                        <li>
                        <?php
                            echo "<b>Ngành:</b> </br>"; 
                            echo $nganh;
                            
                        ?>
                        </li>
                        <li>
                        <?php 
                            echo "<b>Lớp:</b> </br>";
                            echo $lop;
                            
                        ?>

                        </li>
                        <li>
                        <?php 
                            echo "<b>Bộ:</b> </br>";
                            echo $bo;
                            
                        ?>
                        </li>
                        <li>
                        <?php 
                            echo "<b>Họ:</b> </br>";
                            echo $ho;
                        ?>
                        </li>
                        <li>
                            <b>Hình ảnh:</b></br>
                            <?php foreach($hinhanhList as $ha): ?>
                                <img src="<?php echo BASE_IMG . $ha["duongdan"] ?>" alt="anh dong vat">
                            <?php endforeach; ?>
                        </li>
                        <li>
                        <?php 
                            echo "<b>Mô tả đặc điểm hình thái:</b> </br>";
                            echo $hinhthai;
                        ?>
                        </li>
                        <li>
                        <?php 
                            echo "<b>Mô tả đặc điểm sinh thái:</b> </br>";
                            echo $sinhthai;
                        ?>
                        </li>
                        <li>
                        <?php 
                            echo "<b>Giá trị sử dụng</b> </br>";
                            echo $giatri;              
                        ?>
                        </li>
                        <li>
                        <?php 
                            echo "<b>Tình trạng bảo tồn theo IUCN:</b> </br>";
                            echo $iucn;   
                        ?>

                        </li>
                        <li>
                        <?php 
                            echo "<b>Tình trạng bảo tồn theo sách đỏ Việt Nam:</b> </br>";
                            echo $sachdo;
                        ?>
                        </li>
                        <li>
                        <?php 
                            echo "<b>Tình trạng bảo tồn theo Nghị định 32/2006/NĐCP:</b> </br>";
                            echo $nghidinh;  
                        ?>
                        </li>
                        <li>
                        <?php 
                            echo "<b>Tình trạng bảo tồn theo CITES (40/2013/TT-BNNPTNT):</b> </br>";
                            echo $cities;
                        ?>
                        </li>
                        <li>
                        <?php 
                            echo "<b>Phân bố:</b> </br>";
                            echo $phanbo;
                        ?>
                        </li>
                        <li>
                            <b>Tọa độ:</b></br>
                            <ol style="margin: 0px">
                            <?php foreach ($toaDoList as $tdo): ?>
                                <li>
                                    <?php echo $tdo["toado"]; ?>
                                </li>
                            <?php endforeach; ?>
                            </ol>
                        </li>
                        
                        <li>
                        <?php 
                            echo "<b>Tình trạng mẫu vật:</b> </br>";
                            echo $tinhtrang;
                        ?>
                        </li>
                        <li>
                        <?php 
                            echo "<b>Sinh cảnh:</b> </br>";
                            echo $sinhcanh;            
                        ?>
                        </li>
                        <li>
                        <?php 
                            echo "<b>Địa điểm:</b> </br>";
                            echo $diadiem;   
                        ?>
                        </li>
                        <li>
                        <?php 
                            echo "<b>Ngày thu mẫu:</b> </br>";
                            echo $ngaythuthap;
                        ?>
                        </li>
                        <li>
                        <?php 
                            echo "<b>Người thu mẫu:</b> </br>";
                            echo $nguoithuthap;
                        ?>
                        </li>
                        <li>
                        <?php 
                            echo "<b>Create at:</b> </br>";
                            echo $created_at;
                        ?>
                        </li>
                        <li>
                        <?php 
                            echo "<b>Update at:</b> </br>";
                            echo $updated_at;
                        ?>
                        </li>
                        <li>
                        <?php 
                            echo "<b>Đường dẫn:</b> </br>";
                            echo $duongdan;
                        ?>
                        </li>
                    </ol>
                </div>
                
            </div>
        </div>
    </div>
</div>

<?php include '../layout/footer-only.php' ?>