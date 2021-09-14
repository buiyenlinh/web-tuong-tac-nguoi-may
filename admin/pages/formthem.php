<?php
include '../../config.php';
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
                                                            <input type="text" name="inputkhoahoc" class="form-control" id="inputkhoahoc" placeholder="Nhập tên Khoa học" required="required">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label for="inputAnimail" required="required">Tên tiếng Việt</label>
                                                        </td>
                                                        <td>
                                                            <input type="email" name="inputtiengviet" class="form-control" id="inputtiengviet" required="required" placeholder="Nhập tên tiếng Việt">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label for="inputAnimail" required="required">Tên địa phương</label>
                                                        </td>
                                                        <td>
                                                            <input type="email" name="inputdiaphuong" class="form-control" id="inputdiaphuong" required="required" placeholder="Nhập tên địa phương">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label for="inputAnimail" required="required">Giới</label>
                                                        </td>
                                                        <td>
                                                            <input type="email" name="inputgioi" class="form-control" id="inputgioi" required="required" placeholder="Nhập giới">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label for="inputAnimail" required="required">Ngành</label>
                                                        </td>
                                                        <td>
                                                            <input type="email" name="inputnganh" class="form-control" id="inputnganh" required="required" placeholder="Nhập ngành">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label for="inputAnimail" required="required">Lớp</label>
                                                        </td>
                                                        <td>
                                                            <input type="email" name="inputlop" class="form-control" id="inputlop" required="required" placeholder="Nhập lớp">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label for="inputAnimail" required="required">Bộ</label>
                                                        </td>
                                                        <td>
                                                            <input type="email" name="inputbo" class="form-control" id="inputbo" required="required" placeholder="Nhập bộ">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label for="inputAnimail" required="required">Họ</label>
                                                        </td>
                                                        <td>
                                                            <input type="email" name="inputho" class="form-control" id="inputho" required="required" placeholder="Nhập họ">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label for="inputAnimail">Mô tả đặc điểm hình thái</label>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="inputhinhthai" class="form-control" id="inputhinhthai" placeholder="Nhập Mô tả đặc điểm hình thái">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label for="inputAnimail" required="required">Mô tả đặc điểm sinh thái</label>
                                                        </td>
                                                        <td>
                                                            <input type="email" name="inputsinhthai" class="form-control" id="inputsinhthai" placeholder="Nhập Mô tả đặc điểm sinh thái">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label for="inputAnimail" required="required">Giá trị sử dụng:</label>
                                                        </td>
                                                        <td>
                                                            <input type="email" name="inputgiatri" class="form-control" id="inputgiatri" placeholder="Nhập Giá trị sử dụng">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label for="inputAnimail" required="required">Tình trạng bảo tồn theo IUCN:</label>
                                                        </td>
                                                        <td>
                                                            <input type="email" name="inputiucn" class="form-control" id="inputiucn" placeholder="Nhập Tình trạng bảo tồn theo IUCN">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label for="inputAnimail" required="required">Tình trạng bảo tồn theo sách đỏ Việt Nam:</label>
                                                        </td>
                                                        <td>
                                                            <input type="email" name="inputsachdo" class="form-control" id="inputsachdo" placeholder="Nhập Tình trạng bảo tồn theo sách đỏ Việt Nam">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label for="inputAnimail" required="required">Tình trạng bảo tồn theo Nghị định 32/2006/NĐCP:</label>
                                                        </td>
                                                        <td>
                                                            <input type="email" name="inputndcp" class="form-control" id="inputndcp" placeholder="Nhập Tình trạng bảo tồn theo Nghị định 32/2006/NĐCP">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label for="inputAnimail" required="required">Tình trạng bảo tồn theo CITES (40/2013/TT-BNNPTNT):</label>
                                                        </td>
                                                        <td>
                                                            <input type="email" name="inputcites" class="form-control" id="inputcites" placeholder="Nhập Tình trạng bảo tồn theo CITES (40/2013/TT-BNNPTNT)">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label for="inputAnimail" required="required">Phân bố:</label>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="inputphanbo" class="form-control" id="inputphanbo" placeholder="Nhập Phân bố">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label for="inputAnimail" required="required">Tọa độ 1</label>
                                                        </td>
                                                        <td>
                                                            <input type="email" name="inputtoado1" class="form-control" id="inputtoado1" placeholder="Nhập Tọa độ 1">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label for="inputAnimail" required="required">Tọa độ 2</label>
                                                        </td>
                                                        <td>
                                                            <input type="email" name="inputtoado2" class="form-control" id="inputtoado2" placeholder="Nhập Tọa độ 2">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label for="inputAnimail" required="required">Tọa độ 3</label>
                                                        </td>
                                                        <td>
                                                            <input type="email" name="inputtoado3" class="form-control" id="inputtoado3" placeholder="Nhập Tọa độ 3">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label for="inputAnimail" required="required">Tọa độ 4</label>
                                                        </td>
                                                        <td>
                                                            <input type="email" name="inputtoado4" class="form-control" id="inputtoado4" placeholder="Nhập Tọa độ 4">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label for="inputAnimail" required="required">Tọa độ 5</label>
                                                        </td>
                                                        <td>
                                                            <input type="email" name="inputtoado5" class="form-control" id="inputtoado5" placeholder="Nhập Tọa độ 5">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label for="inputAnimail" required="required">Tình trạng mẫu vật:</label>
                                                        </td>
                                                        <td>
                                                            <input type="email" name="inputtinhtrang" class="form-control" id="inputtinhtrang" placeholder="Nhập Tình trạng mẫu vật">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label for="inputAnimail" required="required">Sinh cảnh</label>
                                                        </td>
                                                        <td>
                                                            <input type="email" name="inputsinhcanh" class="form-control" id="inputsinhcanh" placeholder="Nhập Sinh cảnh">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label for="inputAnimail" required="required">Địa điểm</label>
                                                        </td>
                                                        <td>
                                                            <input type="email" name="inputdiadiem" class="form-control" id="inputdiadiem" placeholder="Nhập Địa điểm">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label for="inputAnimail" required="required">Ngày thu mẫu</label>
                                                        </td>
                                                        <td>
                                                            <input type="email" name="inputngaythuthap" class="form-control" id="inputngaythuthap" placeholder="Nhập Ngày thu mẫu">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label for="inputAnimail" required="required">Người thu mẫu</label>
                                                        </td>
                                                        <td>
                                                            <input type="email" name="inputnguoithumau" class="form-control" id="inputnguoithumau" placeholder="Nhập Người thu mẫu">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label for="inputAnimail" required="required">Đường dẫn</label>
                                                        </td>
                                                        <td>
                                                            <input type="email" name="inputduongdan" class="form-control" id="inputduongdan" placeholder="Đường dẫn">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <!-- <hr> -->
                                                            <div class="form-group mt-3 field">
                                                                <label for="inputAnimail" required="required">Thêm hình</label>
                                                                <!--<input type="file" name="fileupload[]" multiple="multiple" /> -->
                                                        </td>
                                                        <td>
                                                            <input type="file" id="files" name="fileupload[]" multiple="multiple" />
                                                            <!--<p><input type="submit" name="upload" value="Upload File"/></p>-->
                                        </div>
                                        <!-- <hr> -->
                                        </td>
                                        </tr>
                                        <tr>
                                            <td>
                                            </td>
                                            <td>
                                                <button type="submit" class="btn btn-info" name="submit"  value="Upload File">Thêm Dộng Vật</button>
                                            </td>
                                        </tr>
                                        </tbody>
                                        </table>
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js">
    </script>


    <script>
        $(document).ready(function() {
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
                        };
                        fileReader.readAsDataURL(f);
                    }
                    console.log(files);
                });
            } else {
                alert("Your browser doesn't support to File API");
            }
        });
    </script>
<?php endif; ?>
<?php include '../layout/footer-only.php' ?>