<?php
        if(!isset($_SESSION['login'])){
            header('Location:'.INCLUDE_PATH);
            die();
        }

    use \MVC\Controllers\HomeController;
    use \MVC\Cache;
    use \MVC\Models\UsuariosModel;
    use  \MVC\MySql;
    use MVC\Tools;

    $user = MySql::connect()->prepare('SELECT * FROM users');
    $user->execute();
    $user = $user->fetchAll();

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

        <section class="friends_request">
            <div class="friends_wp">
                <h2>Solicitações Pendentes <i class="bx bx-group"></i></h2>

                <div class="friends_request">
                    <div class="friends_request_wp">

                    <?php
                            $requestWait = UsuariosModel::requestWaiting($_SESSION['id']);

                            foreach ($requestWait as $key => $value) {
                                $usersRequesting = UsuariosModel::listRequest($value['send']);

                        ?>
                            <div class="card">
                                <div class="bg">
                                    <figure><div class="img_friend"></div></figure>
                                    <div class="box_info">
                                        <h3><?php echo $usersRequesting[1] ?></h3>
                                        <p>Possui amizade com: <span class="amigos_comum"></span><span class="amigos_comum"></span></p>
                                        <div class="actions">
                                                <a href="?aceitar=<?php echo Tools::getToken($usersRequesting[0]); ?>"  class="btn_user aceite">Aceitar Solicitação<i class="bx bx-check"></i></a>
                                                <a href="?recusar=<?php echo Tools::getToken($usersRequesting[0]); ?>" class="btn_user recuse">Recusar Solicitação <i class="bx bx-x"></i></a>
                                            <a href="#" class="btn_user seeProfile"> Ver perfil<i class="bx bx-user"></i></a>
                                        </div>
                                    </div><!-- /.box_info -->
                                </div>
                                <div class="blob"></div>
                            </div><!--card-->

                            <?php } ?>
                    </div><!-- /.friends_request_wp -->
                </div><!-- /.friends_request -->
            </div><!-- /.friends_wp -->
        </section>

        <section class="MayKnow">
            <div class="friends_wp">
                <h2>Pessoas que talvez você conheça <i class="bx bx-group"></i></h2>
                <div class="friends_request">
                    <div class="friends_request_wp">
                        <?php 
                            foreach ($user as $key => $value) {

                                if($value['Id'] == $_SESSION['id'])
                                    continue;
                        ?>
                            <div class="card">
                                <div class="bg">
                                        <figure><div class="img_friend"></div></figure>

                                        <div class="box_info">
                                            <h3><?php echo $value['Nome']?></h3>
                                            <p>Possui amizade com: <span class="amigos_comum"></span><span class="amigos_comum"></span></p>
                                            <div class="actions">
                                                <form action="" method="post">
                                                    <?php 
                                                        if(UsuariosModel::checkStatusSolicitation($value['Id'])){
                                                    ?>
                                                        <button type="submit" class="btn_user seeProfile">Pendente <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                            </svg>
                                                        </button>
                                                    <?php }else{ ?>
                                                        <button type="submit" class="btn_user send_user" name="enviar">Enviar Solicitação <i class="bx bx-send"></i></button>
                                                    <?php } ?>

                                                    <input type="hidden" name="idUser" value="<?php echo $value['Id']; ?>">
                                                    <button class="btn_user seeProfile" type="submit"> Ver perfil<i class="bx bx-user"></i></button>
                                                </form>
                                            </div>
                                        </div><!-- /.box_info -->
                                </div>
                                <div class="blob"></div>
                            </div><!--card-->
                        <?php } ?>
                    </div><!-- /.friends_request_wp -->
                </div><!-- /.friends_request -->
           </div><!-- /.friends_wp -->
        </section>
    </main>
    <script src="<?php echo PATH_INTERATIONS; ?>js/func.feed.js"></script>
    <script src="<?php echo PATH_INTERATIONS; ?>js/request.js"></script>
</body>
</html>

<?php
    if(isset($_GET['aceitar']))
        UsuariosModel::AceitarSolicitacao();
    else if(isset($_GET['recusar']))
        UsuariosModel::RecusarSolicitacao();

    if(isset($_POST['enviar'])){
        $id = (int) $_POST['idUser'];
        UsuariosModel::sendSolicitation($id);
    }

?>