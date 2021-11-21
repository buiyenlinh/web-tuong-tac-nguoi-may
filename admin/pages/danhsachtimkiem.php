<?php
// include '../../config.php';
include '../layout/header-only.php';
?>

<?php
if (isset($_POST["submit"])) {
    if (isset($_POST['input_search'])) {
        $data = $_POST['input_search'];
        //echo $data;
        $con = new mysqli("localhost", "root", "", "web_animal");
        $con->set_charset("utf8");
        if (mysqli_connect_errno()) {
            echo "Lỗi kết nối: " . mysqli_connect_error();
        }

        $sql = "SELECT DISTINCT tenkhoahoc, id, tentiengviet FROM dongvat WHERE tenkhoahoc LIKE '%$data%' or tentiengviet LIKE '%$data%' or tendiaphuong LIKE '%$data%' or nguoithuthap LIKE '%$data%' " . ";";
        $result = mysqli_query($con, $sql);
    }
}
else{
    header('Location: animal.php');
}
?>
<div class="layout-wrap">
    <div class="layout-left">
        <?php include '../layout/menu-left.php'; ?>
    </div>
    <div class="layout-right">
        <div class="layout-right-content-header">
            <?php include '../layout/header.php'; ?>
        </div>
        <div class="layout-right-content">
            <div class="layout-right-content-details">
                <form class="chitiet p-3" id="form-chitiet">
                    <div class="gridtable">
                        <h3 class="text-center">DANH SÁCH ĐỘNG VẬT</h3>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead class="bg-info text-center text-light">
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên khoa học</th>
                                        <th>Tên tiếng việt</th>
                                        <th colspan=3>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $row = $result->fetch_assoc();
                                    if ($result->num_rows > 0) {
                                        $i = 1; //Dat bien i truoc tien de khoi tao chay trong while
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $i . "</td>";
                                            echo "<td>" . $row['tenkhoahoc'] . "</td>";
                                            echo "<td>" . $row['tentiengviet'] . "</td>";
                                            //Ở sau  ko cần dấu ?idsp='". $var ."' Nên dùng  ?idsp=".$row['idsp']."'
                                            echo "<td><a href='./chitiet.php?iddv=" . $row['id'] . "'>Xem chi tiết</a></td>";
                                            echo "<td><a href='suaAnimal.php?iddv=" . $row['id'] . "'><i class='fas fa-pen'></i></a></td>";
                                            echo "<td><a href='./xoaAnimal.php?iddv=" . $row['id'] . "'><i class='fas fa-trash-alt text-danger'></i></a></td>";
                                            echo "</tr>";
                                            $i++;
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    //while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
    //echo "<a href='./chitiet.php?iddv=".$row['id']."'>".$row['tenkhoahoc']."</a>"."</br>";
    //}
    // return "<a href='./chitiet.php?iddv=".$row['id']."'>".$row['tenkhoahoc']."</a>";
    //Đóng kết nối
    //mysqli_close($con);
    ?>

    <?php include '../layout/footer-only.php' ?>