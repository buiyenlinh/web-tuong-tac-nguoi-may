<?php
// include '../../config.php';
include '../layout/header-only.php';

?>

<?php if (empty($_SESSION['user'])) : ?>
    <?php header('Location:' . BASE . 'admin') ?>
<?php else : ?>
    <div id="animal-list">
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

                        <div class="animals p-3">
                            <h3 class="text-center mb-3">DANH SÁCH ĐỘNG VẬT</h3>
                            <!--Tìm kiếm -->
                            <div style="display: flex; justify-content: space-between">
                                <div class="main-search">
                                    <form action="danhsachtimkiem.php" accept-charset="UTF-8" enctype="multipart/form-data" method="POST">
                                        <!-- Another variation with a button -->
                                        <div class="input-group search-box">
                                            <div class="input-group">
                                                <input type="text" name="input_search" class="form-control rounded-0" placeholder="Tên khoa học, tiếng Việt, địa phương và người thu thập " onkeyup='livesearch(this.value);'>
                                                <div class="input-group-append">
                                                    <button type="submit" name="submit" class="btn btn-secondary rounded-0" type="button" style="background-color: #0e768d;">
                                                        <i class="fa fa-search"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            <div id='result'></div>
                                        </div>
                                    </form>
                                </div>
                                <!--Tìm kiếm -->

                                <!--Button Thêm -->
                                <div class=" mb-3 btn-them">
                                    <!-- <h3 class="mb-0" id="animal-list-title text-center"></h3> -->
                                    <button type="button" class="btn btn-primary rounded-0" id="btn-animal-cn" onclick="HideShow()" style="background-color: #0e768d; width: 7rem;">
                                        <a href="./export_excel.php"><b>Xuất file</b></a>
                                    </button>
                                    <button type="button" class="btn btn-primary rounded-0" id="btn-animal-cn" onclick="HideShow()" style="background-color: #0e768d; width: 7rem;">
                                        <a href="./formthem.php"><b>Thêm</b></a>
                                    </button>
                                </div>
                            </div>
                            <!--Button Thêm -->

                            <!--Danh sách động vật -->
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
                            <form class="danhsach" id="form-danhsach">
                                <div class="gridtable">
                                    <!-- <h3 class="text-center">DANH SÁCH ĐỘNG VẬT</h3> -->
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead class="bg-info text-center text-light">
                                                <tr>
                                                    <th>STT</th>
                                                    <th>Tên Khoa Học</th>
                                                    <th>Tên tiếng việt</th>
                                                    <th colspan=3>Thao tác</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                //if ($result->num_rows > 0) {
                                                $i = 1; //Dat bien i truoc tien de khoi tao chay trong while
                                                //while ($row = $result->fetch_assoc()) {
                                                while ($row = mysqli_fetch_array($res_data)) {
                                                    echo "<tr>";
                                                    echo "<td>" . $i . "</td>";
                                                    echo "<td>" . $row['tenkhoahoc'] . "</td>";
                                                    echo "<td>" . $row['tentiengviet'] . "</td>";
                                                    //Ở sau  ko cần dấu ?idsp='". $var ."' Nên dùng  ?idsp=".$row['idsp']."'
                                                    echo "<td><a href='./chitiet.php?iddv=" . $row['id'] . "'><i class='fas fa-info-circle'></i></a></td>";
                                                    echo "<td><a href='suaAnimal.php?iddv=" . $row['id'] . "'><i class='fas fa-edit'></i></a></td>";
                                                    echo "<td><a href='./xoaAnimal.php?iddv=" . $row['id'] . "' class='confirmation'><i class='far fa-trash-alt text-danger'></i></a></td>";
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
            </div>
        </div>
        <!--Danh sách động vật -->

    </div>

    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

    <!-- JS-->
    <script type="text/javascript">
        var elems = document.getElementsByClassName('confirmation');
        var confirmIt = function(e) {
            if (!confirm('Bạn có chắc muốn xóa ĐỘNG VẬT này?')) e.preventDefault();
        };
        for (var i = 0, l = elems.length; i < l; i++) {
            elems[i].addEventListener('click', confirmIt, false);
        }
    </script>

    <script>
        function livesearch(data) {
            var xmlhttp;
            var result;
            xmlhttp = new XMLHttpRequest();
            if (data != "") {
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        result = xmlhttp.responseText;
                        document.getElementById("result").innerHTML = result;
                    }
                }
            } else {
                document.getElementById("result").innerHTML = "";
            }
            xmlhttp.open("GET", "./xuly_timkiem.php?data=" + data, true);
            xmlhttp.send();
        }

        function timkiem(data) {
            var xmlhttp;
            var result;
            xmlhttp = new XMLHttpRequest();
            if (data != "") {
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        result = xmlhttp.responseText;
                        document.getElementById("result").innerHTML = result;
                    }
                }
            } else {
                document.getElementById("result").innerHTML = "";
            }
            xmlhttp.open("GET", "./xuly_timkiem.php?data=" + data, true);
            xmlhttp.send();
        }
    </script>
    <!-- JS-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        var name = '<?php if ($_SESSION['status'] === null) echo "not yet";
                    else echo $_SESSION['status']; ?>';
        //alert(name);
        // alert edit supported successful
        if (name == "add success") {
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Thêm động vật thành công',
                showConfirmButton: false,
                timer: 1500
            })
            <?php
            $_SESSION['status'] = null;
            ?>
        }

        if (name == "edit success") {
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Chỉnh sửa động vật thành công',
                showConfirmButton: false,
                timer: 1500
            })
            <?php
            $_SESSION['status'] = null;
            ?>
        }

        if (name == "delete success") {
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Xóa động vật thành công',
                showConfirmButton: false,
                timer: 1500
            })
            <?php
            $_SESSION['status'] = null;
            ?>
        }
    </script>
<?php endif; ?>
<?php include '../layout/footer-only.php' ?>