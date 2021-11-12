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
                                <div class="form-group">
                                    <div class="gridtable">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered">
                                                <thead class="bg-primary text-center">
                                                    <tr>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <label for="inputAnimail">Tên khoa học</label>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="inputkhoahoc" class="form-control" id="inputkhoahoc" placeholder="Nhập tên khoa học" required="required">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label for="inputAnimail" required="required">Tên tiếng Việt</label>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="inputtiengviet" class="form-control" id="inputtiengviet" required="required" placeholder="Nhập tên tiếng Việt">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label for="inputAnimail" required="required">Tên địa phương</label>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="inputdiaphuong" class="form-control" id="inputdiaphuong" required="required" placeholder="Nhập tên địa phương">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label for="inputAnimail" required="required">Giới</label>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="inputgioi" class="form-control" id="inputgioi" required="required" placeholder="Nhập giới">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label for="inputAnimail" required="required">Ngành</label>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="inputnganh" class="form-control" id="inputnganh" required="required" placeholder="Nhập ngành">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label for="inputAnimail" required="required">Lớp</label>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="inputlop" class="form-control" id="inputlop" required="required" placeholder="Nhập lớp">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label for="inputAnimail" required="required">Bộ</label>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="inputbo" class="form-control" id="inputbo" required="required" placeholder="Nhập bộ">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label for="inputAnimail" required="required">Họ</label>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="inputho" class="form-control" id="inputho" required="required" placeholder="Nhập họ">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label for="inputAnimail">Mô tả đặc điểm hình thái</label>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="inputhinhthai" class="form-control" id="inputhinhthai" placeholder="Nhập đặc điểm hình thái">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label for="inputAnimail" required="required">Mô tả đặc điểm sinh thái</label>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="inputsinhthai" class="form-control" id="inputsinhthai" placeholder="Nhập đặc Điểm sinh thái">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label for="inputAnimail" required="required">Giá trị sử dụng:</label>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="inputgiatri" class="form-control" id="inputgiatri" placeholder="Nhập giá trị sử dụng">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label for="inputAnimail" required="required">Tình trạng bảo tồn theo IUCN:</label>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="inputiucn" class="form-control" id="inputiucn" placeholder="Nhập IUCN">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label for="inputAnimail" required="required">Tình trạng bảo tồn theo sách đỏ Việt Nam:</label>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="inputsachdo" class="form-control" id="inputsachdo" placeholder="Nhập tình trạng bảo tồn theo sách đỏ Việt Nam">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label for="inputAnimail" required="required">Tình trạng bảo tồn theo Nghị định 32/2006/NĐCP:</label>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="inputndcp" class="form-control" id="inputndcp" placeholder="Nhập NĐCP">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label for="inputAnimail" required="required">Tình trạng bảo tồn theo CITES (40/2013/TT-BNNPTNT):</label>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="inputcites" class="form-control" id="inputcites" placeholder="Nhập CITES">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label for="inputAnimail" required="required">Phân bố:</label>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="inputphanbo" class="form-control" id="inputphanbo" placeholder="Nhập phân bố">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label for="inputAnimail" required="required">Tọa độ 1</label>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="inputtoado1" class="form-control" id="inputtoado1" placeholder="Nhập tọa độ 1">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label for="inputAnimail" required="required">Tọa độ 2</label>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="inputtoado2" class="form-control" id="inputtoado2" placeholder="Nhập tọa độ 2">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label for="inputAnimail" required="required">Tọa độ 3</label>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="inputtoado3" class="form-control" id="inputtoado3" placeholder="Nhập tọa độ 3">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label for="inputAnimail" required="required">Tọa độ 4</label>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="inputtoado4" class="form-control" id="inputtoado4" placeholder="Nhập tọa độ 4">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label for="inputAnimail" required="required">Tọa độ 5</label>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="inputtoado5" class="form-control" id="inputtoado5" placeholder="Nhập tọa độ 5">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label for="inputAnimail" required="required">Tình trạng mẫu vật:</label>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="inputtinhtrang" class="form-control" id="inputtinhtrang" placeholder="Nhập tình trạng mẫu vật">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label for="inputAnimail" required="required">Sinh cảnh</label>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="inputsinhcanh" class="form-control" id="inputsinhcanh" placeholder="Nhập sinh cảnh">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label for="inputAnimail" required="required">Địa điểm</label>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="inputdiadiem" class="form-control" id="inputdiadiem" placeholder="Nhập địa điểm">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label for="inputAnimail" required="required">Ngày thu mẫu</label>
                                                        </td>
                                                        <td>
                                                            <input type="date" name="inputngaythuthap" class="form-control" id="inputngaythuthap" placeholder="Nhập ngày thu mẫu">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label for="inputAnimail" required="required">Người thu mẫu</label>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="inputnguoithumau" class="form-control" id="inputnguoithumau" placeholder="Nhập người thu mẫu">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <!-- <td>
                                                            <label for="inputAnimail" required="required">Đường dẫn</label>
                                                        </td> -->
                                                        <!-- <td>
                                                            <input type="text" name="inputduongdan" class="form-control" id="inputduongdan" placeholder="Đường dẫn">
                                                        </td> -->
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <!-- <hr> -->
                                                            <div class="form-group mt-3 field">
                                                                <label for="inputAnimail" required="required">Thêm hình</label>
                                                                <!--<input type="file" name="fileupload[]" multiple="multiple" /> -->
                                                        </td>
                                                        <td>
                                                            <!--<input type="file" id="files" name="fileupload[]" multiple="multiple" />-->
                                                            <!--<p><input type="submit" name="upload" value="Upload File"/></p>-->
                                                            <input type="file" name="fileupload[]" id="files" multiple required>
                                                            <div class="form-group">
                                                                <div id="image_preview"></div>
                                                            </div>
                                                            <!-- <hr> -->
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            
                                                        </td>
                                                        <td>
                                                            <button type="submit" class="btn btn-info" name="submit"  value="Upload File"><i class="fas fa-plus-circle"></i> Thêm Động Vật</button>
                                                            <button type="button" class="btn btn-info" onclick="reset_text()">
                                                            <i class="fas fa-trash-restore"></i> Làm mới
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
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

    <script>
        /*        $(document).ready(function() {
            if (window.File && window.FileList && window.FileReader) {
                $("#files").on("change", function(e) {
                    var files = e.target.files,
                        filesLength = files.length;
                    for (var i = 0; i < filesLength; i++) {
                        var f = files[i];
                        var fileReader = new FileReader();
                        fileReader.onload = function(e) {
                            var file = e.target;
                            $(
                                '<span class="pip">' +
                                '<img class="imageThumb" src="' +
                                e.target.result +
                                '" title="' +
                                file.name +
                                '"/>' +
                                '<br/><span class="remove">Xóa ảnh</span>' +
                                "</span>"
                            ).insertAfter("#files");
                            $(".remove").click(function() {
                                $(this).parent(".pip").remove();
                            });

                            // Old code here
                            /*$("<img></img>", {
                              class: "imageThumb",
                              src: e.target.result,
                              title: file.name + " | Click to remove"
                            }).insertAfter("#files").click(function(){$(this).remove();});*/
        /*                        };
                                fileReader.readAsDataURL(f);
                            }
                            console.log(files);
                        });
                    } else {
                        alert("Your browser doesn't support to File API");
                    }
                });*/
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

<?php endif; ?>
<?php include '../layout/footer-only.php' ?>