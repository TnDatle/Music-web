<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Quản Trị</title>
</head>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;300&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Poppins",sans-serif;
}

body{
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background-image: url("https://c4.wallpaperflare.com/wallpaper/738/744/882/music-vinyl-simple-background-minimalism-wallpaper-preview.jpg");
    background-size: cover;
    background-position: center;
}    

.container{
    width: 420px;
    color: #fff;
    background: transparent;
    border: 2px solid(255,255,255,rgba(255,255,255,.2));
    backdrop-filter: blur(20px);
    box-shadow: 0 0 10px rgba(0,0,0,.2);
    border-radius: 40px;
    padding: 30px 40px;
}

.container h1{
    font-style: oblique;
    font-size: 40px;
    text-align: center;
}

.container h2{
    font-size: 25px;
    text-align: center;
}

.container .input{
    position: relative;
    width: 100%;
    height: 50px;
    margin: 30px 0 ;
}

.input input{
    width: 100%;
    height: 100%;
    background: transparent;
    border: none;
    outline: none;
    border: 2px solid rgba(255,255,255,.2);
    border-radius: 40px;
    font-size: 16px;
    color: #fff;
    padding: 20px 45px 20px 20px;
}

.input input::placeholder{
    color: #fff;
}


.input i{
    position: absolute;
    right: 20px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 20px;
}

.container .remember-forgot{
    display: flex;
    justify-content: space-between;
    font-size: 14.5px;
    margin: -15px 0 15px;
}

.remember-forgot label input {
    accent-color: #fff;
    margin-right: 3px;
}

.remember-forgot a{
    color: #fff;
    text-decoration: none;
}

.remember-forgot a:hover{
    text-decoration: underline;
}

.container .Login button{
    width: 100%;
    height: 40px;
    background: #fff;
    border: none;
    outline: none;
    border-radius: 40px;
    box-shadow: 0 0 10px rgba(0,0,0,.1);
    cursor: pointer;
    font-size: 16px;
    font-weight: 600;
    color:#333;
}
.container .Login a{
    font-size: 15px;
    float: right;
    color: #fff;
}
.container .min{
            padding-top: 10px;
        }

.container .min button{
            box-sizing: border-box;
            box-shadow: #fff;
            border-radius: 10px;
            float: right;
            
        }
        .container .min button span a{
            text-decoration: none;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            text-align: center;
            color: black;
            font-size:18px;
        }
</style>
<body>

<?php
session_start(); // Bắt đầu session
$link = new mysqli("localhost", "root", "", "db_musicweb");
$error_message = "";
$success_message = "";
$show_form = true;

if (isset($_POST['input'])) {
    $username = $_POST['Username'];
    $password = $_POST['Password'];
    $query = "SELECT * FROM tbl_admin WHERE Username = '$username' AND Password = '$password'";
    $result = $link->query($query);
    if ($result->num_rows > 0) {
        // Lấy thông tin admin từ cơ sở dữ liệu
        $admin_info = $result->fetch_assoc();
        // Lưu tên admin vào session
        $_SESSION['TenTV'] = $admin_info['TenTV'];
        $success_message = "Đăng nhập thành công!";
        $show_form = false;
        // Sleep for 1 second
        sleep(1);
        // Redirect to index page
        header("Location: ../index.php");
        exit(); // Stop further execution
    } else {
        $error_message = "Tên đăng nhập hoặc mật khẩu không đúng!";
        $show_form = true;
    }
}
?>


<body>
<div class="container">
    <form method="POST" action="">
        <h1>
            <strong>Quản Trị Viên</strong>
        </h1>
        <h2>Đăng nhập</h2>
        <?php if ($success_message): ?>
            <div style="color: green; text-align: center;"><?php echo $success_message; ?></div>
        <?php elseif ($error_message): ?>
            <div style="color: red; text-align: center;"><?php echo $error_message; ?></div>
        <?php endif; ?>
        <div class="input">
            <input type="text" name="Username" placeholder="Tên đăng nhập" required>
            <i class='bx bxs-user' ></i>
        </div>    
        <div class="input">    
            <input type="password" name="Password" placeholder="Mật khẩu" required>
            <i class='bx bxs-lock-alt'></i>
        </div>    
        <div class="Login">
            <button type="submit" name="input">
                <span>Đăng nhập</span>
            </button>
        </div>
        <div class="min">
            <button type="submit"style="float:right;">
                <span><a href="../../login system/login.php">quay lại</a></span>
            </button>
        </div>
    </form>
</div>
</body>
</html>
