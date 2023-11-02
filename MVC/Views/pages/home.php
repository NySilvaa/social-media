<?php
    use \MVC\Controllers\HomeController;
    use \MVC\Cache;

    $homeController = new HomeController;
    $homeController->logoff();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="Home da rede social">
    <meta name="keywords" content="feed,social media,home, content">
    <meta name="author" content="Nycolas Ramos da Silva">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="<?php echo PATH_INTERATIONS?>styles/css/style.home.css">
    <title>Seja bem-vindo, <?php echo explode(" ", $_SESSION['nome'])[0]?> | Home</title>
</head>
<body>
    <?php
           Cache::validateCache('aside');
    ?>  
    <main id="main">
    <?php
            Cache::validateCache('header');
    ?>
        <section class="feed_main">
            <div class="feed">
                <div class="whats_new box_feed">
                        <figure class="align_box">
                            <div class="img"></div>
                        </figure>

                        <input type="text" name="whats_new" id="whats_new" placeholder="What's new?">
                        <div class="btn align_box">
                            <a href="#"><i class="bx bx-image"></i></a>
                            <a href="#"><i class="bx bx-film"></i></a>
                            <a href="#"><i class="bx bx-music"></i></a>
                        </div>
                </div><!--whats new-->

                <div class="posts">
                        <div class="box_feed"></div>
                        <div class="box_feed"></div>
                        <div class="box_feed"></div>
                        <div class="box_feed"></div>
                </div>
                <!-- /.posts -->
            </div><!-- /.feed -->

            <div class="events">
                <div class="upcoming box_feed">
                    <div class="title">
                        <h3 class="txt_title">Upcoming Events</h3>
                        <a href="#" class="align_box"><i class="bx bx-plus-circle"></i></a>
                    </div>

                    <ul class="events_notifications">
                        <li><i class="bx bx-rocket align_box"></i> <p>Apple Keynote</p> <span class="date">Monday, Aug, 3. 10:00 AM</span></li>
                        <li><i class="bx bx-music align_box"></i> <p>Apple Keynote</p> <span class="date">Monday, Aug, 3. 10:00 AM</span></li>
                        <li><i class="bx bx-film align_box"></i> <p>Apple Keynote</p> <span class="date">Monday, Aug, 3. 10:00 AM</span></li>
                        <li><i class="bx bx-tv align_box"></i> <p>Apple Keynote</p> <span class="date">Monday, Aug, 3. 10:00 AM</span></li>
                        <li><i class="bx bx-math align_box"></i> <p>Apple Keynote</p> <span class="date">Monday, Aug, 3. 10:00 AM</span></li>
                    </ul>
                </div><!-- /.upcoming -->

                <div class="publi box_feed">
                    <div class="title">
                            <h3 class="txt_title">Upcoming Events</h3>
                            <a href="#" class="align_box"><i class="bx bx-plus-circle"></i></a>
                    </div>

                    <figure class="align_box">
                        <div class="img_publi"></div>
                    </figure>
                    <h3>Special offer: 20% off today</h3>
                    <a href="#">http:linkdosite.com.br</a>
                    <span>Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                         Quisquam placeat autem enim atque tempora eaque fuga voluptatum ipsum, hic..</span>
                </div><!-- /.publi -->
                
                <div class="publi box_feed">
                    <div class="title">
                            <h3 class="txt_title">Upcoming Events</h3>
                            <a href="#" class="align_box"><i class="bx bx-plus"></i></a>
                    </div>

                    <figure class="align_box">
                        <div class="img_publi"></div>
                    </figure>
                    <h3>Special offer: 20% off today</h3>
                    <a href="#">http:linkdosite.com.br</a>
                    <span>Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                         Quisquam placeat autem enim atque tempora eaque fuga voluptatum ipsum, hic..</span>
                </div><!-- /.publi -->
            </div><!-- /.events -->

            <div class="interations box_feed">
                <div class="box groups">
                    <div class="title_interations">
                        <h3 class="txt_title">Groups</h3>
                        <a href="#" class="align_box"><i class='bx bx-dots-horizontal-rounded'></i></a>
                    </div>

                    <div class="user">
                        <figure class="align_box">
                            <div class="img_profile"></div>
                        </figure>
                        <div class="box_user_actions align_box">
                            <p class="name">Nome 1</p>
                            <span>817k followers</span>
                        </div>
                        <!-- /.box_user_actions align_box -->
                    </div><!--users-->

                    <div class="user">
                        <figure class="align_box">
                            <div class="img_profile"></div>
                        </figure>
                        <div class="box_user_actions align_box">
                            <p class="name">Nome 1</p>
                            <span>817k followers</span>
                        </div>
                        <!-- /.box_user_actions align_box -->
                    </div><!--users-->
                </div><!--groups-->

                <div class="box solicitations">
                    <div class="title_interations">
                        <h3 class="txt_title">Solicitações de amizade</h3>
                        <a href="#" align_box><i class='bx bx-dots-horizontal-rounded'></i></a>
                    </div>

                    <div class="user">
                        <figure class="align_box">
                            <div class="img_profile"></div>
                        </figure>
                        <div class="box_user_actions align_box">
                            <p class="name"><a href="#">Nome 1</a></p>
                            <a href="#" class="btn aceite">Aceitar <i class="bx bx-check"></i></a>
                            <a href="#" class="btn recuse">Recusar <i class="bx bx-x"></i></a>
                            <a href="#" class="response">Responder</a>
                        </div><!-- /.box_user_actions align_box -->
                    </div><!--users-->

                    <div class="user">
                        <figure class="align_box">
                            <div class="img_profile"></div>
                        </figure>
                        <div class="box_user_actions align_box">
                            <p class="name"><a href="#">Nome 1</a></p>
                            <a href="#" class="btn aceite">Aceitar <i class="bx bx-check"></i></a>
                            <a href="#" class="btn recuse">Recusar <i class="bx bx-x"></i></a>
                            <a href="#" class="response">Responder</a>
                        </div><!-- /.box_user_actions align_box -->
                    </div><!--users-->

                    <div class="user">
                        <figure class="align_box">
                            <div class="img_profile"></div>
                        </figure>
                        <div class="box_user_actions align_box">
                            <p class="name"><a href="#">Nome 1</a></p>
                            <a href="#" class="btn aceite">Aceitar <i class="bx bx-check"></i></a>
                            <a href="#" class="btn recuse">Recusar <i class="bx bx-x"></i></a>
                            <a href="#" class="response">Responder</a>
                        </div><!-- /.box_user_actions align_box -->
                    </div><!--users-->

                    <div class="user">
                        <figure class="align_box">
                            <div class="img_profile"></div>
                        </figure>
                        <div class="box_user_actions align_box">
                            <p class="name"><a href="#">Nome 1</a></p>
                            <a href="#" class="btn aceite">Aceitar <i class="bx bx-check"></i></a>
                            <a href="#" class="btn recuse">Recusar <i class="bx bx-x"></i></a>
                            <a href="#" class="response">Responder</a>
                        </div><!-- /.box_user_actions align_box -->
                    </div><!--users-->
                </div><!--solicitações-->

                <div class="box contact">
                    <div class="title_interations">
                        <h3 class="txt_title">Contacts</h3>
                        <a href="#" class="align_box"><i class='bx bx-dots-horizontal-rounded'></i></a>
                    </div>

                    <div class="user">
                        <figure class="align_box">
                            <div class="img_profile"></div>
                        </figure>
                        <p class="name align_box"><a href="#">Nome 1</a></p>
                    </div><!--users-->

                    <div class="user">
                        <figure class="align_box">
                            <div class="img_profile"></div>
                        </figure>
                        <p class="name align_box"><a href="#">Nome 1</a></p>
                    </div><!--users-->

                    <div class="user">
                        <figure class="align_box">
                            <div class="img_profile"></div>
                        </figure>
                        <p class="name align_box"><a href="#">Nome 1</a></p>
                    </div><!--users-->

                    <div class="user">
                        <figure class="align_box">
                            <div class="img_profile"></div>
                        </figure>
                        <p class="name align_box"><a href="#">Nome 1</a></p>
                    </div><!--users-->
                </div><!--solicitações-->
            </div><!-- /.interations -->
        </section>
    </main>

    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <script src="<?php echo PATH_INTERATIONS ?>js/func.feed.js"></script>
</body>
</html>