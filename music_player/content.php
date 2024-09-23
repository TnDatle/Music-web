<script src="/projects/music2/music_player/js/script.js"></script>                           
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
                                    </div>
                                </li>
                                <?php endwhile; ?>
                            </ul>

                            