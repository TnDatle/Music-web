<?php require_once('db_connect.php'); ?>
<?php
session_start();

// Kiểm tra xem người dùng đã đăng nhập hay chưa
if(!isset($_SESSION['TenTV'])) {
    // Nếu không, chuyển hướng về trang đăng nhập
    header("Location: ../login/login.php");
    exit(); // Dừng thực hiện các mã lệnh tiếp theo
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">    
    <link rel="stylesheet" href="style.css">
    
    <title>Music Studio Admin</title>
</head>

<body>

    <div class="container">
        <!-- Sidebar Section -->
        <aside>
            <div class="toggle">
                <div class="logo">
                    <img src="images/logo.png">
                    <h2>Admin<span class="danger">Page</span></h2>
                </div>
                <div class="close" id="close-btn">
                    <span class="material-icons-sharp">
                        close
                    </span>
                </div>
            </div>

            <div class="sidebar">
                <a href="themnhac.php">
                    <span class="material-icons-sharp">
                        dashboard
                    </span>
                    <h3>Thêm nhạc</h3>
                </a>
                <a href="music-delete.php">
                    <span class="material-icons-sharp">
                        dashboard
                    </span>
                    <h3>List nhạc</h3>
                </a>
                <a href="user.php">
                    <span class="material-icons-sharp">
                        person_outline
                    </span>
                    <h3>Người Dùng</h3>
                </a>
                <a href="themnghesi.php">
                    <span class="material-icons-sharp">
                        person_outline
                    </span>
                    <h3>Quản lý nghệ sĩ</h3>
                </a>
                <a href="index.php" class="active">
                    <span class="material-icons-sharp">
                        insights
                    </span>
                    <h3>Dữ Liệu</h3>
                </a>
                <a href="login/logout.php">
                    <span class="material-icons-sharp">
                        logout
                    </span>
                    <h3>Đăng Xuất</h3>
                </a>
            </div>
        </aside>
        <!-- End of Sidebar Section -->

        <!-- Main Content -->
<main>

<?php
$link = new mysqli("localhost", "root", "", "db_musicweb"); // Kết nối đến cơ sở dữ liệu
$error_message = "";
$success_message = "";
$show_form = true;


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) { 
    // Lấy dữ liệu từ biểu mẫu
    $id = $_POST["id"]; 
    $name = isset($_POST["name"]) ? $_POST["name"] : ""; // Lấy giá trị của biến name, nếu không tồn tại thì gán giá trị rỗng
    $image_path = $_POST["image_path"];

    // Kiểm tra xem người dùng đã tồn tại hay chưa
    $check_sql = "SELECT * FROM tbl_artist WHERE name = '$name'";
    $check_result = $link->query($check_sql);

    if ($check_result->num_rows > 0) {
        $error_message = "Tên nghệ sĩ đã tồn tại";
        $show_form = true; // Hiển thị biểu mẫu lại nếu tên đã tồn tại
    } else {
        // Thực hiện truy vấn để thêm nghệ sĩ vào cơ sở dữ liệu
        $insert_sql = "INSERT INTO tbl_artist (id, name, image_path) VALUES ('$id', '$name', '$image_path')";

        if ($link->query($insert_sql) === TRUE) {
            $success_message = "Thêm Nghệ Sĩ thành công";
            $show_form = false; // Ẩn biểu mẫu nếu thành công
        } else {
            echo "Lỗi: " . $insert_sql . "<br>" . $link->error; // Sử dụng $link->error để hiển thị lỗi
        }
    }
}
?>

<div style="max-width: 500px; margin: 50px auto; background-color: #fff; padding: 20px; border-radius: 8px; float:left">
<h2>Thêm Nghệ Sĩ</h2>
        <form id="artistForm" method="POST">
        <div style="margin-bottom: 20px; background-color: #f9f9f9;">
            <label for="id" style="display: block; font-weight: bold; margin-bottom: 5px;">ID:</label>
            <input type="text" id="id" name="id" style="width: 300px; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
        </div>
        <div style="margin-bottom: 20px; background-color: #f0f0f0;">
            <label for="name" style="display: block; font-weight: bold; margin-bottom: 5px;">Tên Nghệ Sĩ:</label>
            <input type="text" id="name" name="name" style="width: 300px; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
        </div>
        <div style="margin-bottom: 20px; background-color: #e6e6e6;">
            <label for="image_path" style="display: block; font-weight: bold; margin-bottom: 5px;">Đường Dẫn Ảnh:</label>
            <input type="text" id="image_path" name="image_path" style="width: 300px; padding: 8px; border: 1px solid #ccc; border-radius: 4px;"; placeholder="../Admin/image_artist/tenfile.jpg">
        </div>
        <div style="margin-bottom: 20px">
            <input type="submit" value="Thêm" style="width: 100%;height:40px; background-color: #007bff; color: #fff; border: none; cursor: pointer;border-radius:40px;font-weight:bold">
        </div>
    </form>
</div>
<!-- Hiển thị danh sách nghệ sĩ -->
<h2 style="color:#FF0066;padding-top:20px;text-align:center">Danh Sách Người Dùng</h2>
    <table style="padding-left:200px">
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Chỉnh sửa</th>
        </tr>
<?php 
$link = new mysqli("localhost", "root", "", "db_musicweb");
$success_message = "";
$show_form = true;

// Truy vấn dữ liệu từ bảng users
$sql = "SELECT * FROM tbl_artist";
$result = $conn->query($sql);

// Hiển thị dữ liệu trên giao diện
if ($result->num_rows > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $success_message = ""; // Khởi tạo biến $success_message cho mỗi hàng

        // Kiểm tra nếu form đã được xác nhận và dữ liệu đã được xử lý thành công
        if (isset($_POST['id']) && $_POST['name'] == $row['image_path']) {
            if (isset($_SESSION['delete_success']) && $_SESSION['delete_success'] && isset($_SESSION['deleted_name']) && $_SESSION['deleted_name'] == $row['name']) {
                $success_message = "Xóa thành công";
                unset($_SESSION['delete_success']); // Xóa session
                unset($_SESSION['deleted_username']); // Xóa session
            }
            $show_form = false; // Ẩn form sau khi xử lý
        }
?>
<tr>
    <td><?php echo $row["id"]; ?></td>
    <td><?php echo $row["name"]; ?></td>
    <!-- Sử dụng mã PHP để tạo một form và nút xóa -->
    <td>
        <?php if ($show_form): ?>
            <form action="delete-artist.php" method="POST">
                <input style="text-align:center" type="hidden" name="id" value="<?php  echo $row['id']; ?>">
                <input type="hidden" name="name" value="<?php echo $row['name']; ?>">
                <button style="float:right" type="submit">Xóa</button>
            </form>
        <?php endif; ?>
        <div id="success_message">
            <?php echo $success_message; ?>
        </div>
    </td>
</tr>
<?php
    }
} else {
    echo "<tr><td colspan='4'>Không có nghệ sĩ</td></tr>";
}
?>
    </table>
</main>
        <!-- End of Main Content -->

        <!-- Right Section -->
        <div class="right-section">
            <div class="nav">
                <button id="menu-btn">
                    <span class="material-icons-sharp">
                        menu
                    </span>
                </button>
                <div class="dark-mode">
                    <span class="material-icons-sharp active">
                        light_mode
                    </span>
                    <span class="material-icons-sharp">
                        dark_mode
                    </span>
                </div>
                <div class="profile" style="padding-right:10px">
        <div class="info">
            <!-- Kiểm tra session và hiển thị tên admin -->
            <?php if(isset($_SESSION['TenTV'])): ?>
                <p>Chào, <b><?php echo $_SESSION['TenTV']; ?></b></p>
            <?php endif; ?>
            <small class="text-muted" style="padding-right:20px">Admin</small>
        </div>
                </div>

            </div>
            <!-- End of Nav -->

            <div class="user-profile">
                <div class="logo">
                    <img src="images/logo.png">
                    <h2>AdminPage</h2>
                    <p>Trang Quản Trị</p>
                </div>
            </div>

            <div class="reminders">
                <div class="header">
                    <h2>Ghi Chú</h2>
                    <span class="material-icons-sharp">
                        notifications_none
                    </span>
                </div>

                <div class="notification">
                    <div class="icon">
                        <span class="material-icons-sharp">
                            volume_up
                        </span>
                    </div>
                    <div class="content">
                        <div class="info">
                            <h3>Thời Gian Làm Việc</h3>
                            <small class="text_muted">
                                08:00 AM - 17:00 PM
                            </small>
                        </div>
                        <span class="material-icons-sharp">
                            more_vert
                        </span>
                    </div>
                </div>

                <div class="notification deactive">
                    <div class="icon">
                        <span class="material-icons-sharp">
                            edit
                        </span>
                    </div>
                    <div class="content">
                        <div class="info">
                            <h3>Thông Báo Nghỉ Lễ</h3>
                            <small class="text_muted">
                                <span>
                            Giỗ Tổ Hùng Vương : Thứ 5 18/04/2024 (10/3 AL)
                                </span>   
                            </small>
                        </div>
                        <span class="material-icons-sharp">
                            more_vert
                        </span>
                    </div>
                </div>

                <div class="notification add-reminder">
                    <div>
                        <span class="material-icons-sharp">
                            add
                        </span>
                        <h3>Thêm Ghi Chú</h3>
                    </div>
                </div>

            </div>

        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <script src="/projects/music2/Admin/js/script.js"></script>

    </div>
</body>

</html>