<?php
session_start();

// Kiểm tra xem người dùng đã đăng nhập hay chưa
if(!isset($_SESSION['TenTV'])) {
    // Nếu không, chuyển hướng về trang đăng nhập
    header("Location: ..login/login.php");
    exit(); // Dừng thực hiện các mã lệnh tiếp theo
} else {
    // Nếu đã đăng nhập, chuyển hướng đến trang admin
    header("Location: ../index.php");
    exit(); // Dừng thực hiện các mã lệnh tiếp theo
}
?>
