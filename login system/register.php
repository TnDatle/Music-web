<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login to G8 Studio</title>
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
    background: url('https://c4.wallpaperflare.com/wallpaper/738/744/882/music-vinyl-simple-background-minimalism-wallpaper-preview.jpg');
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

.success_message {
            border: 2px solid green; /* Border color for success frame */
            border-radius: 10px; /* Rounded corners */
            padding: 10px; /* Padding inside the frame */
            margin-top: 20px; /* Top margin */
            text-align: center; /* Center-align the text */
}

</style>

<?php
$link = new mysqli("localhost", "root", "", "db_musicweb");
$error_message = "";
$success_message = "";
$show_form = true;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["input"])) {
    // Lấy dữ liệu từ biểu mẫu
    $username = $_POST["Username"];
    $password = $_POST["Password"];
    $email = $_POST["Email"];
    $name = $_POST['Name'];

    // Kiểm tra xem người dùng đã tồn tại hay chưa
    $check_sql = "SELECT * FROM tbl_user WHERE Username = '$username'";
    $check_result = $link->query($check_sql);

    if ($check_result->num_rows > 0) {
        $error_message = "Tên đăng nhập hoặc Email đã tồn tại. Vui lòng chọn tên đăng nhập khác.";
        $show_form = true; // Hiển thị biểu mẫu lại nếu tên đăng nhập đã tồn tại
    } else {
        // Thực hiện truy vấn để thêm người dùng vào cơ sở dữ liệu
        $insert_sql = "INSERT INTO tbl_user (Username, Password, Email, Name) VALUES ('$username', '$password', '$email','$name')";

        if ($link->query($insert_sql) === TRUE) {
            $success_message = "Bạn đã đăng ký thành công!";
            $show_form = false; // Ẩn biểu mẫu nếu đăng ký thành công
        } else {
            echo "Lỗi: " . $insert_sql . "<br>" . $conn->error;
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up to G8 Studio</title>
</head>
<body>
    <div class="container">
        <?php if ($show_form): ?> <!-- Kiểm tra xem có nên hiển thị biểu mẫu không -->
        <form method="POST" action="">
            <h1>
                <strong>G8 Music Studio</strong>
            </h1>
            <h2>Đăng ký</h2>
            <?php if ($error_message): ?>
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
            <div class="input">
                <input type="email" name="Email"placeholder="aaaa@gmail.com" required>
            </div>
            <div class="input">
                <input type="text" name="Name"placeholder="Tên của bạn" required>
            </div>
            <div class="Login">
                <button type="submit" name="input">
                    <span>Đăng ký</span>
                </button>
            </div>
        </form>
        <?php else: ?>
        <!-- Hiển thị thông báo đăng ký thành công và biểu mẫu đăng nhập -->
        <div id="success_message">
            <?php echo $success_message; ?>
        </div>
        <script>
            setTimeout(function() {
                window.location.href = "login.php";
            }, 1000); 
        </script>
        <?php endif; ?>
    </div>
</body>
</html>
