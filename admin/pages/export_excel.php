<?php
// Database configuration 
$con = new mysqli("localhost", "root", "", "web_animal");
$con->set_charset("utf8");

// Filter the excel data 
function filterData(&$str)
{
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if (strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
    $str = mb_convert_encoding($str, 'UTF-8');
}

// Excel file name for download 
$fileName = "dongvat-data_" . date('Y-m-d') . ".xls";

// Column names 
$fields = array(
    'TEN KHOA HOC', 'TEN TIENG VIET', 'TEN DIA PHUONG', 'HO', 'HINH THAI', 'SINH THAI', 'GIA TRI', 'IUCN', 'SACH DO', 'NGHI DINH', 'CITIES', 'PHAN BO', 'TINH TRANG',
    'SINH CANH', 'DIA DIEM', 'NGAY THU THAP', 'NGUOI THU THAP', 'CREATE_AT', 'UPDATE_AT'
);

// Display column names as first row 
$excelData = implode("\t", array_values($fields)) . "\n";

// Fetch records from database 
$query = $con->query("SELECT * FROM dongvat inner join ho on dongvat.ho_id=ho.id ORDER by dongvat.id ASC;");
if ($query->num_rows > 0) {
    // Output each row of the data 
    while ($row = $query->fetch_assoc()) {
        $lineData = array(
            $row['tenkhoahoc'], $row['tentiengviet'], $row['tendiaphuong'], $row['ten'], $row['hinhthai'], $row['sinhthai'], $row['giatri'], $row['iucn'], $row['sachdo'], $row['nghidinh'], $row['cities'], $row['phanbo'], $row['tinhtrang'], $row['sinhcanh'], $row['diadiem'], $row['ngaythuthap'], $row['nguoithuthap'], $row['created_at'], $row['updated_at']
        );
        array_walk($lineData, 'filterData');
        $excelData .= implode("\t", array_values($lineData)) . "\n";
    }
} else {
    $excelData .= 'No records found...' . "\n";
}

// Headers for download 
header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=\"$fileName\"");

// Render excel data 
echo $excelData;

exit;
