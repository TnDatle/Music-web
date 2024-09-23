<meta http-equiv="X-UA-Compatible" content="IE=edge" >
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Music Player Project</title>
    <link rel="stylesheet" href="/projects/music2/music_player/font-awesome/css/all.min.css">
    <link rel="stylesheet" href="/projects/music2/music_player/css/bootstrap.min.css">
    <link rel="shortcut icon" href="../H_IMGAES/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="./css/styles.css">
    <script src="/projects/music2/music_player/font-awesome/js/all.min.js"></script>
    <script src="/projects/music2/music_player/js/jquery-3.6.0.min.js"></script>
    <script src="/projects/music2/music_player/js/popper.min.js"></script>
    <script src="/projects/music2/music_player/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="/projects/music2/music_player/js/search.js"></script>
    <script src="/projects/music2/music_player/js/script.js"></script>
<?php require_once('db_connect.php'); ?>
<style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap");

    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Poppins", sans-serif;
    }
    #dImage {
        width: 100%;
        max-height: 15vh;
        object-fit: scale-down;
        object-position: center center;
        ;
    }

    img.mini-display-img {
        width: 3.5rem;
        height: 3.5rem;
        object-fit: cover;
        object-position: center center;
        padding: 0.1em;
    }

    img#display-img {
        width: 80%;
        height: 25vh;
        object-fit: scale-down;
        object-position: center center;
    }
    .mlist__ {
            
            display: flex;
            flex-direction: column;
        }
        .mlist__ .add_new_music
        {
            background-color: blue;
            color: #fff;
            padding: 10px 14px;
            border: none;
            transition: 0.3s;
        }
        .added 
        {
            display: flex;
            place-items: center;
            justify-content: space-between;
            margin-left:10px;
        }
        .logo {
            margin-right: 10px; /* Điều chỉnh margin giữa logo và ô tìm kiếm */
            margin: 0% auto;
            padding-right: 20px;
        }
        .search {
            flex-grow: 1; /* Cho phép ô tìm kiếm mở rộng và chiếm hết không gian còn lại */
        }

        .search input{
            width:300px;
            height:40px;
            border-radius: 30px;
            padding-left:10px;
        }
        .search input i{
            border-radius: 5px;
            background-color:black;
            border: 10px 
        }
        .m_begi ul
        {
            display: flex;
            /* flex-direction: row; */
            flex-wrap: wrap;
            margin-top: 10px;
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
        }
        #play__ 
        {
            transform: scale(2,2);
            background-color: rgba(0,0,0,.2);
        }
        #play__:hover 
        {
            background-color: blue;
        }
        #edit__
        {
            transform: translateY(50px);
            opacity: .5;
        }
        #edit__:hover 
        {
            color: red;
            opacity: 1;
        }
        .down_play
        {
            background-color: #fff;
            position: absolute;
            height: 80px;
            bottom: 0;
            width: 100%;
            display: flex;
            flex-direction: row;
            padding: 10px;
            place-items: center;
            justify-content: center;
            justify-content: space-between;
        }
        .down_play .dimg,
        .down_play .ctrls-1,
        .down_play .rnager_
        {
            height: 60px;
            justify-content: space-between;
            width: 100%;
        }
        .down_play .dimg
        {
            display: flex;
            place-items: center;
            justify-content: flex-start;
            overflow: hidden;
        }
        .down_play .dimg .disk 
        {
            height: fit-content;
            display: flex;
            flex-direction: column;
            line-height: 10px;
            margin-left: 10px;
        }
        .down_play .dimg .disk p 
        {
            font-weight: 500;
            font-size: 19px;
        }
        .down_play .dimg .disk span 
        {
            opacity: .6;
            font-size: 14px;
        }
        .down_play .dimg #display-img
        {
            padding: 0;
            position: unset;
            max-height: 70px;
            max-width: 70px;
            height: fit-content;
            border-radius: 5px;
        }
        .down_play .ctrls-1
        {
            /* background-color: red; */
            display: flex;
            flex-direction: row; 
            justify-content: center;
            place-items: center;
            /* width: 50%; */
            position: unset;
            width: fit-content;
        }
        .down_play .ctrls-1 .mx-1 button
        {
            background-color: blue;
            border: none;
            font-size: 20px;
            width: 50px;
            color: #fff;
            border-radius: 50px;
            padding: 10px;
        }
        .down_play .ctrls-1 .mx-1 .nnt 
        {
            background-color: transparent;
            color: rgba(0,0,0,.8);
            transition: 0.3s;
        }
        .down_play .ctrls-1 .mx-1 .nnt:hover 
        {
            color: blue;
        }
        .down_play .rnager_
        {
            display: flex;
            place-items: center;
            justify-content: flex-end;
        }
        .down_play .rnager_ .currentTime
        {
            transform: translate(165px ,-25px);
        }
        .down_play .rnager_ .currentTime small 
        {
            font-size: 12px;
        }
        .ranger_123 
        {
            position: absolute;
            top: 0;
            left: 0px;
            transform: translateY(-5px);

            background-color: red;
            width: 100%;
            height: 5px;
            transition: width 100ms ease-in;
            border-radius: 0px;
            border: none;
            cursor: pointer;
        }
        .mmadm 
        {
            position: relative;
            height: 100vh;
            top: 0;
            margin-left: 260px;
        }
    </style>
<?php
// Lấy từ khóa tìm kiếm từ tham số GET
$search_term = $_GET['search_term'];  

// Truy vấn cơ sở dữ liệu để tìm kiếm các bài hát dựa trên từ khóa
$query = "SELECT * FROM `tbl_music` WHERE title LIKE '%$search_term%' OR description LIKE '%$search_term%' ORDER BY title ASC";
$result = $conn->query($query);

// Hiển thị kết quả tìm kiếm
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        ?>
                                    <li class="item" data-id="<?= $row['id'] ?>">
                                        <div class="li_check">
                                            <div class="li_check_img" style="float:left;margin:20px;">
                                                <img src="<?= is_file(explode("?",$row['image_path'])[0]) ? $row['image_path'] : "../H_IMAGES/logo1.png" ?>" alt="" class="mini-display-img">
                                            </div>
                                            <div class="mname123" style="margin:0% auto;">
                                                <span class="title__" title="<?= $row['title'] ?>"><?= $row['title'] ?></span>
                                                <span class="desc___" title="<?= $row['description'] ?>"><?= $row['description'] ?></span>
                                            </div>
                                            <div class="overlay_123">
                                            <div class="over_btn">
                                                
                                                <button class=" play" id="play__"  data-id="<?= $row['id'] ?>" data-type="pause"><i class="fa fa-play"></i></button>
                                                
                                            </div>
                                        </div>
                                            </div>
                                        </div>
                                    </li>
                                    <?php
    }
}
 else {
    echo 'Không tìm thấy kết quả phù hợp';
}
?>
  