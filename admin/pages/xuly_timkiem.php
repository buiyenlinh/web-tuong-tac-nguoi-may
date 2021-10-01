<?php 
include '../../config.php';
?>

<?php
if(isset($_GET['data'])){
    $data = $_GET['data'];
    $con=new mysqli("localhost","root","","web_animal");
    $con->set_charset("utf8");
    // $con = mysqli_connect("localhost","root","","buoi3");
    // Kiểm tra kết nối
    if (mysqli_connect_errno()){
    echo "Lỗi kết nối: " . mysqli_connect_error();
    }
    
    $sql = "SELECT DISTINCT tenkhoahoc, id FROM dongvat WHERE tenkhoahoc LIKE '%$data%' or tentiengviet LIKE '%$data%' or tendiaphuong LIKE '%$data%'".";";
    $result = mysqli_query($con, $sql);
    $row = $result->fetch_assoc();
    $i=1;
    while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
        if($i < 4){
            echo "<a href='./chitiet.php?iddv=".$row['id']."'>".$row['tenkhoahoc']."</a>"."</br>";
            $i ++;
        }else{
            break;
        }
        
    }
   // return "<a href='./chitiet.php?iddv=".$row['id']."'>".$row['tenkhoahoc']."</a>";
    //Đóng kết nối
    mysqli_close($con);
}
?>