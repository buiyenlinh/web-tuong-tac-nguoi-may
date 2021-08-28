<?php

include 'config.php';

function _getString($name, $default='') {
    if (isset($_POST[$name])) {
        return trim($_POST[$name]);
    }
    return $default;
}

function _getInt($name, $default = 0) {
    if (isset($_POST[$name])) {
        return $_POST[$name];
    }

    return $default;
}

function _success($message, $data = array()) {
    exit(json_encode(array(
        'status'=> 'OK',
        'data' => $data,
        'message' => $message
    )));
}

function _error($message) {
    exit(json_encode(array(
        'status' => 'error',
        'error' => $message
    )));
}

$action = _getString('action');

?>