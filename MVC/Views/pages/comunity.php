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
    <link rel="stylesheet" href="<?php echo PATH_INTERATIONS?>styles/css/style.comunity.css">
    <title>Comunidade</title>
</head>
<body>
    <?php Cache::validateCache('aside')?>
    
    <main id="main">
        <?php
            Cache::validateCache('header')
        ?>

        <section class="friendRequest ">
           <div class="friends_wp box_feed">
                <h2>Solicitações de Amizade <i class="bx bx-group"></i></h2>

                <div class="friends_request">
                    <div class="friends_box">
                        <a href="#">
                            <figure><div class="img_friend"></div></figure>
                            <div class="box_info">
                                <h3>Fulano da Silva</h3>
                                <p>Possui amizade com: <span class="amigos_comum"></span><span class="amigos_comum"></span></p>
                                <div class="actions">
                                    <a href="#" class="aceite">Aceitar Solicitação <i class="bx bx-check"></i></a>
                                    <a href="#" class="recuse">Recusar Solicitação <i class="bx bx-x"></i></a>
                                    <a href="#" class="perfil">Ver Perfil</a>
                                </div>
                            </div><!-- /.box_info -->
                        </a>
                    </div><!-- /.friends_box -->
                    
                    <div class="friends_box">
                        <a href="#">
                            <figure><div class="img_friend"></div></figure>
                            <div class="box_info">
                                <h3>Fulano da Silva</h3>
                                <p>Possui amizade com: <span class="amigos_comum"></span><span class="amigos_comum"></span></p>
                                <div class="actions">
                                    <a href="#" class="aceite">Aceitar Solicitação <i class="bx bx-check"></i></a>
                                    <a href="#" class="recuse">Recusar Solicitação <i class="bx bx-x"></i></a>
                                    <a href="#" class="perfil">Ver Perfil</a>
                                </div>
                            </div><!-- /.box_info -->
                        </a>
                    </div><!-- /.friends_box -->

                    <div class="friends_box">
                        <a href="#">
                            <figure><div class="img_friend"></div></figure>
                            <div class="box_info">
                                <h3>Fulano da Silva</h3>
                                <p>Possui amizade com: <span class="amigos_comum"></span><span class="amigos_comum"></span></p>
                                <div class="actions">
                                    <a href="#" class="aceite">Aceitar Solicitação <i class="bx bx-check"></i></a>
                                    <a href="#" class="recuse">Recusar Solicitação <i class="bx bx-x"></i></a>
                                    <a href="#" class="perfil">Ver Perfil</a>
                                </div>
                            </div><!-- /.box_info -->
                        </a>
                    </div><!-- /.friends_box -->
                    
                    <div class="friends_box">
                        <a href="#">
                            <figure><div class="img_friend"></div></figure>
                            <div class="box_info">
                                <h3>Fulano da Silva</h3>
                                <p>Possui amizade com: <span class="amigos_comum"></span><span class="amigos_comum"></span></p>
                                <div class="actions">
                                    <a href="#" class="aceite">Aceitar Solicitação <i class="bx bx-check"></i></a>
                                    <a href="#" class="recuse">Recusar Solicitação <i class="bx bx-x"></i></a>
                                    <a href="#" class="perfil">Ver Perfil</a>
                                </div>
                            </div><!-- /.box_info -->
                        </a>
                    </div><!-- /.friends_box -->
                </div><!-- /.friends_request -->
           </div><!-- /.friends_wp -->
        </section>

        <section class="MayKnow box_feed">
            <div class="friends_wp box_feed">
                <h2>Pessoas que talvez você conheça <i class="bx bx-group"></i></h2>

                <div class="friends_request">
                    <div class="friends_box">
                        <a href="#">
                            <figure><div class="img_friend"></div></figure>
                            <div class="box_info">
                                <h3>Fulano da Silva</h3>
                                <p>Possui amizade com: <span class="amigos_comum"></span><span class="amigos_comum"></span></p>
                                <div class="actions">
                                    <a href="#" class="send">Enviar Solicitação <i class="bx bx-send"></i></a>
                                    <a href="#" class="perfil">Ver Perfil</a>
                                </div>
                            </div><!-- /.box_info -->
                        </a>
                    </div><!-- /.friends_box -->
                    
                    <div class="friends_box">
                        <a href="#">
                            <figure><div class="img_friend"></div></figure>
                            <div class="box_info">
                                <h3>Fulano da Silva</h3>
                                <p>Possui amizade com: <span class="amigos_comum"></span><span class="amigos_comum"></span></p>
                                <div class="actions">
                                    <a href="#" class="send">Enviar Solicitação <i class="bx bx-send"></i></a>
                                    <a href="#" class="perfil">Ver Perfil</a>
                                </div>
                            </div><!-- /.box_info -->
                        </a>
                    </div><!-- /.friends_box -->

                    <div class="friends_box">
                        <a href="#">
                            <figure><div class="img_friend"></div></figure>
                            <div class="box_info">
                                <h3>Fulano da Silva</h3>
                                <p>Possui amizade com: <span class="amigos_comum"></span><span class="amigos_comum"></span></p>
                                <div class="actions">
                                    <a href="#" class="send">Enviar Solicitação <i class="bx bx-send"></i></a>
                                    <a href="#" class="perfil">Ver Perfil</a>
                                </div>
                            </div><!-- /.box_info -->
                        </a>
                    </div><!-- /.friends_box -->
                    
                    <div class="friends_box">
                        <a href="#">
                            <figure><div class="img_friend"></div></figure>
                            <div class="box_info">
                                <h3>Fulano da Silva</h3>
                                <p>Possui amizade com: <span class="amigos_comum"></span><span class="amigos_comum"></span></p>
                                <div class="actions">
                                    <a href="#" class="send">Enviar Solicitação <i class="bx bx-send"></i></a>
                                    <a href="#" class="perfil">Ver Perfil</a>
                                </div>
                            </div><!-- /.box_info -->
                        </a>
                    </div><!-- /.friends_box -->
                </div><!-- /.friends_request -->
           </div><!-- /.friends_wp -->
        </section>
    </main>

    <script src="<?php echo PATH_INTERATIONS?>js/func.feed.js"></script>
</body>
</html>