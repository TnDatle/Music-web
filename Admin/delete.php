<?php
require_once('db_connect.php');
$success_message = "";
$show_form = true;

// Kiểm tra xem dữ liệu POST có tồn tại không
if (isset($_POST['Username'], $_POST['Email'], $_POST['Name'])) {
    // Nhận dữ liệu POST
    $username = $_POST['Username'];
    $email = $_POST['Email'];
    $name = $_POST['Name'];
    // Sử dụng thực thi câu lệnh prepared statement để tránh các cuộc tấn công SQL injection
    $sql = "DELETE FROM tbl_user WHERE Username = ? AND Email = ? AND Name = ?";

    // Chuẩn bị và thực thi câu lệnh
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        http_response_code(500);
        echo "Error preparing statement: " . $conn->error;
    } else {
        // Ràng buộc tham số và thực thi câu lệnh
        $stmt->bind_param("sss", $username, $email, $name);
        if (!$stmt->execute()) {
            http_response_code(500);
            echo "Error executing statement: " . $stmt->error;
        } else {
            // Kiểm tra xem có bao nhiêu hàng bị ảnh hưởng
            if ($stmt->affected_rows > 0) {
                // Xóa thành công, hiển thị thông báo và chuyển hướng người dùng đến trang user.php
                $success_message = "Bạn đã xóa thành công";
                $show_form = false;
                sleep(1);
                header("Location: user.php");
                exit;
            } else {
                http_response_code(404);
                echo "Chưa xóa được dữ liệu";
            }
        }
        // Đóng statement
        $stmt->close();
    }
} else {
    // Nếu dữ liệu POST không tồn tại, trả về mã lỗi 400
    http_response_code(400);
    echo "Invalid request";
}

// Đóng kết nối đến cơ sở dữ liệu
$conn->close();
?>
