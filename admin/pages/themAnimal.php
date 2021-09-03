<?php 
    include '../../config.php';
    include '../layout/header-only.php';
?>
<?php
    //session_start();
    if(isset($_POST["submit"])) {
        $tenkhoahoc = $_POST['inputkhoahoc'];
        $tentiengviet = $_POST['inputtiengviet'];
        $tendiaphuong = $_POST['inputdiaphuong'];
        $gioi = $_POST['inputgioi'];
        $nganh = $_POST['inputnganh'];
        $lop = $_POST['inputlop'];
        $bo = $_POST['inputbo'];
        $ho = $_POST['inputho'];
        $hinhthai = $_POST['inputhinhthai'];
        $sinhthai = $_POST['inputsinhthai'];
        $giatri = $_POST['inputgiatri'];
        $iunc = $_POST['inputiucn'];
        $sachdo = $_POST['inputsachdo'];
        $ndcp = $_POST['inputndcp'];
         $cites = $_POST['inputcites'];
        $phanbo = $_POST['inputphanbo'];
        $toado1 = $_POST['inputtoado1'];
        $toado2 = $_POST['inputtoado2'];
        $toado3 = $_POST['inputtoado3'];
        $toado4 = $_POST['inputtoado4'];
        $toado5 = $_POST['inputtoado5'];
        $tinhtrang = $_POST['inputtinhtrang'];
        $sinhcanh = $_POST['inputsinhcanh'];
        $diadiem = $_POST['inputdiadiem'];
        $ngaythuthap = $_POST['inputngaythuthap'];
        $nguoithumau = $_POST['inputnguoithumau'];

                    //echo "$tenkhoahoc";
       /* $con=new mysqli("localhost","root","","web_animal");
        $con->set_charset("utf8");
                    
       /* $sql = "INSERT INTO dongvat (tenkhoahoc, tentiengviet, tendiaphuong, gioi, nganh, lop, bo, ho, hinh1, hinh2, hinh3, hinh4, hinh5, hinhthai, sinhthai, giatri,
        iucn, sachdo, nghidinh, cities, phanbo, toado1, toado2, toado3, toado4, toado5, tinhtrang, sinhcanh, diadiem, ngaythuthap, nguoithuthap) VALUES
        ('".$tenkhoahoc."', '".$tentiengviet."', '".$tendiaphuong."', '".$gioi."', '".$nganh."', '".$lop."', '".$bo."', '".$ho."', '".$hinh1."', '".$hinh2."', '".$hinh3."', '".$hinh4."', '".$hinh5."', '".$hinhthai."', '"
        .$sinhthai."', '".$giatri."', '".$iunc."', '".$sachdo."', '".$ndcp."', '".$cites."', '".$phanbo."', '".$toado1."', '".$toado2."', '"
        .$toado3."', '".$toado4."', '".$toado5."', '".$tinhtrang."', '".$sinhcanh."', '".$diadiem."', '".$ngaythuthap."', '".$nguoithumau."') ";
                    
        $con->query($sql);
                   // $con->close();*/




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
            for ($i = 0; $i < $numitems; $i ++) {
                //Kiểm tra file thứ $i trong mảng file, up thành công không
                //$so=$i + 1;
                $kt = false;
                if ($errors[$i] == 0){
                $numfiles++;
                $kt =true;
                echo "Bạn upload file thứ $numfiles:<br>";
                echo "Tên file: $names[$i] <br>";
                echo "Lưu tại: $tmp_names[$i] <br>";
                echo "Cỡ file: $sizes[$i] <br><hr>";
                            //Code xử lý di chuyển file đến thư mục cần thiết ở đây (bạn tự thực hiện)
                move_uploaded_file($tmp_names[$i], 'C:\xampp\htdocs\tuongtacnguoimay\uploads\\'.$names[$i]);
                          
                $path = 'C:\xampp\htdocs\tuongtacnguoimay\uploads\\'.$names[$i];
                
                    //$con->close();
                }
                //if($kt){
                    //$hinhname[$i] = "unloads/" .$names[$i];
                //}//else{
                    //$hinhname[$i] = '';
                //}
            }
            echo "Tổng số file upload: " .$numfiles;
            //set_time_limit(500);

            $hinh1 = isset($names[0])?'uploads/'.$names[0]:null;
            $hinh2 = isset($names[1])?'uploads/'.$names[1]:null;
            $hinh3 = isset($names[2])?'uploads/'.$names[2]:null;
            $hinh4 = isset($names[3])?'uploads/'.$names[3]:null;
            $hinh5 = isset($names[4])?'uploads/'.$names[4]:null;
            $con=new mysqli("localhost","root","","web_animal");
            $con->set_charset("utf8");
            
            

            $sql = "INSERT INTO dongvat (tenkhoahoc, tentiengviet, tendiaphuong, gioi, nganh, lop, bo, ho, hinh1, hinh2, hinh3, hinh4, hinh5, hinhthai, sinhthai, giatri,
            iucn, sachdo, nghidinh, cities, phanbo, toado1, toado2, toado3, toado4, toado5, tinhtrang, sinhcanh, diadiem, ngaythuthap, nguoithuthap) VALUES
            ('".$tenkhoahoc."', '".$tentiengviet."', '".$tendiaphuong."', '".$gioi."', '".$nganh."', '".$lop."', '".$bo."', '".$ho."', '".$hinh1."', '".$hinh2."', '".$hinh3."', '".$hinh4."', '".$hinh5."', '".$hinhthai."', '"
            .$sinhthai."', '".$giatri."', '".$iunc."', '".$sachdo."', '".$ndcp."', '".$cites."', '".$phanbo."', '".$toado1."', '".$toado2."', '"
            .$toado3."', '".$toado4."', '".$toado5."', '".$tinhtrang."', '".$sinhcanh."', '".$diadiem."', '".$ngaythuthap."', '".$nguoithumau."') ";


            //$sql = " INSERT INTO dongvat(hinh1, hinh2, hinh3, hinh4, hinh5) VALUES ('".$hinh1."', '".$hinh2."', '".$hinh3."', '".$hinh4."', '".$hinh5."') ";
            echo $sql;
            $con->query($sql);
                    
        }
    }

?>