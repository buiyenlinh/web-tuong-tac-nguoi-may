<?php
// include '../../config.php';
include '../layout/header-only.php';
?>
<option value='0'>Chưa chọn</option>
<?php
$con = new mysqli("localhost", "root", "", "web_animal");
$con->set_charset("utf8");
$sql = "SELECT * FROM lop where nganh_id = " . $_POST['inputnganhid'] . ";";
$result = $con->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<option value='" . $row['id'] . "'>" . $row['ten'] . "</option>";
    }
}
?>
