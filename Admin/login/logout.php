<?php
// Bắt đầu session
session_start();

// Hủy bỏ toàn bộ session
session_destroy();

// Chuyển hướng người dùng về trang đăng nhập
header("Location: login.php");
exit(); // Dừng thực hiện các mã lệnh tiếp theo

?>
