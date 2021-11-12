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
                        <!--Form THÊM -->
                        <div class="col-md-8" id="form-cn">
                            <h3 class="text-center">THÊM ĐỘNG VẬT</h3>
                            <form action="themAnimal.php" accept-charset="UTF-8" enctype="multipart/form-data" method="POST" target="">

                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <div class="col-12 col-lg-4">
                                                <label for="inputSupplierName">Tên khoa học:</label>
                                                <input type="text" name="inputkhoahoc" class="form-control" id="inputkhoahoc" placeholder="Nhập tên khoa học" required="required">
                                            </div>
                                            <div class="col-12 col-lg-4">
                                                <label for="inputSupplierName">Tên tiếng việt:</label>
                                                <input type="text" name="inputtiengviet" class="form-control" id="inputtiengviet" required="required" placeholder="Nhập tên tiếng Việt">
                                            </div>
                                            <div class="col-12 col-lg-4">
                                                <label for="inputSupplierName">Tên tiếng việt:</label>
                                                <input type="text" name="inputdiaphuong" class="form-control" id="inputdiaphuong" required="required" placeholder="Nhập tên địa phương">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-12 col-lg-4">
                                                <label for="inputgioi">Giới:</label>
                                                <select name="inputgioi" class="form-control">
                                                    <?php
                                                    $con = new mysqli("localhost", "root", "", "web_animal");
                                                    $con->set_charset("utf8");
                                                    $sql = "SELECT * FROM gioi ;";
                                                    $result = $con->query($sql);
                                                    if ($result->num_rows > 0) {
                                                        while ($row = $result->fetch_assoc()) {
                                                            echo "<option value='" . $row['id'] . "'>" . $row['ten'] . "</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-12 col-lg-4">
                                                <label for="inputnganh">Ngành:</label>
                                                <select name="inputnganh" class="form-control">
                                                    <?php
                                                    $con = new mysqli("localhost", "root", "", "web_animal");
                                                    $con->set_charset("utf8");
                                                    $sql = "SELECT * FROM nganh ;";
                                                    $result = $con->query($sql);
                                                    if ($result->num_rows > 0) {
                                                        while ($row = $result->fetch_assoc()) {
                                                            echo "<option value='" . $row['id'] . "'>" . $row['ten'] . "</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-12 col-lg-4">
                                                <label for="inputlop">Lớp</label>
                                                <select name="inputlop" class="form-control">
                                                    <?php
                                                    $con = new mysqli("localhost", "root", "", "web_animal");
                                                    $con->set_charset("utf8");
                                                    $sql = "SELECT * FROM lop ;";
                                                    $result = $con->query($sql);
                                                    if ($result->num_rows > 0) {
                                                        while ($row = $result->fetch_assoc()) {
                                                            echo "<option value='" . $row['id'] . "'>" . $row['ten'] . "</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-12 col-lg-6">
                                                <label for="inputbo">Bộ:</label>
                                                <select name="inputbo" class="form-control">
                                                    <?php
                                                    $con = new mysqli("localhost", "root", "", "web_animal");
                                                    $con->set_charset("utf8");
                                                    $sql = "SELECT * FROM bo ;";
                                                    $result = $con->query($sql);
                                                    if ($result->num_rows > 0) {
                                                        while ($row = $result->fetch_assoc()) {
                                                            echo "<option value='" . $row['id'] . "'>" . $row['ten'] . "</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <label for="inputho">Họ:</label>
                                                <select name="inputho" class="form-control">
                                                    <?php
                                                    $con = new mysqli("localhost", "root", "", "web_animal");
                                                    $con->set_charset("utf8");
                                                    $sql = "SELECT * FROM ho ;";
                                                    $result = $con->query($sql);
                                                    if ($result->num_rows > 0) {
                                                        while ($row = $result->fetch_assoc()) {
                                                            echo "<option value='" . $row['id'] . "'>" . $row['ten'] . "</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-12 col-lg-6">
                                                <label for="inputSupplierName">Đặc điểm hình thái:</label>
                                                <textarea class="form-control" id="inputhinhthai" placeholder="Nhập đặc điểm hình thái" name="inputhinhthai" rows="3" class="form-control"></textarea>
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <label for="inputSupplierName">Đặc điểm sinh thái:</label>
                                                <textarea class="form-control" id="inputsinhthai" placeholder="Nhập đặc điểm sinh thái" name="inputsinhthai" rows="3" class="form-control"></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-12 col-lg-3">
                                                <label for="inputSupplierName">Giá trị:</label>
                                                <input type="text" name="inputgiatri" class="form-control" id="inputgiatri" placeholder="Nhập giá trị sử dụng">
                                            </div>
                                            <div class="col-12 col-lg-3">
                                                <label for="inputSupplierName">IUCN:</label>
                                                <input type="text" name="inputiucn" class="form-control" id="inputiucn" placeholder="Nhập IUCN">
                                            </div>
                                            <div class="col-12 col-lg-3">
                                                <label for="inputSupplierName">Sách đỏ:</label>
                                                <input type="text" name="inputsachdo" class="form-control" id="inputsachdo" placeholder="Nhập tình trạng bảo tồn theo sách đỏ Việt Nam">
                                            </div>
                                            <div class="col-12 col-lg-3">
                                                <label for="inputSupplierName">Nghị định:</label>
                                                <input type="text" name="inputndcp" class="form-control" id="inputndcp" placeholder="Nhập NĐCP">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-12 col-lg-3">
                                                <label for="inputSupplierName">CITES:</label>
                                                <input type="text" name="inputcites" class="form-control" id="inputcites" placeholder="Nhập CITES">
                                            </div>
                                            <div class="col-12 col-lg-3">
                                                <label for="inputSupplierName">Phân bố:</label>
                                                <input type="text" name="inputphanbo" class="form-control" id="inputphanbo" placeholder="Nhập phân bố">
                                            </div>
                                            <div class="col-12 col-lg-3">
                                                <label for="inputSupplierName">Tình trạng:</label>
                                                <input type="text" name="inputtinhtrang" class="form-control" id="inputtinhtrang" placeholder="Nhập tình trạng mẫu vật">
                                            </div>
                                            <div class="col-12 col-lg-3">
                                                <label for="inputSupplierName">Sinh cảnh:</label>
                                                <input type="text" name="inputsinhcanh" class="form-control" id="inputsinhcanh" placeholder="Nhập sinh cảnh">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-12 col-lg-4">
                                                <label for="inputSupplierName">Địa điểm:</label>
                                                <input type="text" name="inputdiadiem" class="form-control" id="inputdiadiem" placeholder="Nhập địa điểm">
                                            </div>
                                            <div class="col-12 col-lg-4">
                                                <label for="inputSupplierName">Người thu mẩu:</label>
                                                <input type="text" name="inputnguoithumau" class="form-control" id="inputnguoithumau" placeholder="Nhập người thu mẫu">
                                            </div>
                                            <div class="col-12 col-lg-4">
                                                <label for="inputSupplierName">Ngày thu thập:</label>
                                                <input type="date" name="inputngaythuthap" class="form-control" id="inputngaythuthap" placeholder="Nhập ngày thu mẫu">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-12 col-lg-3">
                                                <label for="inputAnimail" required="required">Thêm hình</label>
                                                <input type="file" name="fileupload[]" id="files" multiple required>
                                                <div class="form-group">
                                                    <div id="image_preview"></div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-9">
                                                <div class="form-group row">
                                                    <div class="col-12 col-lg-3">
                                                        <label for="inputAnimail" required="required">Tọa độ 1</label>
                                                        <input type="text" name="inputtoado1" class="form-control" id="inputtoado1" placeholder="Nhập tọa độ 1">
                                                    </div>
                                                    <div class="col-12 col-lg-3">
                                                        <label for="inputAnimail" required="required">Tọa độ 2</label>
                                                        <input type="text" name="inputtoado2" class="form-control" id="inputtoado2" placeholder="Nhập tọa độ 2">
                                                    </div>
                                                    <div class="col-12 col-lg-2">
                                                        <label for="inputAnimail" required="required">Tọa độ 3</label>
                                                        <input type="text" name="inputtoado3" class="form-control" id="inputtoado3" placeholder="Nhập tọa độ 3">
                                                    </div>
                                                    <div class="col-12 col-lg-2">
                                                        <label for="inputAnimail" required="required">Tọa độ 4</label>
                                                        <input type="text" name="inputtoado4" class="form-control" id="inputtoado4" placeholder="Nhập tọa độ 4">
                                                    </div>
                                                    <div class="col-12 col-lg-2">
                                                        <label for="inputAnimail" required="required">Tọa độ 5</label>
                                                        <input type="text" name="inputtoado5" class="form-control" id="inputtoado5" placeholder="Nhập tọa độ 5">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer p-2">
                                            <button type="submit" class="btn btn-info" name="submit"  value="Upload File">
                                                <i class="fas fa-plus-circle"></i> Thêm Động Vật
                                            </button>
                                            <button type="button" class="btn btn-info" onclick="reset_text()">
                                                <i class="fas fa-trash-restore"></i> Làm mới
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!--Form THÊM -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>



    <script>
        $(document).ready(function() {
            var fileArr = [];
            $("#files").change(function() {
                // check if fileArr length is greater than 0
                if (fileArr.length > 0) fileArr = [];

                $("#image_preview").html("");
                var total_file = document.getElementById("files").files;
                if (!total_file.length) return;
                for (var i = 0; i < total_file.length; i++) {
                    if (total_file[i].size > 1048576) {
                        return false;
                    } else {
                        fileArr.push(total_file[i]);
                        $("#image_preview").append(
                            "<div class='img-div' id='img-div" +
                            i +
                            "'><img src='" +
                            URL.createObjectURL(event.target.files[i]) +
                            "' class='img-responsive image img-thumbnail' title='" +
                            total_file[i].name +
                            "'><div class='middle'><button id='action-icon' value='img-div" +
                            i +
                            "' class='btn btn-danger' role='" +
                            total_file[i].name +
                            "'><i class='fa fa-trash'></i></button></div></div>"
                        );
                    }
                }
            });

            $("body").on("click", "#action-icon", function(evt) {
                var divName = this.value;
                var fileName = $(this).attr("role");
                $(`#${divName}`).remove();

                for (var i = 0; i < fileArr.length; i++) {
                    if (fileArr[i].name === fileName) {
                        fileArr.splice(i, 1);
                    }
                }
                document.getElementById("files").files = FileListItem(fileArr);
                evt.preventDefault();
            });

            function FileListItem(file) {
                file = [].slice.call(Array.isArray(file) ? file : arguments);
                for (var c, b = (c = file.length), d = !0; b-- && d;)
                    d = file[b] instanceof File;
                if (!d)
                    throw new TypeError(
                        "expected argument to FileList is File or array of File objects"
                    );
                for (b = new ClipboardEvent("").clipboardData || new DataTransfer(); c--;)
                    b.items.add(file[c]);
                return b.files;
            }
        });
    </script>

    <!--RESET ALL INPUT EMPTY-->
    <script>
        function reset_text() {
            $("#inputkhoahoc").val("");
            $('#inputtiengviet').val('');
            $('#inputdiaphuong').val('');
            $('#inputgioi').val('');
            $('#inputnganh').val('');
            $('#inputlop').val('');
            $('#inputbo').val('');
            $("#inputho").val("");
            $('#inputhinhthai').val('');
            $('#inputsinhthai').val('');
            $('#inputgiatri').val('');
            $('#inputiucn').val('');
            $('#inputsachdo').val('');
            $('#inputndcp').val('');
            $("#inputcites").val("");
            $('#inputphanbo').val('');
            $('#inputtoado1').val('');
            $('#inputtoado2').val('');
            $('#inputtoado3').val('');
            $('#inputtoado4').val('');
            $('#inputtoado5').val('');
            $('#inputtinhtrang').val('');
            $('#inputsinhcanh').val('');
            $('#inputdiadiem').val('');
            $('#inputngaythuthap').val('');
            $('#inputnguoithumau').val('');
        }
    </script>

    <script>
        $(function() {
            // Get the form fields and hidden div
            var checkbox = $("#trigger");
            var hidden1 = $("#hidden_fields1");
            var hidden2 = $("#hidden_fields2");
            var hidden3 = $("#hidden_fields3");
            var hidden4 = $("#hidden_fields4");
            var hidden5 = $("#hidden_fields5");
            var populate = $("#populate");

            // Hide the fields.
            // Use JS to do this in case the user doesn't have JS
            // enabled.
            hidden1.hide();
            hidden2.hide();
            hidden3.hide();
            hidden4.hide();
            hidden5.hide();

            // Setup an event listener for when the state of the
            // checkbox changes.
            checkbox.change(function() {
                // Check to see if the checkbox is checked.
                // If it is, show the fields and populate the input.
                // If not, hide the fields.
                if (checkbox.is(":checked")) {
                    // Show the hidden fields.
                    hidden1.show();
                    hidden2.show();
                    hidden3.show();
                    hidden4.show();
                    hidden5.show();
                    // Populate the input.
                    populate.val("Dude, this input got populated!");
                } else {
                    // Make sure that the hidden fields are indeed
                    // hidden.
                    hidden1.hide();
                    hidden2.hide();
                    hidden3.hide();
                    hidden4.hide();
                    hidden5.hide();
                    // You may also want to clear the value of the
                    // hidden fields here. Just in case somebody
                    // shows the fields, enters data to them and then
                    // unticks the checkbox.
                    //
                    // This would do the job:
                    //
                    // $("#hidden_field").val("");
                }
            });
        });
    </script>

    <script>
        $(function() {
            // Get the form fields and hidden div
            var checkbox = $("#trigger1");
            var hidden1 = $("#hidden_fields10");
            var hidden2 = $("#hidden_fields11");
            var hidden3 = $("#hidden_fields12");
            var hidden4 = $("#hidden_fields13");
            var hidden5 = $("#hidden_fields14");
            var hidden6 = $("#hidden_fields15");
            var hidden7 = $("#hidden_fields16");
            var hidden8 = $("#hidden_fields17");
            var hidden9 = $("#hidden_fields18");
            var hidden10 = $("#hidden_fields19");
            var hidden11 = $("#hidden_fields20");
            // Hide the fields.
            // Use JS to do this in case the user doesn't have JS
            // enabled.
            hidden1.hide();
            hidden2.hide();
            hidden3.hide();
            hidden4.hide();
            hidden5.hide();
            hidden6.hide();
            hidden7.hide();
            hidden8.hide();
            hidden9.hide();
            hidden10.hide();
            hidden11.hide();
            // Setup an event listener for when the state of the
            // checkbox changes.
            checkbox.change(function() {
                // Check to see if the checkbox is checked.
                // If it is, show the fields and populate the input.
                // If not, hide the fields.
                if (checkbox.is(":checked")) {
                    // Show the hidden fields.
                    hidden1.show();
                    hidden2.show();
                    hidden3.show();
                    hidden4.show();
                    hidden5.show();
                    hidden6.show();
                    hidden7.show();
                    hidden8.show();
                    hidden9.show();
                    hidden10.show();
                    hidden11.show();
                    // Populate the input.
                    populate.val("Dude, this input got populated!");
                } else {
                    // Make sure that the hidden fields are indeed
                    // hidden.
                    hidden1.hide();
                    hidden2.hide();
                    hidden3.hide();
                    hidden4.hide();
                    hidden5.hide();
                    hidden6.hide();
                    hidden7.hide();
                    hidden8.hide();
                    hidden9.hide();
                    hidden10.hide();
                    hidden11.hide();
                    // You may also want to clear the value of the
                    // hidden fields here. Just in case somebody
                    // shows the fields, enters data to them and then
                    // unticks the checkbox.
                    //
                    // This would do the job:
                    //
                    // $("#hidden_field").val("");
                }
            });
        });
    </script>
<?php endif; ?>
<?php include '../layout/footer-only.php' ?>