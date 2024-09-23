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
<style>
    .add-music-form {
    background-color: var(--color-white);
    padding: var(--card-padding);
    border-radius: var(--card-border-radius);
    margin-top: 1.3rem;
    box-shadow: var(--box-shadow);
}

.add-music-form h2 {
    margin-bottom: 1rem;
}

.add-music-form form {
    display: grid;
    gap: 1rem;
}

.add-music-form select {
        padding: 0.6rem;
        border: 1px solid var(--color-info-dark);
        border-radius: var(--border-radius-1);
        font-size: 1rem;
    }

.add-music-form option {
        font-size: 1rem;
    }

.add-music-form .form-group {
    display: flex;
    flex-direction: column;
}

.add-music-form label {
    margin-bottom: 0.4rem;
}

.add-music-form input[type="text"],
.add-music-form input[type="date"],
.add-music-form input[type="file"] {
    padding: 0.6rem;
    border: 1px solid var(--color-info-dark);
    border-radius: var(--border-radius-1);
    font-size: 1rem;
}

.add-music-form button {
    padding: 0.6rem 1.5rem;
    background-color: var(--color-primary);
    color: var(--color-white);
    border: none;
    border-radius: var(--border-radius-1);
    font-size: 1rem;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.add-music-form button:hover {
    background-color: #4a80c1;
}
table {
    width: 100%;
    border-collapse: collapse;
}
table, th, td {
    border: 1px solid black;
}
th, td {
    padding: 8px;
    text-align: left;
}



</style>
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
                <a href="">
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
    <h2 style="color:#FF0066;padding-top:20px;text-align:center">Danh Sách Người Dùng</h2>
    <table>
        <tr>
            <th>Tên Đăng Nhập</th>
            <th>Email</th>
            <th>Tên</th>
            <th>Password</th>
            <th>Chỉnh sửa</th>
        </tr>
<?php 
$link = new mysqli("localhost", "root", "", "db_musicweb");
$success_message = "";
$show_form = true;

// Truy vấn dữ liệu từ bảng users
$sql = "SELECT * FROM tbl_user";
$result = $conn->query($sql);

// Hiển thị dữ liệu trên giao diện
if ($result->num_rows > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $success_message = ""; // Khởi tạo biến $success_message cho mỗi hàng

        // Kiểm tra nếu form đã được xác nhận và dữ liệu đã được xử lý thành công
        if (isset($_POST['Username']) && $_POST['Username'] == $row['Username']) {
            if (isset($_SESSION['delete_success']) && $_SESSION['delete_success'] && isset($_SESSION['deleted_username']) && $_SESSION['deleted_username'] == $row['Username']) {
                $success_message = "Xóa thành công";
                unset($_SESSION['delete_success']); // Xóa session
                unset($_SESSION['deleted_username']); // Xóa session
            }
            $show_form = false; // Ẩn form sau khi xử lý
        }
?>
<tr>
    <td><?php echo $row["Username"]; ?></td>
    <td><?php echo $row["Email"]; ?></td>
    <td><?php echo $row["Name"]; ?></td>
    <td><?php echo $row["Password"]; ?></td>
    <!-- Sử dụng mã PHP để tạo một form và nút xóa -->
    <td>
        <?php if ($show_form): ?>
            <form action="delete.php" method="post">
                <input type="hidden" name="Username" value="<?php echo $row['Username']; ?>">
                <input type="hidden" name="Email" value="<?php echo $row['Email']; ?>">
                <input type="hidden" name="Name" value="<?php echo $row['Name']; ?>">
                <input type="hidden" name="Password" value="<?php echo $row['Password']; ?>">
                <button type="submit">Xóa</button>
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
    echo "<tr><td colspan='4'>No users found</td></tr>";
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
        
        <script src="/projects/music2/Admin/js/script.js"></script>
    </div>
</body>

</html>