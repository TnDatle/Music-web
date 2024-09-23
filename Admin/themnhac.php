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
           <!-- Form thêm nhạc -->
           <div class="modal" id="music_modal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-md" style="display:flex;margin:0% auto;padding-top:60px">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h5 class="" style="color: #FF0066; font-size: 25px;text-align:left"> Add New Music</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="margin:0% auto;">
                <div class="container-fluid">
                    <form action="" id="music-form">
                         <input type="hidden" name="id" >
                        <div class="form-group mb-3" style="display:flex; align-items: center;padding:15px;">
                            <label for="title" class="control-label" style="width: 100px;font-size:15px;font-weight: bold;">Title</label>
                            <input type="text" name="title" id="title" style="margin-left:10px;height:25px;border: 1px solid black" class="form-control form-control-sm rounded-0" required placeholder="Song Name">
                        </div>
                        <div class="form-group mb-3" style="display:flex; align-items: center;padding:15px;">
                            <label for="description" class="control-label" style="width: 100px;font-size:15px;font-weight: bold;">Description</label>
                            <textarea rows="3" name="description" id="description" style="margin-left:10px;border: 1px solid black" class="form-control form-control-sm rounded-0" required placeholder="Write the description here"></textarea>
                        </div>
                        <div class="form-group mb-3" style="display:flex; align-items: center;padding:15px;">
                            <label for="audio" class="control-label" style="width: 100px;font-size:15px;font-weight: bold;">Audio File</label>
                            <input type="file" name="audio" id="audio" style="margin-left:10px;" class="form-control form-control-sm rounded-0" required accept="audio/*" onchange="displayFileText(this)">
                         </div>
                        <div class="form-group mb-3" style="display:flex; align-items: center;padding:15px;">
                            <label for="img" class="control-label" style="width: 100px;font-size:15px;font-weight: bold;">Display Image</label>
                            <input type="file" name="img" id="img" style="margin-left:10px;" class="form-control form-control-sm rounded-0" accept="image/*" onchange="displayImg(this,'dImage')">
                        </div>
                        <div class="form-group mb-3 text-center" style="display:flex;padding:15px;">
                            <div class="col-md-6">
                            <img src="../H_IMGAES/logo1.png" alt="Image" class="img-fluid img-thumbnail bg-gradient bg-dark" id="dImage">
                        </div>
                    </form> 
                </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-sm rounded-0" style="padding:10px 14px;margin-left:78px;font-size:18px;" form="music-form">Add New Song</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- update music -->
        <div class="modal text-dark" id="update_music_modal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h5 class="modal-title"  style="color: #FF0066; font-size: 25px;text-align:left"></i> Update My Playlist</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form action="" id="update-music-form">
                            <input type="hidden" name="id" >
                            <div class="form-group mb-3"style="display:flex; align-items: center;padding:15px;">
                                <label for="title2" class="control-label"style="width: 100px;font-size:15px;font-weight: bold;" >Song Name</label>
                                <input type="text" name="title" id="title2" style="margin-left:10px;height:25px;border: 1px solid black"class="form-control form-control-sm rounded-0" required placeholder="Song Name">
                            </div>
                            <div class="form-group mb-3"style="display:flex; align-items: center;padding:15px;">
                                <label for="name_a2" class="control-label"style="width: 100px;font-size:15px;font-weight: bold;" >Description</label>
                                <textarea rows="3" name="name_a" id="name_a2"style="margin-left:10px;border: 1px solid black" class="form-control form-control-sm rounded-0" required placeholder="Write the description here/ features"></textarea>
                            </div>
                            <div class="form-group mb-3"style="display:flex; align-items: center;padding:15px;">
                                <label for="audio2" class="control-label"style="width: 100px;font-size:15px;font-weight: bold;" >Audio File</label>
                                <input type="file" name="audio" id="audio2"style="margin-left:10px;" class="form-control form-control-sm rounded-0" accept="audio/*" onchange="displayFileText(this)">
                                <small><i><span class="text-muted">Current:</span> <span id="audio-current"></span></i></small>
                            </div>
                            <div class="form-group mb-3"style="display:flex; align-items: center;padding:15px;">
                                <label for="img2" class="control-label"style="width: 100px;font-size:15px;font-weight: bold;" >Display Image</label>
                                <input type="file" name="img" id="img2" style="margin-left:10px;"class="form-control form-control-sm rounded-0" accept="image/*" onchange="displayImg(this,'dImage2')">
                            </div>
                            <div class="form-group mb-3 text-center" style="display:flex;padding:15px;">
                                <div class="col-md-6">
                                <img src="../H_IMGAES/logo1.png" alt="Image" class="img-fluid img-thumbnail bg-gradient bg-dark" id="dImage2">
                                </div>
                            </div>
                        </form> 
                    </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn-sm rounded-0" form="update-music-form" style="padding:10px 14px;margin-left:80px;font-size:18px">Update Music</button>
                        </div>
                </div>
            </div>
        </div>
                </div>

       
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