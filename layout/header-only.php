<?php
$install = $db->query('select * from caidat')->fetch();

if ($install['tenwebsite'] == '') {
    $install['tenwebsite'] = 'Tiêu đề website';
}

if ($install['thongtinfooter'] == '') {
    $install['thongtinfooter'] = 'Thông tin footer website của bạn';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $install['tenwebsite'] ?></title>

    <link rel="icon" type="image/png" href="<?php echo BASE . $install['favicon'] ?>">

    <link rel="stylesheet" href="<?php echo BASE?>bootstrap/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href=" <?php echo BASE ?>css/style.css" >
    <link rel="stylesheet" href=" <?php echo BASE ?>css/responsive.css" >

    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAETdh_Wld3z1SqK1ne6kbP_rDJw19WcU8"></script>
</head>
<body onload="InitMap();Getpolygoncoordinates();">