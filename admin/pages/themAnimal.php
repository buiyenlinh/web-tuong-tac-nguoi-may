<?php
// include '../../config.php';
include '../layout/header-only.php';
?>
<?php

function to_slug($str) { 
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

if (isset($_POST["submit"])) {
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
    $toado[1] = $_POST['inputtoado1'];
    $toado[2] = $_POST['inputtoado2'];
    $toado[3] = $_POST['inputtoado3'];
    $toado[4] = $_POST['inputtoado4'];
    $toado[5] = $_POST['inputtoado5'];
    $tinhtrang = $_POST['inputtinhtrang'];
    $sinhcanh = $_POST['inputsinhcanh'];
    $diadiem = $_POST['inputdiadiem'];
    $ngaythuthap = $_POST['inputngaythuthap'];
    $nguoithumau = $_POST['inputnguoithumau'];
    $duongdan = to_slug($tenkhoahoc);
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


    $con = new mysqli("localhost", "root", "", "web_animal");
    $con->set_charset("utf8");


    $sql_1 = "INSERT INTO dongvat (tenkhoahoc, tentiengviet, tendiaphuong, gioi, nganh, lop, bo, ho, hinhthai, sinhthai, giatri,
            iucn, sachdo, nghidinh, cities, phanbo, tinhtrang, sinhcanh, diadiem, ngaythuthap, nguoithuthap, created_at,updated_at, duongdan, nguoitao) VALUES
            ('" . $tenkhoahoc . "', '" . $tentiengviet . "', '" . $tendiaphuong . "', '" . $gioi . "', '" . $nganh . "', '" . $lop . "', '" . $bo . "', '" . $ho . "', '" . $hinhthai . "', '"
        . $sinhthai . "', '" . $giatri . "', '" . $iunc . "', '" . $sachdo . "', '" . $ndcp . "', '" . $cites . "', '" . $phanbo . "', '" . $tinhtrang . "', '" . $sinhcanh . "', '" . $diadiem . "', '" . $ngaythuthap . "', '" . $nguoithumau . "', now(), now(), '" . $duongdan . "', " . $_SESSION['user']['id'] . ");";
    $con->query($sql_1);


    $sqlmax = "SELECT MAX(id) as max FROM dongvat;";

    //    echo $sqlmax;
    $max = $con->query($sqlmax);
    $row = $max->fetch_assoc();
    //    echo $row['max'];
    $maxx = $row['max'];
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
                /*  echo "Bạn upload file thứ $numfiles:<br>";
                echo "Tên file: $names[$i] <br>";
                echo "Lưu tại: $tmp_names[$i] <br>";
                echo "Cỡ file: $sizes[$i] <br><hr>"; */
                //Code xử lý di chuyển file đến thư mục cần thiết ở đây (bạn tự thực hiện)
                move_uploaded_file($tmp_names[$i], '../../../uploads/' . $names[$i]);

                $path = '../../../uploads/' . $names[$i];

                //$sql = "insert into hinhanh(duongdan, dongvat_id) values ('".'uploads/'.$names[$i]."', '".$maxx."');";

                //       echo $sql;
                //       $con->query($sql);
                //$con->close();
            }
        }
        //    echo "Tổng số file upload: " .$numfiles;
        //set_time_limit(500);

        /*           $hinh1 = isset($names[0])?'uploads/'.$names[0]:null;
            $hinh2 = isset($names[1])?'uploads/'.$names[1]:null;
            $hinh3 = isset($names[2])?'uploads/'.$names[2]:null;
            $hinh4 = isset($names[3])?'uploads/'.$names[3]:null;
            $hinh5 = isset($names[4])?'uploads/'.$names[4]:null;
            $con=new mysqli("localhost","root","","web_animal"); */
        $con->set_charset("utf8");
        for ($i = 0; $i < $numfiles; $i++) {
            $sql = "insert into hinhanh(duongdan, dongvat_id) values ('" . 'uploads/' . $names[$i] . "', '" . $maxx . "');";
            //       echo $sql;
            $con->query($sql);
        }



        /*$sql = "INSERT INTO dongvat (tenkhoahoc, tentiengviet, tendiaphuong, gioi, nganh, lop, bo, ho, hinh1, hinh2, hinh3, hinh4, hinh5, hinhthai, sinhthai, giatri,
            iucn, sachdo, nghidinh, cities, phanbo, toado1, toado2, toado3, toado4, toado5, tinhtrang, sinhcanh, diadiem, ngaythuthap, nguoithuthap) VALUES
            ('".$tenkhoahoc."', '".$tentiengviet."', '".$tendiaphuong."', '".$gioi."', '".$nganh."', '".$lop."', '".$bo."', '".$ho."', '".$hinh1."', '".$hinh2."', '".$hinh3."', '".$hinh4."', '".$hinh5."', '".$hinhthai."', '"
            .$sinhthai."', '".$giatri."', '".$iunc."', '".$sachdo."', '".$ndcp."', '".$cites."', '".$phanbo."', '".$toado1."', '".$toado2."', '"
            .$toado3."', '".$toado4."', '".$toado5."', '".$tinhtrang."', '".$sinhcanh."', '".$diadiem."', '".$ngaythuthap."', '".$nguoithumau."') ";


            //$sql = " INSERT INTO dongvat(hinh1, hinh2, hinh3, hinh4, hinh5) VALUES ('".$hinh1."', '".$hinh2."', '".$hinh3."', '".$hinh4."', '".$hinh5."') ";
            echo $sql;
            $con->query($sql);*/
    }
    //    echo $sql_1;
    $tdo[1] = isset($toado[1]) ? $toado[1] : null;
    $tdo[2] = isset($toado[2]) ? $toado[2] : null;
    $tdo[3] = isset($toado[3]) ? $toado[3] : null;
    $tdo[4] = isset($toado[4]) ? $toado[4] : null;
    $tdo[5] = isset($toado[5]) ? $toado[5] : null;

    for ($i = 1; $i <= 5; $i++) {
        if (!empty($tdo[$i])) {
            $sql_2 = "insert into toado (toado, dongvat_id) values ('" . $toado[$i] . "', '" . $maxx . "');";
            $con->query($sql_2);
        }
        //        echo $sql_2; 
    }
    header('Location: animal.php');
} else {
    echo "Error";
}

?>