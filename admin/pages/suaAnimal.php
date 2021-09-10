<?php 
    include '../../config.php';
    include '../layout/header-only.php';
?>

<?php
    if(isset($_GET["iddv"])) {
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
        
        $hinhanh1 = isset($hinh[1])?'../../../'.$hinh[1]:null;
        $hinhanh2 = isset($hinh[2])?'../../../'.$hinh[2]:null;
        $hinhanh3 = isset($hinh[3])?'../../../'.$hinh[3]:null;
        $hinhanh4 = isset($hinh[4])?'../../../'.$hinh[4]:null;
        $hinhanh5 = isset($hinh[5])?'../../../'.$hinh[5]:null;

        $td1 = isset($toado[1])?$toado[1]:null;
        $td2 = isset($toado[2])?$toado[2]:null;
        $td3 = isset($toado[3])?$toado[3]:null;
        $td4 = isset($toado[4])?$toado[4]:null;
        $td5 = isset($toado[5])?$toado[5]:null;
    }
?>
<?php include '../layout/header.php'; ?>
<div class="layout-wrap">
    <div class="layout-left">
        <?php include '../layout/menu-left.php'; ?>
    </div>
    <div class="layout-right">
    <h3 class="text-center mt-4 mb-2">CHỈNH SỬA ĐỘNG VẬT</h3>
    <form class="chinhsua" id="form-suachua" action="" method="post" enctype="multipart/form-data">
        <div class="gridtable">    
            <table class="table table-striped table-bordered">
                <thead class="bg-info text-center">
                    <tr>
                        <th>Thông tin</th>
                        <th>Dữ liệu</th>
                    </tr>
                </thead>    
                <tbody>
                    <tr>
                        <td>Tên khoa học:</td>
                        <td><input type="text" size="20" name="tenkhoahocsua" value='<?php echo $tenkhoahoc; ?>' /></td>
                    </tr>
                    <tr>
                        <td>Tên tiếng Việt:</td>
                        <td><input type="text" size="20" name="tentiengvietsua" value='<?php echo $tentiengviet; ?>' /></td>
                    </tr>
                    <tr>
                        <td>Tên địa phương:</td>
                        <td><input type="text" size="20" name="tendiaphuongsua" value='<?php echo $tendiaphuong; ?>' /></td>
                    </tr>
                    <tr>
                        <td>Giới:</td>
                        <td><input type="text" size="20" name="gioisua" value='<?php echo $gioi; ?>' /></td>
                    </tr>
                    <tr>
                        <td>Bộ:</td>
                        <td><input type="text" size="20" name="nganhsua" value='<?php echo $bo; ?>' /></td>
                    </tr>
                    <tr>
                        <td>Lớp:</td>
                        <td><input type="text" size="20" name="lopsua" value='<?php echo $lop; ?>' /></td>
                    </tr>
                    <tr>
                        <td>Ngành:</td>
                        <td><input type="text" size="20" name="bosua" value='<?php echo $nganh; ?>' /></td>
                    </tr>
                    <tr>
                        <td>Họ:</td>
                        <td><input type="text" size="20" name="hosua" value='<?php echo $ho; ?>' /></td>
                    </tr>
                    <tr>
                        <td>Hình 1:</td>
                        <td><input type="file" size="20" name="hinh1sua" />
                        <?php 
                            if($hinhanh1 != null){
                                echo "<img src='".$hinhanh1."' alt='hinhdongvat' class='imgSize' style='width: 100px; height: 100px;'>";
                            }
                         
                        ?>
                    </td>
                    </tr>
                    <tr>
                        <td>Hình 2:</td>
                        <td><input type="file" size="20" name="hinh2sua" />
                        <?php
                            if($hinhanh2 != null){
                                echo "<img src='".$hinhanh2."' alt='hinhdongvat' class='imgSize' style='width: 100px; height: 100px;'>";
                            }
                          
                         ?>
                    </td>
                    </tr>
                    <tr>
                        <td>Hình 3:</td>
                        <td><input type="file" size="20" name="hinh3sua" />
                        <?php
                        if($hinhanh3 != null){
                            echo "<img src='".$hinhanh3."' alt='hinhdongvat' class='imgSize' style='width: 100px; height: 100px;'>";
                        }
                          
                         ?>
                    </td>
                    </tr>
                    <tr>
                        <td>Hình 4:</td>
                        <td><input type="file" size="20" name="hinh4sua" />
                        <?php 
                        if($hinhanh4 != null){
                            echo "<img src='".$hinhanh4."' alt='hinhdongvat' class='imgSize' style='width: 100px; height: 100px;'>";
                        }
                         
                        ?>                    
                    </td>
                    </tr>
                    <tr>
                        <td>Hình 5:</td>
                        <td><input type="file" size="20" name="hinh5sua" />
                        <?php 
                        if($hinhanh5 != null){
                            echo "<img src='".$hinhanh5."' alt='hinhdongvat' class='imgSize' style='width: 100px; height: 100px;'>"; 
                        }
                        
                        ?>
                    </td>
                    </tr>
                    <tr>
                        <td>Mô tả đặc điểm hình thái:</td>
                        <td><input type="text" size="20" name="hinhthaisua" value='<?php echo $hinhthai; ?>' /></td>
                    </tr>
                    <tr>
                        <td>Mô tả đặc điểm sinh thái:</td>
                        <td><input type="text" size="20" name="sinhthaisua" value='<?php echo $sinhthai; ?>' /></td>
                    </tr>
                    <tr>
                        <td>Giá trị sử dụng:</td>
                        <td><input type="text" size="20" name="giatrisua" value='<?php echo $giatri; ?>' /></td>
                    </tr>
                    <tr>
                        <td>Tình trạng bảo tồn theo IUCN:</td>
                        <td><input type="text" size="20" name="iucnsua" value='<?php echo $iucn; ?>' /></td>
                    </tr>
                    <tr>
                        <td>Tình trạng bảo tồn theo sách đỏ Việt Nam:</td>
                        <td><input type="text" size="20" name="sachdosua" value='<?php echo $sachdo; ?>' /></td>
                    </tr>
                    <tr>
                        <td>Tình trạng bảo tồn theo Nghị định 32/2006/NĐCP:</td>
                        <td><input type="text" size="20" name="ndcpsua" value='<?php echo $nghidinh; ?>' /></td>
                    </tr>
                    <tr>
                        <td>Tình trạng bảo tồn theo CITES (40/2013/TT-BNNPTNT):</td>
                        <td><input type="text" size="20" name="citessua" value='<?php echo $cities; ?>' /></td>
                    </tr>
                    <tr>
                        <td>Phân bố:</td>
                        <td><input type="text" size="20" name="phanbosua" value='<?php echo $phanbo; ?>' /></td>
                    </tr>
                    <tr>
                        <td>Tọa độ 1:</td>
                        <td><input type="text" size="20" name="toado1sua" value='<?php echo $td1; ?>' /></td>
                    </tr>
                    <tr>
                        <td>Tọa độ 2:</td>
                        <td><input type="text" size="20" name="toado2sua" value='<?php echo $td2; ?>' /></td>
                    </tr>
                    <tr>
                        <td>Tọa độ 3:</td>
                        <td><input type="text" size="20" name="toado3sua" value='<?php echo $td3; ?>' /></td>
                    </tr>
                    <tr>
                        <td>Tọa độ 4:</td>
                        <td><input type="text" size="20" name="toado4sua" value='<?php echo $td4; ?>' /></td>
                    </tr>
                    <tr>
                        <td>Tọa độ 5:</td>
                        <td><input type="text" size="20" name="toado5sua" value='<?php echo $td5; ?>' /></td>
                    </tr>
                    <tr>
                        <td>Tình trạng mẫu vật:</td>
                        <td><input type="text" size="20" name="tinhtrangsua" value='<?php echo $tinhtrang; ?>' /></td>
                    </tr>
                    <tr>
                        <td>Sinh cảnh:</td>
                        <td><input type="text" size="20" name="sinhcanhsua" value='<?php echo $sinhcanh; ?>' /></td>
                    </tr>
                    <tr>
                        <td>Địa điểm:</td>
                        <td><input type="text" size="20" name="diadiemsua" value='<?php echo $diadiem; ?>' /></td>
                    </tr>
                    <tr>
                        <td>Ngày thu mẫu:</td>
                        <td><input type="text" size="20" name="ngaythuthapsua" value='<?php echo $ngaythuthap; ?>' /></td>
                    </tr>
                    <tr>
                        <td>Người thu mẫu:</td>
                        <td><input type="text" size="20" name="nguoithuthapsua" value='<?php echo $nguoithuthap; ?>' /></td>
                    </tr>
                    <tr>
                        <td>Đường dẫn:</td>
                        <td><input type="text" size="20" name="duongdansua" value='<?php echo $duongdan; ?>' /></td>
                        <input type="text" name="id" hidden value="<?php echo $iddv;?>">
                    </tr>
                </tbody>
            </table>
        </div>
        <button type="submit" class="btn btn-info rounded-0" name="apply" value="Upload File" style="float:right;">Cập nhật</button>
    </form>
</div>
<?php
    //session_start();
    if(isset($_POST["apply"])) {
        $iddv = $_POST['id'];
        $tenkhoahoc = $_POST['tenkhoahocsua'];
        $tentiengviet = $_POST['tentiengvietsua'];
        $tendiaphuong = $_POST['tendiaphuongsua'];
        $gioi = $_POST['gioisua'];
        $nganh = $_POST['nganhsua'];
        $lop = $_POST['lopsua'];
        $bo = $_POST['bosua'];
        $ho = $_POST['hosua'];
        $hinhanh[0]= $_FILES['hinh1sua'];
        $hinhanh[1] = $_FILES['hinh2sua'];
        $hinhanh[2] = $_FILES['hinh3sua'];
        $hinhanh[3] = $_FILES['hinh4sua'];
        $hinhanh[4] = $_FILES['hinh5sua'];
        $hinhthai = $_POST['hinhthaisua'];
        $sinhthai = $_POST['sinhthaisua'];
        $giatri = $_POST['giatrisua'];
        $iunc = $_POST['iucnsua'];
        $sachdo = $_POST['sachdosua'];
        $ndcp = $_POST['ndcpsua'];
        $cites = $_POST['citessua'];
        $phanbo = $_POST['phanbosua'];
        $tdo[0] = $_POST['toado1sua'];
        $tdo[1] = $_POST['toado2sua'];
        $tdo[2] = $_POST['toado3sua'];
        $tdo[3] = $_POST['toado4sua'];
        $tdo[4] = $_POST['toado5sua'];
        $tinhtrang = $_POST['tinhtrangsua'];
        $sinhcanh = $_POST['sinhcanhsua'];
        $diadiem = $_POST['diadiemsua'];
        $ngaythuthap = $_POST['ngaythuthapsua'];
        $nguoithumau = $_POST['nguoithuthapsua'];
        $duongdan = $_POST['duongdansua'];

        $con=new mysqli("localhost","root","","web_animal");
        $con->set_charset("utf8");
        $sql = " UPDATE dongvat
        SET tenkhoahoc = '".$tenkhoahoc."' ,tentiengviet = '".$tentiengviet."',
            tendiaphuong = '".$tendiaphuong."' ,gioi = '".$gioi."' ,nganh = '".$nganh."' ,lop = '".$lop."' ,
            bo = '".$bo."' ,ho = '".$ho."' ,hinhthai = '".$hinhthai."' ,sinhthai = '".$sinhthai."' ,giatri = '".$giatri."' ,iucn = '".$iucn."' ,sachdo = '".$sachdo
            ."' ,nghidinh = '".$ndcp."' ,cities = '".$cities."' ,phanbo = '".$phanbo."' ,tinhtrang = '".$tinhtrang."' ,sinhcanh = '".$sinhcanh
            ."' ,diadiem = '".$diadiem."' ,ngaythuthap = '".$ngaythuthap."' ,nguoithuthap = '".$nguoithumau."' ,duongdan = '".$duongdan."'
        WHERE id = ".$iddv.";";
        //return $sql;
        //echo $sql."<br>";
        $con->query($sql);
        

        for($i = 0; $i < 5; $i ++){
            move_uploaded_file($hinhanh[$i]['tmp_name'], '../../../uploads/'.$hinhanh[$i]['name']);
            $con=new mysqli("localhost","root","","web_animal");
            $con->set_charset("utf8");
            $sql = "SELECT id as top from hinhanh WHERE dongvat_id = ".$iddv." LIMIT 1;";
            $idtop = $con->query($sql);
            $row = $idtop->fetch_assoc();
            echo $row['top'];
            $top = $row['top'];
            //echo $hinhanh[$i]['name'];
            if(!empty($hinhanh[$i]['name'])){
                $sql = "UPDATE hinhanh SET duongdan = '".$hinhanh[$i]['name']."' WHERE id = ".($top+$i).";";
                echo $sql."<br>";
                $con->query($sql);
            }
        }
        
        for($i = 0; $i < 5; $i ++){
            $con=new mysqli("localhost","root","","web_animal");
            $con->set_charset("utf8");
            $sql = "SELECT id as top from toado WHERE dongvat_id = ".$iddv." LIMIT 1;";
            $idtop = $con->query($sql);
            $row = $idtop->fetch_assoc();
            echo $row['top'];
            $top = $row['top'];
            if(!empty($tdo[$i])){
                $sql = " UPDATE toado SET toado = '".$tdo[$i]."' WHERE id = ".($top+$i).";";
                echo $sql."<br>";
                $con->query($sql);
            }
        }
    }
?>