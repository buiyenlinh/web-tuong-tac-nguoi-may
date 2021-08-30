<?php
date_default_timezone_set('Asia/Saigon');
session_start();

$host = 'localhost';
$database = 'web_animal';
$user = 'root';
$pass = '';

$dsn = 'mysql:host=' . $host . ';dbname=' . $database . ';charset=utf8mb4';
$options = array(
	PDO::ATTR_EMULATE_PREPARES => false,
    PDO::ATTR_PERSISTENT => false,
    PDO::ATTR_CASE => PDO::CASE_LOWER,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
);

try {
	$db = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
	exit('Không thể kết nối cơ sở dữ liệu');
}

define('ROOT', __DIR__);
define('BASE', '/tuongtacnguoimay/web-tuong-tac-nguoi-may/');
define('BASE_IMG', '/tuongtacnguoimay/');
?>