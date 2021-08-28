<?php
date_default_timezone_set('Asia/Saigon');
session_start();

$host = 'localhost';
$database = 'webchym';
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
define('BASE', '/webchym/');

// $user_logined = array();

// if (isset($_SESSION['user'])) {
// 	$row = $db->query('SELECT * FROM ' . PREFIX . '_users WHERE id = ' . intval($_SESSION['user']['id']))->fetch();
// 	if (!empty($row)) {// kiểm tra tài khoản hợp lệ
// 		$_SESSION['user'] = $row;
// 	} else {
// 		unset($_SESSION['user']);
// 	}
// }
?>