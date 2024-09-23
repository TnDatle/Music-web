<ul class="" id="artist-list" style="padding-bottom:60px">
    <?php 
    // Truy vấn cơ sở dữ liệu để lấy danh sách các nghệ sĩ
    $music = $conn->query('SELECT * FROM `tbl_artist` ORDER BY id ');
    while($row = $music->fetch_assoc()):
    ?>
    <li class="item" data-id="<?= $row['id'] ?>">
        <a href="./song_by_artist.php?description=<?= urlencode($row['name']) ?>"> <!-- Truyền tên của nghệ sĩ qua URL -->
            <div class="li_check">
                <div class="li_check_img" style="float:left;margin:20px;">
                    <!-- Sử dụng trường image trong bảng tbl_artist để hiển thị hình ảnh -->
                    <img style="border-radius:100px" src="<?= is_file(explode("?",$row['image_path'])[0]) ? $row['image_path'] : "../H_IMAGES/logo1.png" ?>" alt="" class="mini-display-img">
                </div>
                <div class="mname123" style="margin:0% auto;">
                    <!-- Sử dụng trường name trong bảng tbl_artist để hiển thị tên nghệ sĩ -->
                    <span class="desc___" title="<?= $row['name'] ?>"><?= $row['name'] ?></span>
                </div>
            </div>
        </a>
    </li>
    <?php endwhile; ?>
</ul>
