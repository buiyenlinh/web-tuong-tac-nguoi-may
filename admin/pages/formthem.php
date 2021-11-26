<?php
// include '../../config.php';
include '../layout/header-only.php';

?>

<?php if (empty($_SESSION['user'])) : ?>
    <?php header('Location:' . BASE . 'admin') ?>
<?php else : ?>

    <div id="animal-list">
        <div class="layout-wrap">
            <div class="layout-bg"></div>
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
                        <div class="col-md-12" id="form-cn">
                            <h3 class="text-center">THÊM ĐỘNG VẬT</h3>
                            <form action="themAnimal.php" class="them-dongvat" accept-charset="UTF-8" enctype="multipart/form-data" method="POST" target="">
                                <div class="card">
                                    <div class="card-body">

                                        <div class="form-group row">
                                            <div class="col-12 col-lg-9">
                                                <div class="trang-1" id="trang-1">
                                                    <div class="form-group row">
                                                        <div class="col-12 col-lg-4">
                                                            <div class="form-group">
                                                                <label for="inputSupplierName" style="font-weight: bold;">Tên khoa học <strong style="color: red;">(*)</strong></label>
                                                                <input type="text" name="inputkhoahoc" class="form-control" id="inputkhoahoc" placeholder="Nhập tên khoa học" required="required">
                                                            </div>
                                                            <div class="form-group">
                                                                <p for="inputSupplierName" style="font-weight: bold;">Tên tiếng việt <strong style="color: red;">(*)</strong></p>
                                                                <input type="text" name="inputtiengviet" class="form-control" id="inputtiengviet" required="required" placeholder="Nhập tên tiếng Việt">
                                                            </div>
                                                            <div class="form-group">
                                                                <p for="inputSupplierName" style="font-weight: bold;">Tên tiếng việt <strong style="color: red;">(*)</strong></p>
                                                                <input type="text" name="inputdiaphuong" class="form-control" id="inputdiaphuong" required="required" placeholder="Nhập tên địa phương">
                                                            </div>
                                                            <div class="form-group">
                                                                <p for="inputSupplierName" style="font-weight: bold;">Người thu mẩu</p>
                                                                <input type="text" name="inputnguoithumau" class="form-control" id="inputnguoithumau" placeholder="Nhập người thu mẫu">
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-lg-8">
                                                            <div class="form-group">
                                                                <p for="inputSupplierName" style="font-weight: bold;">Giá trị sử dụng</p>
                                                                <input type="text" name="inputgiatri" class="form-control" id="inputgiatri" placeholder="Nhập giá trị sử dụng">
                                                            </div>
                                                            <div class="form-group">
                                                                <p for="inputSupplierName" style="font-weight: bold;">Tình trạng bảo tồn theo IUCN</p>
                                                                <input type="text" name="inputiucn" class="form-control" id="inputiucn" placeholder="Nhập IUCN">
                                                            </div>
                                                            <div class="form-group">
                                                                <p for="inputSupplierName" style="font-weight: bold;">Tình trạng bảo tồn theo sách đỏ Việt Nam</p>
                                                                <input type="text" name="inputsachdo" class="form-control" id="inputsachdo" placeholder="Nhập tình trạng bảo tồn theo sách đỏ Việt Nam">
                                                            </div>
                                                            <div class="form-group">
                                                                <p for="inputSupplierName" style="font-weight: bold;">Tình trạng bảo tồn theo CITES (40/2013/TT-BNNPTNT)</p>
                                                                <input type="text" name="inputcites" class="form-control" id="inputcites" placeholder="Nhập CITES">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="trang-2" id="trang-2" style="display: none;">
                                                    <div class="form-group row">
                                                        <div class="col-12 col-lg-4">
                                                            <div class="form-group">
                                                                <p for="inputSupplierName" style="font-weight: bold;">Tình trạng bảo tồn theo Nghị định 32/2006/NĐCP</p>
                                                                <input type="text" name="inputndcp" class="form-control" id="inputndcp" placeholder="Nhập NĐCP">
                                                            </div>
                                                            <div class="form-group">
                                                                <p for="inputSupplierName" style="font-weight: bold;">Phân bố</p>
                                                                <input type="text" name="inputphanbo" class="form-control" id="inputphanbo" placeholder="Nhập phân bố">
                                                            </div>
                                                            <div class="form-group">
                                                                <p for="inputSupplierName" style="font-weight: bold;">Địa điểm</p>
                                                                <input type="text" name="inputdiadiem" class="form-control" id="inputdiadiem" placeholder="Nhập địa điểm">
                                                            </div>
                                                            <div class="form-group">
                                                                <p for="inputSupplierName" style="font-weight: bold;">Ngày thu thập</p>
                                                                <input type="date" name="inputngaythuthap" class="form-control" id="inputngaythuthap" placeholder="Nhập ngày thu mẫu">
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-lg-8">
                                                            <div class="form-group">
                                                                <p for="inputSupplierName" style="font-weight: bold;">Tình trạng mẫu vật</p>
                                                                <input type="text" name="inputtinhtrang" class="form-control" id="inputtinhtrang" placeholder="Nhập tình trạng mẫu vật">
                                                            </div>
                                                            <div class="form-group">
                                                                <p for="inputSupplierName" style="font-weight: bold;">Sinh cảnh:</p>
                                                                <input type="text" name="inputsinhcanh" class="form-control" id="inputsinhcanh" placeholder="Nhập sinh cảnh">
                                                            </div>
                                                            <div class="form-group">
                                                                <p for="inputSupplierName" style="font-weight: bold;">Mô tả đặc điểm hình thái</p>
                                                                <textarea class="form-control" id="inputhinhthai" placeholder="Nhập đặc điểm hình thái" name="inputhinhthai" rows="2" class="form-control"></textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <p for="inputSupplierName" style="font-weight: bold;">Mô tả đặc điểm sinh thái</p>
                                                                <textarea class="form-control" id="inputsinhthai" placeholder="Nhập đặc điểm sinh thái" name="inputsinhthai" rows="2" class="form-control"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="trang-3" id="trang-3" style="display: none;">
                                                    <div class="form-group row">
                                                        <div class="col-12 col-lg-5">
                                                            <div class="form-group">
                                                                <p for="inputAnimail" required="required" style="font-weight: bold;">Tọa độ 1</p>
                                                                <input type="text" name="inputtoado1" class="form-control" id="inputtoado1" placeholder="Nhập tọa độ 1">
                                                            </div>
                                                            <div class="form-group">
                                                                <p for="inputAnimail" required="required" style="font-weight: bold;">Tọa độ 2</p>
                                                                <input type="text" name="inputtoado2" class="form-control" id="inputtoado2" placeholder="Nhập tọa độ 2">
                                                            </div>
                                                            <div class="form-group">
                                                                <p for="inputAnimail" required="required" style="font-weight: bold;">Tọa độ 3</p>
                                                                <input type="text" name="inputtoado3" class="form-control" id="inputtoado3" placeholder="Nhập tọa độ 3">
                                                            </div>
                                                            <div class="form-group">
                                                                <p for="inputAnimail" required="required" style="font-weight: bold;">Tọa độ 4</p>
                                                                <input type="text" name="inputtoado4" class="form-control" id="inputtoado4" placeholder="Nhập tọa độ 4">
                                                            </div>
                                                            <div class="form-group">
                                                                <p for="inputAnimail" required="required" style="font-weight: bold;">Tọa độ 5</p>
                                                                <input type="text" name="inputtoado5" class="form-control" id="inputtoado5" placeholder="Nhập tọa độ 5">
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-lg-7">
                                                            <div class="form-group">
                                                                <p for="inputAnimail" required="required" style="font-weight: bold;">Thêm hình <strong style="color: red;">(*)</strong></p>
                                                                <input type="file" name="fileupload[]" id="files" multiple required>
                                                            </div>
                                                            <div class="form-group">
                                                                <div id="image_preview"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p style="font-weight: italic;"><strong style="color: red;">(*)</strong> Thông tin bắt buộc </p>

                                            </div>
                                            <div class="col-12 col-lg-3">
                                                <div class="form-group row">
                                                    <div class="col-12 col-lg-12">
                                                        <div class="form-group">
                                                            <p for="inputgioi" style="font-weight: bold;">Giới <strong style="color: red;">(*)</strong></p>
                                                            <select name="inputgioi" id="inputgioi" class="form-control">
                                                                <option value='0'>Chưa chọn</option>
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
                                                        <div class="form-group">
                                                            <p for="inputnganh" style="font-weight: bold;">Ngành <strong style="color: red;">(*)</strong></p>
                                                            <select name="inputnganh" id="inputnganh" class="form-control">
                                                                <option value='0' style="font-weight: bold;">Chưa chọn</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <p for="inputlop" style="font-weight: bold;">Lớp <strong style="color: red;">(*)</strong></p>
                                                            <select name="inputlop" id="inputlop" class="form-control">
                                                                <option value='0'>Chưa chọn</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <p for="inputbo" style="font-weight: bold;">Bộ <strong style="color: red;">(*)</strong></p>
                                                            <select name="inputbo" id="inputbo" class="form-control">
                                                                <option value='0'>Chưa chọn</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <p for="inputho" style="font-weight: bold;">Họ <strong style="color: red;">(*)</strong></p>
                                                            <select name="inputho" id="inputho" class="form-control">
                                                                <option value='0'>Chưa chọn</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer p-2">
                                                    <button type="button" class="btn btn-primary btn-sm" onclick="HideShow_2()" style="width:5rem;">
                                                        Quay lại
                                                    </button>
                                                    <button type="button" class="btn btn-primary btn-sm" onclick="HideShow()" style="width:5rem;">
                                                        Tiếp
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer p-2">
                                            <button type="submit" class="btn btn-primary" style="width: 10rem;" name="submit"  value="Upload File">
                                                <i class="fas fa-plus-circle"></i> Thêm Động Vật
                                            </button>
                                            <button type="button" class="btn btn-primary" style="width: 10rem;" onclick="reset_text()">
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

    <!--PHÂN CẤP-->
    <script>
        jQuery(document).ready(function($) {
            $("#inputgioi").change(function(event) {
                inputgioiId = $("#inputgioi").val();
                $.post('nganh.php', {
                    "inputgioiid": inputgioiId
                }, function(data) {
                    $("#inputnganh").html(data);
                });
            });
        });
        jQuery(document).ready(function($) {
            $("#inputnganh").change(function(event) {
                inputnganhId = $("#inputnganh").val();
                $.post('lop.php', {
                    "inputnganhid": inputnganhId
                }, function(data) {
                    $("#inputlop").html(data);
                });
            });
        });
        jQuery(document).ready(function($) {
            $("#inputlop").change(function(event) {
                inputlopId = $("#inputlop").val();
                $.post('bo.php', {
                    "inputlopid": inputlopId
                }, function(data) {
                    $("#inputbo").html(data);
                });
            });
        });
        jQuery(document).ready(function($) {
            $("#inputbo").change(function(event) {
                inputboId = $("#inputbo").val();
                $.post('ho_edit.php', {
                    "inputboid": inputboId
                }, function(data) {
                    $("#inputho").html(data);
                });
            });
        });
    </script>

    <!--RESET ALL INPUT EMPTY-->
    <script>
        function reset_text() {
            $("#inputkhoahoc").val("");
            $('#inputtiengviet').val('');
            $('#inputdiaphuong').val('');
            $('#inputgioi').val('0');
            $('#inputnganh').val('0');
            $('#inputlop').val('0');
            $('#inputbo').val('0');
            $("#inputho").val("0");
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
            $('#files').val('');

        }
    </script>

    <script>
        function HideShow() {
            let tenkhoahoc = document.getElementById('inputkhoahoc').value;
            let tentiengviet = document.getElementById('inputtiengviet').value;
            let tendiaphuong = document.getElementById('inputdiaphuong').value;

            let gioi = document.getElementById('inputgioi').value;
            let nganh = document.getElementById('inputnganh').value;
            let lop = document.getElementById('inputlop').value;
            let bo = document.getElementById('inputbo').value;
            let ho = document.getElementById('inputho').value;

            let trang_1 = document.getElementById('trang-1').style.display;
            let trang_2 = document.getElementById('trang-2').style.display;
            let trang_3 = document.getElementById('trang-3').style.display;
            if (trang_1 !== "none" && tenkhoahoc !== "" && tentiengviet !== "" && gioi !== '0' && nganh !== '0' && lop !== '0' && bo !== '0' && ho !== '0') {
                document.getElementById('trang-2').style.display = "block";
                document.getElementById('trang-1').style.display = "none";
            }
            if (trang_2 !== "none" && gioi !== '0' && nganh !== '0' && lop !== '0' && bo !== '0' && ho !== '0') {
                document.getElementById('trang-3').style.display = "block";
                document.getElementById('trang-1').style.display = "none";
                document.getElementById('trang-2').style.display = "none";
            }
        }
    </script>

    <script>
        function HideShow_2() {
            let trang_1 = document.getElementById('trang-1').style.display;
            let trang_2 = document.getElementById('trang-2').style.display;
            let trang_3 = document.getElementById('trang-3').style.display;
            if (trang_2 !== "none") {
                document.getElementById('trang-2').style.display = "none";
                document.getElementById('trang-1').style.display = "block";
            }
            if (trang_3 !== "none") {
                document.getElementById('trang-3').style.display = "none";
                document.getElementById('trang-1').style.display = "none";
                document.getElementById('trang-2').style.display = "block";
            }
        }
    </script>
<?php endif; ?>
<?php include '../layout/footer-only.php' ?>