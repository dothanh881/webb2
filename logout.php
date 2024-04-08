<?php
require('functions.php');

session_start();
unset($_SESSION['cart']); // Xóa thông tin giỏ hàng
unset($_SESSION['user_id']); // Xóa thông tin đăng nhập của người dùng
session_unset();
session_destroy();

header('location: index.php');
?>