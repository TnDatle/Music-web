<?php
// Bắt đầu session
session_start();

// Xóa toàn bộ session hiện tại
$_SESSION = array();

// Nếu có sử dụng cookies trong session, bạn cũng cần hủy bỏ cookie.
// Lưu ý: Thường thì không sử dụng cookies trong session nhưng nếu có,
// hãy sử dụng thông tin về cookie của bạn ở đây.

// Hủy bỏ session
session_destroy();

// Chuyển hướng người dùng về trang đăng nhập
header("Location: login.php");
exit(); // Dừng thực hiện các mã lệnh tiếp theo
?>
