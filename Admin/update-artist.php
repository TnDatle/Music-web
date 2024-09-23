<?php
$link = new mysqli("localhost", "root", "", "db_musicweb");
$error_message = "";
$success_message = "";
$show_form = true;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["input"])) {
    // Lấy dữ liệu từ biểu mẫu
    $id = $_POST["id"];
    $name = $_POST["name"];
    $image_path = $_POST["image_path"];

    // Kiểm tra xem người dùng đã tồn tại hay chưa
    $check_sql = "SELECT * FROM tbl_artist WHERE name = '$name'";
    $check_result = $link->query($check_sql);

    if ($check_result->num_rows > 0) {
        $error_message = "Tên nghệ sĩ đã tồn tại";
        $show_form = true; // Hiển thị biểu mẫu lại nếu tên đăng nhập đã tồn tại
    } else {
        // Thực hiện truy vấn để thêm người dùng vào cơ sở dữ liệu
        $insert_sql = "INSERT INTO tbl_artist (id, name, image_path) VALUES ('$id', '$name', '$image_path')";

        if ($link->query($insert_sql) === TRUE) {
            $success_message = "Thêm Nghệ Sĩ thành công";
            $show_form = false; // Ẩn biểu mẫu nếu đăng ký thành công
            header("Location: themnghesi.php");
        } else {
            echo "Lỗi: " . $insert_sql . "<br>" . $conn->error;
        }
    }
}
?>