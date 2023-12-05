<?php
if (!isset($_SESSION['login'])) {
    header('Location:' . INCLUDE_PATH);
    die();
}

use \MVC\Controllers\HomeController;
use \MVC\Models\UsuariosModel;
use \MVC\Cache;
use MVC\Tools;

$homeController = new HomeController;
$homeController->logoff();
$meToken = Tools::getToken($_SESSION['id']);

$users = UsuariosModel::listRequest($meToken);
$date = DateTime::createFromFormat('Y-m-d', $users['date_registro']);

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
    <link rel="stylesheet" href="<?php echo PATH_INTERATIONS ?>styles/css/style.home.css">
    <link rel="stylesheet" href="<?php echo PATH_INTERATIONS ?>styles/css/style.profile.css">
    <link rel="stylesheet" href="<?php echo PATH_INTERATIONS ?>styles/css/style.tools.css">
    <title>Editar Perfil | <?php echo explode(" ", $_SESSION['nome'])[0] ?></title>
</head>

<body>
    <?php
    Cache::validateCache('aside')
    ?>

    <main id="main">
        <?php Cache::validateCache('header') ?>

        <section class="profile_main">
            <div class="profile_info ">
                <figure class="align_box">
                    <div class="img_profile">
                        <img src="https://th.bing.com/th/id/OIP.EVCGXvrjsvMrhfOX3su_FgHaHa?rs=1&pid=ImgDetMain" alt="" srcset="">
                    </div>
                </figure>
                <div class="box_user_info align_box">
                    <h3><?php echo $_SESSION['nome'] ?></h3>
                    <p class="profissao ">Programador e Analista de Sistemas</p>
                    <p class="email ">nycolassilva2003@gmail.com</p>
                    <span>Área de atuação: Engenharia de Software</span>
                </div><!-- /.box_user_info -->

                <div class="images">
                    <div class="images_wp">
                        <div class="img_box">
                            <figure><img src="https://th.bing.com/th/id/R.69c1f0ff88c9d330f62f7daebb5d3bd3?rik=R%2fVtMqftb9GF1w&riu=http%3a%2f%2fgetwallpapers.com%2fwallpaper%2ffull%2f5%2fa%2fe%2f74906.jpg&ehk=B8omam5tRkCaUc2QX4uNa%2fQLsJnebyTkYACj7ho%2fCkA%3d&risl=&pid=ImgRaw&r=0" alt=""></figure>
                        </div><!-- /.img_box -->

                        <div class="img_box">
                            <figure><img src="https://th.bing.com/th/id/R.69c1f0ff88c9d330f62f7daebb5d3bd3?rik=R%2fVtMqftb9GF1w&riu=http%3a%2f%2fgetwallpapers.com%2fwallpaper%2ffull%2f5%2fa%2fe%2f74906.jpg&ehk=B8omam5tRkCaUc2QX4uNa%2fQLsJnebyTkYACj7ho%2fCkA%3d&risl=&pid=ImgRaw&r=0" alt=""></figure>
                        </div><!-- /.img_box -->

                        <div class="img_box">
                            <figure><img src="https://th.bing.com/th/id/R.69c1f0ff88c9d330f62f7daebb5d3bd3?rik=R%2fVtMqftb9GF1w&riu=http%3a%2f%2fgetwallpapers.com%2fwallpaper%2ffull%2f5%2fa%2fe%2f74906.jpg&ehk=B8omam5tRkCaUc2QX4uNa%2fQLsJnebyTkYACj7ho%2fCkA%3d&risl=&pid=ImgRaw&r=0" alt=""></figure>
                        </div><!-- /.img_box -->

                        <div class="img_box">
                            <figure><img src="https://th.bing.com/th/id/R.69c1f0ff88c9d330f62f7daebb5d3bd3?rik=R%2fVtMqftb9GF1w&riu=http%3a%2f%2fgetwallpapers.com%2fwallpaper%2ffull%2f5%2fa%2fe%2f74906.jpg&ehk=B8omam5tRkCaUc2QX4uNa%2fQLsJnebyTkYACj7ho%2fCkA%3d&risl=&pid=ImgRaw&r=0" alt=""></figure>
                        </div><!-- /.img_box -->

                        <div class="img_box">
                            <figure><img src="https://th.bing.com/th/id/R.69c1f0ff88c9d330f62f7daebb5d3bd3?rik=R%2fVtMqftb9GF1w&riu=http%3a%2f%2fgetwallpapers.com%2fwallpaper%2ffull%2f5%2fa%2fe%2f74906.jpg&ehk=B8omam5tRkCaUc2QX4uNa%2fQLsJnebyTkYACj7ho%2fCkA%3d&risl=&pid=ImgRaw&r=0" alt=""></figure>
                        </div><!-- /.img_box -->

                        <div class="img_box">
                            <figure><img src="https://th.bing.com/th/id/R.69c1f0ff88c9d330f62f7daebb5d3bd3?rik=R%2fVtMqftb9GF1w&riu=http%3a%2f%2fgetwallpapers.com%2fwallpaper%2ffull%2f5%2fa%2fe%2f74906.jpg&ehk=B8omam5tRkCaUc2QX4uNa%2fQLsJnebyTkYACj7ho%2fCkA%3d&risl=&pid=ImgRaw&r=0" alt=""></figure>
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
                    <div class="img_box_destaque">
                        <img src="https://th.bing.com/th/id/OIP.EVCGXvrjsvMrhfOX3su_FgHaHa?rs=1&pid=ImgDetMain" alt="" srcset="">
                    </div>
                </figure>
                <div class="destaque_info align_box">
                    <p class="txt_black"><?php echo $_SESSION['nome'] ?></p>
                    <span class="">Possui uma conta desde <?php echo $date->format('d/m/Y'); ?></span>
                </div>
                <p class="user_description">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Soluta, dolorum fuga sunt quidem quibusdam repellat aperiam excepturi similique quo aut
                    esse quia evenie.</p>
            </div><!-- /.destaque_user -->

            <div class="img_destaques box_feed">
                <figure>
                    <img src="https://th.bing.com/th/id/R.eb355380047fa73bde638b8b42900a41?rik=g62CrKBHfysU0A&riu=http%3a%2f%2fwww.wallpaperbetter.com%2fwallpaper%2f941%2f334%2f512%2fbritish-columbia-canada-calm-forest-lake-landscape-reflection-720P-wallpaper.jpg&ehk=fDjoKvebqExYv%2faeRK0rZjGhanydo5WUL6ILP1zr02k%3d&risl=&pid=ImgRaw&r=0" class="box_img_destaque"></img>
                </figure>
                <figure>
                    <img src="https://th.bing.com/th/id/R.69c1f0ff88c9d330f62f7daebb5d3bd3?rik=R%2fVtMqftb9GF1w&riu=http%3a%2f%2fgetwallpapers.com%2fwallpaper%2ffull%2f5%2fa%2fe%2f74906.jpg&ehk=B8omam5tRkCaUc2QX4uNa%2fQLsJnebyTkYACj7ho%2fCkA%3d&risl=&pid=ImgRaw&r=0" class="box_img_destaque"></img>
                </figure>
            </div><!-- /.img_destaques -->
        </section>

        <section class="friends box_feed">
            <h3>Amigos: </h3>
            <?php
            $friends = UsuariosModel::listFriends();

            foreach ($friends as $value) {
                if ($value['send'] == $meToken) {
                    $friend = UsuariosModel::listRequest($value['receive']); ?>
                    <div class="user">
                        <figure class="align_box">
                            <img src="https://www.b2b-infos.com/wp-content/uploads/photo-de-profil-pro-682x1024.jpg" class="img_profile"></img>
                        </figure>
                        <div class="box_user_actions align_box">
                            <p class="name"><?php echo $friend['Nome']; ?></p>
                            <span>817k followers</span>
                        </div><!-- /.box_user_actions align_box -->
                    </div><!--users-->

            <?php } else if ($value['receive'] == $meToken) {
                    $friend = UsuariosModel::listRequest($value['send']); ?>

                    <div class="user">
                        <figure class="align_box">
                            <img src="https://www.b2b-infos.com/wp-content/uploads/photo-de-profil-pro-682x1024.jpg" class="img_profile"></img>
                        </figure>
                        <div class="box_user_actions align_box">
                            <p class="name"><?php echo $friend['Nome']; ?></p>
                            <span>817k followers</span>
                        </div><!-- /.box_user_actions align_box -->
                    </div><!--users-->
                <?php }
            } // Fechando o foreach() ?>

            <a href="#" class="seeMore">Ver mais <i class="bx bx-down-arrow"></i></a>
        </section>
    </main>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="<?php echo PATH_INTERATIONS; ?>js/func.feed.js"></script>
</body>

</html>