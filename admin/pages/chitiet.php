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

    $sql = "SELECT * FROM toado WHERE dongvat_id = ".$iddv."";
 // echo $sql;
    $result = $con->query($sql);
    if($result -> num_rows > 0) {
        $i = 1; //Dat bien i truoc tien de khoi tao chay trong while
        while($row = $result->fetch_assoc()) {
            $toado[$i] = $row['toado'];
 //           echo $toado[$i];
//            echo "<br>";
            $i++;
        }
    }
    
    $hinhanh[1] = isset($hinh[1])?'../../../'.$hinh[1]:null;
    $hinhanh[2] = isset($hinh[2])?'../../../'.$hinh[2]:null;
    $hinhanh[3] = isset($hinh[3])?'../../../'.$hinh[3]:null;
    $hinhanh[4] = isset($hinh[4])?'../../../'.$hinh[4]:null;
    $hinhanh[5] = isset($hinh[5])?'../../../'.$hinh[5]:null;

    $td1 = isset($toado[1])?$toado[1]:null;
    $td2 = isset($toado[2])?$toado[2]:null;
    $td3 = isset($toado[3])?$toado[3]:null;
    $td4 = isset($toado[4])?$toado[4]:null;
    $td5 = isset($toado[5])?$toado[5]:null;


?>

<?php include '../layout/header.php'; ?>
<div class="layout-wrap">
    <div class="layout-left" style="height:auto;">
        <div class="menu-left">
            <ul class="nav justify-content-center flex-column">
                <li class="nav-item nav-item-animal">
                    <a class="nav-link text-light" href="<?php echo BASE?>admin/pages/animal.php">
                        <i class="fas fa-frog"></i></i>&nbsp; Động vật
                    </a>
                </li>
                <li class="nav-item nav-item-user">
                    <a class="nav-link text-light" href="<?php echo BASE?>admin/pages/users.php">
                        <i class="fas fa-users"></i>&nbsp; Người dùng
                    </a>
                </li>
                <li class="nav-item nav-item-account">
                    <a class="nav-link text-light" href="<?php echo BASE?>admin/pages/account.php">
                        <i class="fas fa-user-circle"></i>&nbsp;Tài khoản
                    </a>
                </li>
                <li class="nav-item nav-item-install">
                    <a class="nav-link text-light" href="">
                        <i class="fas fa-cog"></i>&nbsp;Cài đặt
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="layout-right">
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
            <?php
                echo "<b>Hình ảnh:</b> </br>"; 
                for($i=1; $i <= 5; $i ++){
                    if($hinhanh[$i] != null){
                        echo "<img src='".$hinhanh[$i]."' alt='hinhdongvat' style='width: 100px; height: 100px;'>";
                    }
                    
                }
                /*echo "<img src='".$hinhanh1."' alt='hinhdongvat' style='width: 100px; height: 100px;'>";
                echo "<img src='".$hinhanh2."' alt='hinhdongvat' style='width: 100px; height: 100px;'>";
                echo "<img src='".$hinhanh3."' alt='hinhdongvat' style='width: 100px; height: 100px;'>";
                echo "<img src='".$hinhanh4."' alt='hinhdongvat' style='width: 100px; height: 100px;'>";
                echo "<img src='".$hinhanh5."' alt='hinhdongvat' style='width: 100px; height: 100px;'>";*/
            ?>
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
            <?php 
                echo "<b>Tọa độ 1:</b> </br>";
                echo $td1;
            ?>
            </li>
            <li>
            <?php 
                echo "<b>Tọa độ 2:</b> </br>";
                echo $td2;
            ?>
            </li>
            <li>
            <?php 
                echo "<b>Tọa độ 3:</b> </br>";
                echo $td3;      
            ?>
            </li>
            <li>
            <?php 
                echo "<b>Tọa độ 4:</b> </br>";
                echo $td4;   
            ?>
            </li>
            <li>
            <?php 
                echo "<b>Tọa độ 5:</b> </br>";
                echo $td5;
            ?>
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

<!--    <h3 class="text-center">THÔNG TIN ĐỘNG VẬT</h3>
    <form class="chitiet" id="form-chitiet">
        <div style="overflow-x:auto; max-height: 800px">
            
            <table class="table table-striped table-bordered">
                <thead class="bg-primary text-center">
                    <tr>
                        <th>Tên khoa học</th>
                        <th>Tên tiếng Việt</th>
                        <th>Tên địa phương</th>
                        <th>Giới</th>
                        <th>Ngành</th>
                        <th>Lớp</th>
                        <th>Bộ</th>
                        <th>Họ</th>
                        <th>Hình 1</th>
                        <th>Hình 2</th>
                        <th>Hình 3</th>
                        <th>Hình 4</th>
                        <th>Hình 5</th>
                        <th>Mô tả đặc điểm hình thái</th>
                        <th>Mô tả đặc điểm sinh thái</th>
                        <th>Giá trị sử dụng</th>
                        <th>Tình trạng bảo tồn theo IUCN</th>
                        <th>Tình trạng bảo tồn theo sách đỏ Việt Nam</th>
                        <th>Tình trạng bảo tồn theo Nghị định 32/2006/NĐCP</th>
                        <th>Tình trạng bảo tồn theo CITES (40/2013/TT-BNNPTNT)</th>
                        <th>Phân bố</th>
                        <th>Tọa độ 1</th>
                        <th>Tọa độ 2</th>
                        <th>Tọa độ 3</th>
                        <th>Tọa độ 4</th>
                        <th>Tọa độ 5</th>
                        <th>Tình trạng mẫu vật</th>
                        <th>Sinh cảnh</th>
                        <th>Địa điểm</th>
                        <th>Ngày thu mẫu</th>
                        <th>Người thu mẫu</th>
                        <th>Create at</th>
                        <th>Update at</th>
                        <th>Đường dẫn</th>
                    </tr>
                </thead>    
                <tbody>
                    <?php
/*                        echo "<tr>";
                        echo "<td>".$tenkhoahoc."</td>";
                        echo "<td>".$tentiengviet."</td>";
                        echo "<td>".$tendiaphuong."</td>";
                        echo "<td>".$gioi."</td>";
                        echo "<td>".$nganh."</td>";
                        echo "<td>".$lop."</td>";
                        echo "<td>".$bo."</td>";
                        echo "<td>".$ho."</td>";
                        echo "<td><img src='".$hinhanh1."' alt='hinhdongvat' class='imgSize' style='width: 100px; height: 100px;'></td>";
                        echo "<td><img src='".$hinhanh2."' alt='hinhdongvat' class='imgSize' style='width: 100px; height: 100px;'></td>";
                        echo "<td><img src='".$hinhanh3."' alt='hinhdongvat' class='imgSize' style='width: 100px; height: 100px;'></td>";
                        echo "<td><img src='".$hinhanh4."' alt='hinhdongvat' class='imgSize' style='width: 100px; height: 100px;'></td>";
                        echo "<td><img src='".$hinhanh5."' alt='hinhdongvat' class='imgSize' style='width: 100px; height: 100px;'></td>";
                        echo "<td>".$hinhthai."</td>";
                        echo "<td>".$sinhthai."</td>";
                        echo "<td>".$giatri."</td>";
                        echo "<td>".$iucn."</td>";
                        echo "<td>".$sachdo."</td>";
                        echo "<td>".$nghidinh."</td>";
                        echo "<td>".$cities."</td>";
                        echo "<td>".$phanbo."</td>";
                        echo "<td>".$td1."</td>";
                        echo "<td>".$td2."</td>";
                        echo "<td>".$td3."</td>";
                        echo "<td>".$td4."</td>";
                        echo "<td>".$td5."</td>";
                        echo "<td>".$tinhtrang."</td>";
                        echo "<td>".$sinhcanh."</td>";
                        echo "<td>".$diadiem."</td>";
                        echo "<td>".$ngaythuthap."</td>";
                        echo "<td>".$nguoithuthap."</td>";
                        echo "<td>".$created_at."</td>";
                        echo "<td>".$updated_at."</td>";
                        echo "<td>".$duongdan."</td>";
                        echo "</tr>"
*/                    ?> 
                </tbody>
            </table>
        </div>
    </form>
</div>
