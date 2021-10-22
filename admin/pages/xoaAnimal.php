<?php 
    // include '../../config.php';
    include '../layout/header-only.php';
?>

<?php
    $iddv = $_GET['iddv'];
    //echo $iddv;
    $con=new mysqli("localhost","root","","web_animal");
    $con->set_charset("utf8");

    $sql = "DELETE FROM dongvat WHERE id = ".$iddv."";
    $result = $con->query($sql);
    //echo $sql;

    
    $sql = "DELETE FROM hinhanh WHERE dongvat_id = ".$iddv."";
    $result = $con->query($sql);
    //echo $sql;

 //           echo $hinh[$i];
 //           echo "<br>";
    
    $sql = "DELETE FROM toado WHERE dongvat_id = ".$iddv."";
    $result = $con->query($sql);
    //echo $sql;

 // echo $sql;
    //echo '<script>alert("Welcome to Geeks for Geeks")</script>';
    //echo "Xóa thành công !";
    header ('Location: animal.php');
?>