<?php require_once('db_connect.php'); ?>
<?php
session_start();

// Kiểm tra xem người dùng đã đăng nhập hay chưa
if(!isset($_SESSION['TenTV'])) {
    // Nếu không, chuyển hướng về trang đăng nhập
    header("Location: login/login.php");
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
    <script src="/projects/music2/Admin/js/script.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
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
                    <h3>Thêm Nhạc</h3>
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
                    <h3>Người Dùng </h3>
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
            <h1>Tổng Hợp Dữ Liệu</h1>
            <!-- Analyses -->
            <div class="analyse">
                <div class="sales">
                    <div class="status">
                        <div class="info">
                            <h3>Tổng Số Lượt Nghe</h3>
                            <h1>5,024 lượt</h1>
                        </div>
                        <div class="progresss">
                            <svg>
                                <circle cx="38" cy="38" r="36"></circle>
                            </svg>
                            <div class="percentage">
                                <p>+81%</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="visits">
                    <div class="status">
                        <div class="info">
                            <h3>Số Lượng Truy Cập</h3>
                            <h1>2,498 lượt</h1>
                        </div>
                        <div class="progresss">
                            <svg>
                                <circle cx="38" cy="38" r="36"></circle>
                            </svg>
                            <div class="percentage">
                                <p>-48%</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="searches">
                    <div class="status">
                        <div class="info">
                            <h3>Lượt Tìm Kiếm</h3>
                            <h1>4,178 lượt</h1>
                        </div>
                        <div class="progresss">
                            <svg>
                                <circle cx="38" cy="38" r="36"></circle>
                            </svg>
                            <div class="percentage">
                                <p>+21%</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Analyses -->
            
            <!-- New Users Section -->
            <div class="new-users">
                <h2>Admin truy cập gần đây</h2>
                <div class="user-list">
                    <div class="user">
                        <img src="images mems/td.png">
                        <h2>Tấn Đạt</h2>
                        <p>Đang Hoạt Động</p>
                    </div>
                    <div class="user">
                        <img src="images mems/hh.png">
                        <h2>Huy Hoàng</h2>
                        <p>3 Tiếng Trước</p>
                    </div>
                    <div class="user">
                        <img src="images mems/nh.png">
                        <h2>Nhật Hào</h2>
                        <p>6 Tiếng Trước</p>
                    </div>
                    <div class="user">
                        <img src="images mems/qt.png">
                        <h2>Quốc Trí</h2>
                        <p>5 Tiếng Trước</p>
                    </div>
                    <div class="user">
                        <img src="images mems/bn.png">
                        <h2>Bích Ngọc</h2>
                        <p>7 Tiếng Trước</p>
                    </div>
                </div>
            </div>
            <div class="recent-orders">
                <h2>Nghệ Sĩ Được Tìm Kiếm Nhiều Nhất</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Tên Nghệ Sĩ</th>
                            <th>Mã NS</th>
                            <th>Quốc Tịch</th>
                            <th>Lượt Tìm Kiếm</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="recent-orders-table-body"></tbody>
                </table>
                <a href="#">Xem Thêm</a>
            </div>
            <div class="recent-listen">
                <h2>Bài Hát Được Nghe Nhiều Nhất</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Tên Bài Hát</th>
                            <th>Album</th>
                            <th>Quốc Gia</th>
                            <th>Nghệ Sĩ</th>
                            <th>Số Lần Nghe</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="recent-listen-table-body"></tbody>
                </table>
                <a href="#">Xem Thêm</a>
            </div>
            <!-- End of Recent Orders -->
                  
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


    </div>
    <script src="js/listen.js"></script>
    <script src="js/orders.js"></script>
    <script src="js/index.js"></script>
</body>

</html>