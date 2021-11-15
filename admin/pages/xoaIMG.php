<?php 
    // include '../../config.php';
    include '../layout/header-only.php';
?>

<?php

    $idhinhanh = $_GET['idhinhanh'];
    //echo $iddv;
    $con=new mysqli("localhost","root","","web_animal");
    $con->set_charset("utf8");

    $sql = "DELETE FROM hinhanh WHERE id = ".$idhinhanh."";
    $result = $con->query($sql);
    $sql_1 = "SELECT * FROM hinhanh WHERE id = ".$idhinhanh."";
    $result = $con->query($sql_1);
    $row = $result->fetch_assoc();
    unlink("../../../" . $row['duongdan']);
 // echo $sql;
    //echo '<script>alert("Welcome to Geeks for Geeks")</script>';
    //echo "Xóa thành công !";
    header ('Location: animal.php');
?>