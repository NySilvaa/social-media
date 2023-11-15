<?php
    if(!isset($_SESSION['login'])){
        header('Location:'.INCLUDE_PATH);
        die();
    }

        use \MVC\Controllers\HomeController;
        use \MVC\Models\UsuariosModel;
        use \MVC\Cache;
    
        $homeController = new HomeController;
        $homeController->logoff();

        $users = UsuariosModel::listRequest($_SESSION['id']);
        $date = DateTime::createFromFormat('Y-m-d',$users[5]);
        
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
    <link rel="stylesheet" href="<?php echo PATH_INTERATIONS?>styles/css/style.profile.css">
    <title>Editar Perfil | <?php echo explode(" ", $_SESSION['nome'])[0]?></title>
</head>
<body>
    <?php
        Cache::validateCache('aside')
    ?>

    <main id="main">
        <?php Cache::validateCache('header')?>

        <section class="profile_main">
            <div class="profile_info ">
                <figure class="align_box">
                    <div class="img_profile"></div>
                </figure>
                <div class="box_user_info align_box">
                    <h3><?php echo $_SESSION['nome']?></h3>
                    <p class="profissao ">Programador e Analista de Sistemas</p>
                    <p class="email ">nycolassilva2003@gmail.com</p>
                    <span>Área de atuação: Engenharia de Software</span>
                </div><!-- /.box_user_info -->

                <div class="images">
                    <div class="images_wp">
                    <div class="img_box">
                        <figure><img src="" alt=""></figure>
                    </div><!-- /.img_box -->
                    
                    <div class="img_box">
                        <figure><img src="" alt=""></figure>
                    </div><!-- /.img_box -->

                    <div class="img_box">
                        <figure><img src="" alt=""></figure>
                    </div><!-- /.img_box -->

                    <div class="img_box">
                        <figure><img src="" alt=""></figure>
                    </div><!-- /.img_box -->

                    <div class="img_box">
                        <figure><img src="" alt=""></figure>
                    </div><!-- /.img_box -->

                    <div class="img_box">
                        <figure><img src="" alt=""></figure>
                    </div><!-- /.img_box -->
                    </div>
                    <!-- /.images_wp -->
                </div><!-- /.images --> 
            </div><!-- /.profile_info -->
        </section>

        <section class="highligth align_box">
            <h2>Últimas publicações: </h2>
            <div class="destaque_user box">
                <figure class="align_box">
                    <div class="img_box_destaque"></div>
                </figure>
                <div class="destaque_info align_box">
                    <p class="txt_black"><?php echo $_SESSION['nome']?></p>
                    <span class="">Possui uma conta desde <?php echo $date->format('d/m/Y'); ?></span>
                </div>
                <p class="user_description">Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                    Soluta, dolorum fuga sunt quidem quibusdam repellat aperiam excepturi similique quo aut 
                    esse quia evenie.</p>
            </div><!-- /.destaque_user -->
            
            <div class="img_destaques box_feed">
                <figure>
                    <div class="box_img_destaque"></div>
                </figure>
                <figure>
                    <div class="box_img_destaque"></div>
                </figure>
            </div><!-- /.img_destaques -->
        </section>

        <section class="friends box_feed">
            <h3>Amigos: </h3>
            <div class="user">
                <figure class="align_box">
                    <div class="img_profile"></div>
                </figure>
                <div class="box_user_actions align_box">
                    <p class="name">Nome 1</p>
                    <span>817k followers</span>
                </div><!-- /.box_user_actions align_box -->
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

            <a href="#" class="seeMore">Ver mais <i class="bx bx-down-arrow"></i></a>
        </section>
    </main>

    <script src="<?php echo PATH_INTERATIONS; ?>js/func.feed.js"></script>
</body>
</html>