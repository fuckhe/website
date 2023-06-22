<?php
//开启会话
session_start();
if (isset($_SESSION['username'])) {
    // 如果用户已登录，返回用户信息
    echo json_encode(array("username" => $_SESSION['username']));
} else {
    // 如果用户未登录，返回错误信息
    echo json_encode(array("error" => "Not logged in"));
}
?>