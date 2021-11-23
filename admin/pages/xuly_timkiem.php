
<?php
if(isset($_GET['data'])){
    $data = $_GET['data'];
    $con=new mysqli("localhost","root","","web_animal");
    $con->set_charset("utf8");
    
    // Kiểm tra kết nối
    if (mysqli_connect_errno()){
        echo "Lỗi kết nối: " . mysqli_connect_error();
    }
    
    $sql = "SELECT DISTINCT tenkhoahoc, id FROM dongvat WHERE tenkhoahoc LIKE '%$data%' or tentiengviet LIKE '%$data%' or tendiaphuong LIKE '%$data%' or nguoithuthap LIKE '%$data%' ".";";
    $result = mysqli_query($con, $sql);
    
    $i=0;
    while($row = $result->fetch_assoc()){
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