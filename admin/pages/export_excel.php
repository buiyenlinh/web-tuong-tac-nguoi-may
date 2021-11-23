<?php 
// Database configuration 
$dbHost     = "localhost"; 
$dbUsername = "root"; 
$dbPassword = ""; 
$dbName     = "web_animal"; 
 
// Create database connection 
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName); 
 
// Check connection 
if ($db->connect_error) { 
    die("Connection failed: " . $db->connect_error); 
}

// Load the database configuration file 
//include_once 'dbConfig.php'; 
 
// Filter the excel data 
function filterData(&$str){ 
    $str = preg_replace("/\t/", "\\t", $str); 
    $str = preg_replace("/\r?\n/", "\\n", $str); 
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
} 
 
// Excel file name for download 
$fileName = "dongvat-data_" . date('Y-m-d') . ".xls"; 
 
// Column names 
$fields = array('ID', 'TEN KHOA HOC', 'TEN TIENG VIET', 'TEN DIA PHUONG', 'HO', 'HINH THAI', 'SINH THAI', 'GIA TRI', 'IUCN', 'SACH DO', 'NGHI DINH', 'CITIES', 'PHAN BO', 'TINH TRANG',
'SINH CANH', 'DIA DIEM', 'NGAY THU THAP', 'NGUOI THU THAP', 'CREATE_AT', 'UPDATE_AT'); 
 
// Display column names as first row 
$excelData = implode("\t", array_values($fields)) . "\n"; 
 
// Fetch records from database 
$query = $db->query("SELECT * FROM dongvat inner join ho on dongvat.ho_id=ho.id ORDER by dongvat.id ASC;"); 
if($query->num_rows > 0){ 
    // Output each row of the data 
    while($row = $query->fetch_assoc()){ 
        $lineData = array($row['id'], $row['tenkhoahoc'], $row['tentiengviet'], $row['tendiaphuong'], $row['ten'], $row['hinhthai'], $row['sinhthai'], $row['giatri']
        , $row['iucn'], $row['sachdo'], $row['nghidinh'], $row['cities'], $row['phanbo'], $row['tinhtrang'], $row['sinhcanh'], $row['diadiem'], $row['ngaythuthap']
        , $row['nguoithuthap'], $row['created_at'], $row['updated_at']); 
        array_walk($lineData, 'filterData'); 
        $excelData .= implode("\t", array_values($lineData)) . "\n"; 
    } 
}else{ 
    $excelData .= 'No records found...'. "\n"; 
} 
 
// Headers for download 
header("Content-Type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=\"$fileName\""); 
 
// Render excel data 
echo $excelData; 
 
exit;
