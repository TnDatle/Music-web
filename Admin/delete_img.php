<?php require_once('db_connect.php'); ?>
<?php 


// Kiểm tra xem id của bản ghi cần xóa đã được gửi từ form hay không
if(isset($_POST['id'])) {
    $id = $_POST['id'];

    // Chuẩn bị truy vấn xóa
    $sql = "DELETE FROM tbl_music WHERE id = $id";

    // Thực hiện truy vấn
    if ($conn->query($sql) === TRUE) {
        // Nếu xóa thành công, chuyển hướng người dùng đến trang chính
        header("Location: music-delete.php"); // Thay đổi index.php thành trang bạn muốn chuyển hướng đến sau khi xóa
        exit();
    } else {
        // Nếu có lỗi xảy ra, in ra thông báo lỗi
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Đóng kết nối đến cơ sở dữ liệu
$conn->close();
?>
