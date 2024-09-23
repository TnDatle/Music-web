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
.m_begi ul
        {
            display: flex;
            /* flex-direction: row; */
            flex-wrap: wrap;
            margin-top:2px;
            overflow-y: scroll;
            /* height: 450px; */
            height: 600px;
            background-color:#f1f1f1;
        }
        .mlist__ .add_new_music:hover 
        {
            background-color: red;
        }
        
        .m_begi ul::-webkit-scrollbar {
             width: 6px;
             height: 6px;
        }
        .m_begi ul::-webkit-scrollbar-button {
             width: 0px;
             height: 0px;
        }
        .m_begi ul::-webkit-scrollbar-thumb {
             background: blue;
             border: 0px none #ffffff;
             border-radius: 0px;
        }
        .m_begi ul::-webkit-scrollbar-thumb:hover {
             background: darkblue;
             cursor: pointer;
        }
        .m_begi ul::-webkit-scrollbar-thumb:active {
                background: darkblue;
        }
        .m_begi ul::-webkit-scrollbar-track {
             background: #d63384;
                /* border: 83px none #ffffff; */
                border-radius: 0px;
        }
        .m_begi ul::-webkit-scrollbar-track:hover {
                background: #d63384;
        }
        .m_begi ul::-webkit-scrollbar-track:active {
                background: #333333;
        }
        .m_begi ul::-webkit-scrollbar-corner {
                background: transparent;
        }

        .m_begi ul li 
        {
            transform: translatex(50px);
            margin: 10px 10px;
            list-style: none;
            padding: 0px;
            width: fit-content;
            overflow: hidden;
            display: block;
        }
        .li_check 
        {
            display: flex;
            flex-direction: column;
            height: fit-content;
            padding: 0px;
            overflow: hidden;
            position: relative;
        }
        .li_check .li_check_img
        {
            height: 150px;
            width: 100%;
            padding: 0;
            cursor: pointer;
        }
        .li_check .li_check_img img
        {
            width: 130px;
            height: 150px;
        }
        .overlay_123 
        {
            position: absolute;
            background: linear-gradient(transparent, rgba(0,0,0,.8));
            width: 170px;
            height: 190px;
            top: 0;
            place-items: center;
            justify-content: center;
            display: flex;
            flex-direction: column;
            transition: 0.3s;
            opacity: 0;
        }
        .m_begi ul li:hover .overlay_123
        {
            opacity: 1;
        }
        .mname123 
        {
            display: flex;
            flex-direction: column;
            cursor: pointer;
        }
        .mname123 .title__ 
        {
            color: black;
            font-weight: 500;
            margin-top: 5px;
            max-width: 130px;
            font-size: 19px;
        }
        .desc___
        {
            font-size: 12px;
            opacity: .5;
            max-width: 130px;
        }
        .overlay_123 .over_btn 
        {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            width: 100%;
            padding: 10px;
        }
        .overlay_123 .over_btn button 
        {
            border: none;
            height: 30px;
            padding: 5px;
            width: 30px;
            border-radius: 50px;
            text-align: center;
            font-size: 14px;
            background-color: inherit;
            color: #fff;
            transition: 0.3s;
            margin :0% auto ;
        }
        #play__ 
        {
            transform: scale(2,2);
            background-color: rgba(0,0,0,.2);
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
                <a href="">
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
    <main>
        <div class="m_begi">
        <ul class="" id="music-list">
                                <img src="/projects/music2/music_player/dashboard/0_kulosa.jpg" alt="">
                                <?php 
                                $music = $conn->query('SELECT * FROM `tbl_music` order by title asc');
                                while($row = $music->fetch_assoc()):
                                ?>
                                <li class="item" data-id="<?= $row['id'] ?>">
                                    <div class="li_check">
                                        <div class="li_check_img" style="float:left;margin:20px;">
                                            <img src="<?= is_file(explode("?",$row['image_path'])[0]) ? $row['image_path'] : "  ../H_IMGAES/logo1.png" ?>" alt="" class="mini-display-img">
                                        </div>
                                            <div class="mname123" style="margin:0% auto;">
                                                <span class="title__" title="<?= $row['title'] ?>"><?= $row['title'] ?> </span>
                                                <span class="desc___" title="<?= $row['description'] ?>"><?= $row['description'] ?></span>
                                            </div>
                                        <div class="overlay_123">
                                            <div class="over_btn">
                                                
                                                <button class=" play" id="play__"  data-id="<?= $row['id'] ?>" data-type="pause"><i class="fa fa-play"></i></button>
                                                
                                            </div>
                                        </div>
                                        <div class="delete"style="margin:0% auto;">
                                        <form action="delete_img.php" method="post" >
                                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                            <button type="submit" style="background-color: #f44336; /* Đỏ */
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            outline: none; /* Loại bỏ viền khi được nhấn */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); /* Đổ bóng */
            ">Xóa</button>
                                        </form>
                                        </div>
                                    </div>
                                </li>
                                <?php endwhile; ?>
                            </ul>
            </div>
        </main>
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