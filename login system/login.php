<?php
session_start(); // Bắt đầu session

$link = new mysqli("localhost", "root", "", "db_musicweb");
$error_message = "";
$success_message = "";

// Kiểm tra xem người dùng đã đăng nhập hay chưa
if(isset($_SESSION['username'])) {
    // Người dùng đã đăng nhập
    $show_form = false;
    $welcome_message = "Chào " . $_SESSION['Name'];
} else {
    // Người dùng chưa đăng nhập
    $show_form = true;
    $welcome_message = "";
    $logout_button = "";
}

if (isset($_POST['input'])) {
    $username = $_POST['Username'];
    $password = $_POST['Password'];
    // Escape các tham số truy vấn để tránh SQL injection
    $username = $link->real_escape_string($username);
    $password = $link->real_escape_string($password);
    // Sử dụng prepared statement để tránh SQL injection
    $query = "SELECT * FROM tbl_user WHERE Username = ? AND Password = ?";
    $stmt = $link->prepare($query);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Lấy thông tin người dùng từ kết quả truy vấn
        $user_info = $result->fetch_assoc();
        // Thiết lập session cho tên người dùng
        $_SESSION['Name'] = $user_info['Name'];
        // Thiết lập session cho tên đăng nhập
        $_SESSION['Username'] = $username;
        // Đăng nhập thành công
        $success_message = "Đăng nhập thành công!";
        $show_form = false;
        // Sleep for 1 second
        sleep(1);
        // Redirect to index page
        header("Location: ../music_player/index.php");
        exit(); // Dừng việc thực thi tiếp
    } else {
        // Sai tên đăng nhập hoặc mật khẩu
        $error_message = "Tên đăng nhập hoặc mật khẩu không đúng!";
        $show_form = true;
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login to G8 Studio</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;300&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-image: url("https://c4.wallpaperflare.com/wallpaper/738/744/882/music-vinyl-simple-background-minimalism-wallpaper-preview.jpg");
            background-size: cover;
            background-position: center;
        }

        .container {
            width: 420px;
            color: #fff;
            background: transparent;
            border: 2px solid (255, 255, 255, rgba(255, 255, 255, .2));
            backdrop-filter: blur(20px);
            box-shadow: 0 0 10px rgba(0, 0, 0, .2);
            border-radius: 40px;
            padding: 30px 40px;
        }

        .container h1 {
            font-style: oblique;
            font-size: 40px;
            text-align: center;
        }

        .container h2 {
            font-size: 25px;
            text-align: center;
        }

        .container .input {
            position: relative;
            width: 100%;
            height: 50px;
            margin: 30px 0;
        }

        .input input {
            width: 100%;
            height: 100%;
            background: transparent;
            border: none;
            outline: none;
            border: 2px solid rgba(255, 255, 255, .2);
            border-radius: 40px;
            font-size: 16px;
            color: #fff;
            padding: 20px 45px 20px 20px;
        }

        .input input::placeholder {
            color: #fff;
        }

        .input i {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 20px;
        }

        .container .remember-forgot {
            display: flex;
            justify-content: space-between;
            font-size: 14.5px;
            margin: -15px 0 15px;
        }

        .remember-forgot label input {
            accent-color: #fff;
            margin-right: 3px;
        }

        .remember-forgot a {
            color: #fff;
            text-decoration: none;
        }

        .remember-forgot a:hover {
            text-decoration: underline;
        }

        .container .Login button  {
            width: 100%;
            height: 40px;
            background: #fff;
            border: none;
            outline: none;
            border-radius: 40px;
            box-shadow: 0 0 10px rgba(0, 0, 0, .1);
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            color: #333;
        }

        .container .Login span {
            font-size: 15px;
            float: right;
            color: #fff;
            padding-top: 10px;
            text-decoration: none;
        }

        .container .Login span a {
            font-size: 15px;
            float: right;
            color: #fff;
            padding-left: 10px;
        }
        .container .admin{
            padding-top: 20px;
        }

        .container .admin button{
            box-sizing: border-box;
            box-shadow: #fff;
            border-radius: 10px;
            float: right;
            
        }
        .container .admin button span a{
            text-decoration: none;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            text-align: center;
            color: black;
        }
    </style>
</head>
<body>
<div class="container">
    <form method="POST" action="">
        <h1>
            <strong>G8 Music Studio</strong>
        </h1>
        <h2>Đăng nhập</h2>
        <?php if ($success_message): ?>
            <div style="color: green; text-align: center;"><?php echo $success_message; ?></div>
        <?php elseif ($error_message): ?>
            <div style="color: red; text-align: center;"><?php echo $error_message; ?></div>
        <?php endif; ?>
        <div class="input">
            <input type="text" name="Username" placeholder="Tên đăng nhập" required>
            <i class='bx bxs-user'></i>
        </div>
        <div class="input">
            <input type="password" name="Password" placeholder="Mật khẩu" required>
            <i class='bx bxs-lock-alt'></i>
        </div>
        <div class="remember-forgot">
            <label>
                <input type="checkbox">Lưu thông tin
            </label>
            <a href="#">Quên mật khẩu?</a>
        </div>
        <div class="Login">
            <button type="submit" name="input">
                <h3>Đăng nhập</h3>
            </button>
           <span>Bạn chưa có tài khoản? <a href="register.php"> Đăng ký G8</a></span>
        </div>
        <div class="admin">
            <button type="submit">
                <span><a href="../Admin/login/login.php">Đăng nhập quản trị viên</a></span>
            </button>
        </div>
    </form>
</div>
</body>
</html>
