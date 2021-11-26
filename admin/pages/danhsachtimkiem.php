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
} else {
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

                            <?php
                            //$con = new mysqli("localhost", "root", "", "web_animal");
                            //$con->set_charset("utf8");
                            //$sql = " SELECT * FROM dongvat ";
                            //$result = $con->query($sql);
                            if (isset($_GET['page'])) {
                                $pageno = $_GET['page'];
                            } else {
                                $pageno = 1;
                            }

                            $no_of_records_per_page = 10;
                            $offset = ($pageno - 1) * $no_of_records_per_page;

                            $conn = mysqli_connect("localhost", "root", "", "web_animal");
                            if (mysqli_connect_errno()) {
                                echo "Failed to connect to MySQL: " . mysqli_connect_error();
                                die();
                            }

                            $total_pages_sql = "SELECT COUNT(*) FROM dongvat";
                            $result = mysqli_query($conn, $total_pages_sql);

                            $total_rows = mysqli_fetch_array($result)[0];
                            $total_pages = ceil($total_rows / $no_of_records_per_page);

                            $sql = "SELECT * FROM dongvat LIMIT $offset, $no_of_records_per_page";
                            $res_data = mysqli_query($conn, $sql);


                            ?>

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
                                    //$row = $result->fetch_assoc();
                                    //if ($result->num_rows > 0) {
                                    $i = 1; //Dat bien i truoc tien de khoi tao chay trong while
                                    while ($row = mysqli_fetch_array($res_data)) {
                                        echo "<tr>";
                                        echo "<td>" . $i . "</td>";
                                        echo "<td>" . $row['tenkhoahoc'] . "</td>";
                                        echo "<td>" . $row['tentiengviet'] . "</td>";
                                        //Ở sau  ko cần dấu ?idsp='". $var ."' Nên dùng  ?idsp=".$row['idsp']."'
                                        echo "<td><a href='./chitiet.php?iddv=" . $row['id'] . "'><i class='fas fa-info-circle'></i></a></td>";
                                        echo "<td><a href='suaAnimal.php?iddv=" . $row['id'] . "'><i class='fas fa-edit'></i></a></td>";
                                        echo "<td><a href='./xoaAnimal.php?iddv=" . $row['id'] . "'><i class='far fa-trash-alt text-danger'></i></a></td>";
                                        echo "</tr>";
                                        $i++;
                                    }
                                    //}
                                    mysqli_close($conn);
                                    ?>
                                </tbody>
                            </table>
                            <ul class="pagination justify-content-center">


                                <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                                    <li class="page-item <?php if ($page == $i) {
                                                                echo 'active';
                                                            } ?>">
                                        <a class="page-link" href="animal.php?page=<?= $i; ?>"> <?= $i; ?> </a>
                                    </li>
                                <?php endfor; ?>


                            </ul>
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