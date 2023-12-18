<?php

    use \MVC\Controllers\HomeController;
    use \MVC\Models\UsuariosModel;
    use \MVC\Cache;
    use \MVC\Tools;
    use \MVC\Cookie;
    use MVC\Models\PostsModel;
use MVC\Views\MainView;

    $homeController = new HomeController;
    $homeController->logoff();
    $meToken = Tools::getToken($_SESSION['id']);


    if (isset($_COOKIE['time']) && ($_COOKIE['time'] - time()) < 300) {
        // Falta menos de 5 minutos para expirar o cookie
        Cookie::deleteCookie($_COOKIE['userToken']);
        header('Location: ' . INCLUDE_PATH . '?logoff');
        die();
    }
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
    <link rel="shortcut icon" href="<?php echo PATH_INTERATIONS; ?>assets/midia-social.png" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo PATH_INTERATIONS ?>styles/css/style.home.min.css">
    <link rel="stylesheet" href="<?php echo PATH_INTERATIONS ?>styles/css/style.tools.css">
    <title>Seja bem-vindo, <?php echo explode(" ", $_SESSION['nome'])[0] ?> | Home</title>
</head>

<body>
    <?php
    MainView::render('aside');
    ?>

    <div class="btn_chat" id="btn_chat"><i class="bx bx-message-rounded txt_white"></i></div>
    <main id="main">
        <?php
        MainView::render('header');
        ?>

        <section class="feed_main">
            <div class="feed">
                <div class="whats_new box_feed" id="whats_new-box">
                    <figure class="align_box">
                        <?php if($_SESSION['img'] === ''){?>
                                <i class="bx bx-user avatar"></i>
                        <?php }else{ ?>
                            <img src="<?php echo PATH_INTERATIONS.'img_profile/'.$_SESSION['img'] ?>" alt="" srcset="">
                        <?php } ?>
                    </figure>

                    <form method="post" class="align_box" enctype="multipart/form-data">
                        <div class="btn">
                            <label for="img" title="Selecione uma Imagem"><i class="bx bx-image"></i></label>
                            <input type="file" name="img" id="img" style="display: none;" onchange="displayFile()" accept="image/*, video/*">

                            <label for="arquive" title="Selecione um Arquivo"><i class='bx bx-paperclip bx-rotate-270'></i></label>
                            <input type="file" name="arquive" id="arquive" style="display: none;" accept="application/pdf, text/html">

                            <label for="music"><i class="bx bx-music"></i></a></label>
                            <input type="file" name="music" id="music" style="display: none;" accept="audio/*">
                        </div>

                        <textarea class="post_content align_box" name="post_content" id="post_content" placeholder="What's new?"></textarea>
                        <button type="submit" class="btn_post align_box" name="postar">Enviar <i class="bx bx-send align_box"></i></button>
                    </form>

                    <span id="close-img" class="close-img"><i  class="bx bx-x"></i></span>
                    <div style="clear: both;"></div>
                    <div id="container"></div>
                </div><!--whats new-->

                <div class="posts">
                    <?php
                       $usuariosPost = PostsModel::showPosts();

                       function orderByPost($a, $b){
                        // Função para ordenar os posts de acordo com a data mais recente
                            return strtotime($b['data_postagem']) - strtotime($a['data_postagem']);
                       }

                       usort($usuariosPost, 'orderByPost');

                       foreach ($usuariosPost as $key => $value) {
                            $data = DateTime::createFromFormat('Y-m-d H:i:s', $value['data_postagem']);
                    ?>
                    <div class="box_feed">
                        <header class="header_info--profile">
                            <div class="user_profile_feed">
                                    <?php if(!isset($value['img_profile']) || $value['img_profile'] === ''){ ?>
                                            <figure class="align_box withoutImg"><i class="bx bx-user"></i></figure>
                                    <?php }else{ ?>                                    
                                        <figure class="align_box"><img src="<?php echo PATH_INTERATIONS.'img_profile/'.$value['img_profile']; ?>" class="align_box img_profile"></img></figure>
                                    <?php } ?>

                                <div class="info align_box">
                                        <?php if(!isset($value['Nome'])){ ?>                                           
                                    <p class="name align_box"><?php echo $_SESSION['nome']; ?> (eu) </p>

                                        <?php }else{ ?>
                                            <p class="name align_box"><?php echo $value['Nome']; ?> </p>
                                        <?php } ?>

                                    <span class="data_postagem"><?php echo $data->format('d/m/Y H'); ?>h</span>
                                </div>

                            </div>
                            <a href="#" class="align_box"><i class="bx bx-dots-horizontal-rounded"></i></a>
                        </header>

                        <p class="description_post"><?php echo $value['post_content']; ?></p>

                        <?php
                        if ($value['img'] == 's/ img') { ?>
                            <section class="reactions">
                                <div class="users_likes ">
                                    <div class="user_box_like align_box"><img src="https://th.bing.com/th/id/OIP.Q_vZZcSYOaPMcxnXMQQ99QHaE8?rs=1&pid=ImgDetMain" alt="" srcset=""></div>
                                    <div class="user_box_like align_box"><img src="https://th.bing.com/th/id/OIP.szms5stSYE-6SAsI67jNygHaJE?w=1255&h=1536&rs=1&pid=ImgDetMain" alt="" srcset=""></div>
                                    <div class="user_box_like align_box"><img src="https://www.b2b-infos.com/wp-content/uploads/photo-de-profil-pro-682x1024.jpg" alt="" srcset=""></div>
                                    <div class="user_box_like align_box"><img src="https://th.bing.com/th/id/OIP.Q_vZZcSYOaPMcxnXMQQ99QHaE8?rs=1&pid=ImgDetMain" alt="" srcset=""></div>
                                    <a href="#" class="like_count align_box">+ 120 Curtiram</a>
                                </div>

                                <div class="box_reactions">
                                    <a href="#" class="like align_box"><i class="bx bx-heart align_box"></i> Curtir</a>
                                    <a href="#" class="comment align_box"><i class="bx bx-message-rounded align_box"></i> Comentar</a>
                                    <a href="#" class="share align_box"><i class="bx bx-share align_box"></i> Compartilhar</a>
                                </div>
                            </section>
                        <?php } else { ?>
                            <div class="img_post"><div class="box_img_post single"><img src="<?php echo PATH_INTERATIONS. 'posts_img/'. $value['img']; ?>" alt="post do usuário(a) <?php echo $value['Nome']; ?>" srcset=""></div></div>

                            <section class="reactions">
                                <div class="users_likes ">
                                    <div class="user_box_like align_box"><img src="https://th.bing.com/th/id/OIP.Q_vZZcSYOaPMcxnXMQQ99QHaE8?rs=1&pid=ImgDetMain" alt="" srcset=""></div>
                                    <div class="user_box_like align_box"><img src="https://th.bing.com/th/id/OIP.szms5stSYE-6SAsI67jNygHaJE?w=1255&h=1536&rs=1&pid=ImgDetMain" alt="" srcset=""></div>
                                    <div class="user_box_like align_box"><img src="https://www.b2b-infos.com/wp-content/uploads/photo-de-profil-pro-682x1024.jpg" alt="" srcset=""></div>
                                    <div class="user_box_like align_box"><img src="https://th.bing.com/th/id/OIP.Q_vZZcSYOaPMcxnXMQQ99QHaE8?rs=1&pid=ImgDetMain" alt="" srcset=""></div>
                                    <a href="#" class="like_count align_box">+ 120 Curtiram</a>
                                </div>

                                <div class="box_reactions">
                                    <a href="#" class="like align_box"><i class="bx bx-heart align_box"></i> Curtir</a>
                                    <a href="#" class="comment align_box"><i class="bx bx-message-rounded align_box"></i> Comentar</a>
                                    <a href="#" class="share align_box"><i class="bx bx-share align_box"></i> Compartilhar</a>
                                </div>
                            </section>

                            <section class="comments">
                                <div class="whats_new">
                                    <figure class="align_box">
                                        <img src="<?php echo PATH_INTERATIONS.'img_profile/'.$_SESSION['img']; ?>" class="img"></img>
                                    </figure>

                                    <form method="post" class="align_box" enctype="multipart/form-data">
                                        <div class="btn">
                                            <label for="img" title="Selecione uma Imagem"><i class="bx bx-image"></i></label>
                                            <input type="file" name="img" id="img" style="display: none;" onchange="displayFile()">

                                            <label for="arquive" title="Selecione um Arquivo"><i class='bx bx-paperclip bx-rotate-270'></i></label>
                                            <input type="file" name="arquive" id="arquive" style="display: none;">

                                            <label for="music"><i class="bx bx-music"></i></a></label>
                                            <input type="file" name="music" id="music" style="display: none;">
                                        </div>

                                        <textarea class="post_content align_box" name="post_content" id="post_content" placeholder="What's new?"></textarea>
                                        <button type="submit" class="btn_post align_box" name="postar">Enviar <i class="bx bx-send align_box"></i></button>
                                    </form>
                                </div><!--whats new-->

                                <div class="comment_highlight">
                                    <header class="header_info--profile">
                                        <div class="user_profile_feed">
                                            <figure class="align_box"><img src="https://th.bing.com/th/id/OIP.Q_vZZcSYOaPMcxnXMQQ99QHaE8?rs=1&pid=ImgDetMain" class="img_profile"></img></figure>
                                            <div class="info align_box">
                                                <p class="name">Ciclano da Silva Ferreira</p>
                                                <span class="data_postagem">Quarta, 15 Nov, 09h</span>
                                            </div>
                                        </div>
                                        <a href="#" class="align_box like_comment"><i class="bx bxs-heart"></i> 10</a>
                                    </header>
                                    <p class="coment_user">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                        Fugiat commodi aliquam inventore nemo.</p>
                                    <a href="#" class="view-more">- Veja os outros 5 comentários</a>
                                    <a href="#" class="see-all_coments">Ver todos os comentários do post</a>
                                </div>
                            </section>
                        <?php } ?>
                    </div><!--box_feed-->
                     <?php  }    // Fechamento do foreach ?>
                </div><!-- /.posts -->
            </div><!-- /.feed -->

            <div class="events">
                <div class="upcoming box_feed">
                    <div class="title">
                        <h3 class="txt_title">Upcoming Events</h3>
                        <a href="#" class="align_box"><i class="bx bx-plus-circle"></i></a>
                    </div>

                    <ul class="events_notifications">
                        <li><i class="bx bx-rocket align_box"></i>
                            <p>Apple Keynote</p> <span class="date">Monday, Aug, 3. 10:00 AM</span>
                        </li>
                        <li><i class="bx bx-music align_box"></i>
                            <p>Apple Keynote</p> <span class="date">Monday, Aug, 3. 10:00 AM</span>
                        </li>
                        <li><i class="bx bx-film align_box"></i>
                            <p>Apple Keynote</p> <span class="date">Monday, Aug, 3. 10:00 AM</span>
                        </li>
                        <li><i class="bx bx-tv align_box"></i>
                            <p>Apple Keynote</p> <span class="date">Monday, Aug, 3. 10:00 AM</span>
                        </li>
                        <li><i class="bx bx-math align_box"></i>
                            <p>Apple Keynote</p> <span class="date">Monday, Aug, 3. 10:00 AM</span>
                        </li>
                    </ul>
                </div><!-- /.upcoming -->

                <div class="publi box_feed">
                    <div class="title">
                        <h3 class="txt_title">Upcoming Events</h3>
                        <a href="#" class="align_box"><i class="bx bx-plus-circle"></i></a>
                    </div>

                    <figure class="align_box">
                        <img src="https://th.bing.com/th/id/OIP.wI6CMqtv6sL-EoCIJ4d8QgHaDR?rs=1&pid=ImgDetMain" class="img_publi"></img>
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
                        <img src="https://th.bing.com/th/id/OIP.ulMM7bYLNuX4xmMRAa09UAHaFW?rs=1&pid=ImgDetMain" class="img_publi"></img>
                    </figure>
                    <h3>Special offer: 20% off today</h3>
                    <a href="#">http:linkdosite.com.br</a>
                    <span>Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                        Quisquam placeat autem enim atque tempora eaque fuga voluptatum ipsum, hic..</span>
                </div><!-- /.publi -->
            </div><!-- /.events -->

            <div class="interations box_feed" id="interationsSection">
                <div class="box groups">
                    <div class="title_interations">
                        <h3 class="txt_title">Groups</h3>
                        <a href="#" class="align_box"><i class='bx bx-dots-horizontal-rounded'></i></a>
                    </div>

                    <div class="user">
                        <figure class="align_box">
                            <img src="https://th.bing.com/th/id/OIP.Q_vZZcSYOaPMcxnXMQQ99QHaE8?rs=1&pid=ImgDetMain" class="img_profile"></img>
                        </figure>
                        <div class="box_user_actions align_box">
                            <p class="name">Nome 1</p>
                            <span>817k followers</span>
                        </div>
                        <!-- /.box_user_actions align_box -->
                    </div><!--users-->

                    <div class="user">
                        <figure class="align_box">
                            <img src="https://www.b2b-infos.com/wp-content/uploads/photo-de-profil-pro-682x1024.jpg" class="img_profile"></img>
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

                    <?php
                    if (count(UsuariosModel::requestWaiting($meToken)) == 0) {
                        echo '<span style="font-size: 0.8rem; margin-top: 5px; display: inline-block;">Sem solicitações no momento. ;)</span>';
                    }else{

                    foreach (UsuariosModel::requestWaiting($meToken) as $key => $value) {
                        $tokenUser = Tools::getToken($value['Id']);
                        $usersRequesting = UsuariosModel::listRequest($tokenUser)['Nome'];

                    ?>

                        <div class="user">
                                <?php if(!isset($value['img_profile']) || $value['img_profile'] === ''){ ?>
                                            <figure class="align_box withoutImg"><i class="bx bx-user"></i></figure>
                                    <?php }else{ ?>                                    
                                        <figure class="align_box"><img src="<?php echo PATH_INTERATIONS.'img_profile/'.$value['img_profile']; ?>" class="align_box img_profile"></img></figure>
                                    <?php } ?>
                            <div class="box_user_actions align_box">
                                <p class="name" style="max-width: 200px;"><a href="#"><?php echo $usersRequesting; ?></a></p>
                                <a href="?aceitar=<?php echo Tools::getToken($value['Id']) ?>" class="btn aceite">Aceitar <i class="bx bx-check"></i></a>
                                <a href="?recusar=<?php echo Tools::getToken($value['Id']) ?>" class="btn recuse">Recusar <i class="bx bx-x"></i></a>
                                <a href="#" class="response">Responder</a> <!--Botão aparece somente em telas de smartphones. -->
                            </div><!-- /.box_user_actions align_box -->
                        </div><!--users-->

                    <?php }} ?>
                </div><!--solicitações-->

                <div class="box contact">
                    <div class="title_interations">
                        <h3 class="txt_title">Contacts</h3>
                        <a href="#" class="align_box"><i class='bx bx-dots-horizontal-rounded'></i></a>
                    </div>

                    <?php
                    foreach (UsuariosModel::listFriends() as $value) {
                        if ($value['send'] == $meToken) {
                            $friend = UsuariosModel::listRequest($value['receive']); ?>
                            <div class="user">
                                    <?php if(!isset($value['img_profile']) || $value['img_profile'] === ''){ ?>
                                            <figure class="align_box withoutImg"><i class="bx bx-user"></i></figure>
                                    <?php }else{ ?>                                    
                                        <figure class="align_box"><img src="<?php echo PATH_INTERATIONS.'img_profile/'.$value['img_profile']; ?>" class="align_box img_profile"></img></figure>
                                    <?php } ?>
                                <p class="name align_box"><a href="#"><?php echo $friend['Nome']; ?></a></p>
                            </div><!--users-->

                        <?php } else if ($value['receive'] == $meToken) {
                            $friend = UsuariosModel::listRequest($value['send']); ?>
                            <div class="user">
                            <?php if(!isset($value['img_profile']) || $value['img_profile'] === ''){ ?>
                                            <figure class="align_box withoutImg"><i class="bx bx-user"></i></figure>
                                    <?php }else{ ?>                                    
                                        <figure class="align_box"><img src="<?php echo PATH_INTERATIONS.'img_profile/'.$value['img_profile']; ?>" class="align_box img_profile"></img></figure>
                                    <?php } ?>
                                <p class="name align_box"><a href="#"><?php echo $friend['Nome']; ?></a></p>
                            </div><!--users-->
                    <?php }
                    } // Fechando o foreach() 
                    ?>
                </div><!--solicitações-->
            </div><!-- /.interations -->
        </section>
    </main>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <script src="<?php echo PATH_INTERATIONS ?>js/func.feed.js"></script>
</body>

</html>

<?php
    if (isset($_GET['aceitar'])) // Aceitar amizade
        UsuariosModel::AceitarSolicitacao();
    else if (isset($_GET['recusar'])) // Recusar amizade
        UsuariosModel::RecusarSolicitacao();

    if (isset($_POST['postar'])){
        if($_FILES['img'] != ''){
            PostsModel::validatePost($_POST, $_FILES['img']);
        }else if($_FILES['video'] != ''){
            PostsModel::validatePost($_POST, $_FILES['video']);
        }
    } // Fazer alguma postagem
    
?>