<header class="box_feed">
    <nav>
        <a href="#" class="btn_menu"><i class='bx bx-menu'></i></a>

        <div class="search">
            <button class="align_box" id="btnSearch"><i class="bx bx-search"></i></button>
            <input type="text" name="search" id="search" placeholder="Type of Search...">
        </div>

        <div class="profile">
            <a href="#" class="not_profile" data_icon="bell" ><i class="bx bx-bell new align_box"></i> Notifications</a>
            <a href="#" class="not_profile" data_icon="msg" ><i class="bx bx-chat align_box"></i> Messages</a>
           
            <a href="http://localhost/social-media/edit" class="editProfile">
                <figure class="align_box">
                    <?php if($_SESSION['img'] === ''){ ?>
                        <i class="bx bx-user avatar" style="color: #fff;"></i>
                    <?php }else{ ?>
                        <img src="http://localhost/social-media/MVC/Views/img_profile/<?php echo $_SESSION['img']; ?>" class="img"></img>
                    <?php } ?>
                </figure>
            </a>
        </div>
    </nav>
</header>