<?php

use \MVC\Controllers\HomeController;
use \MVC\Cache;
use \MVC\Models\UsuariosModel;
use  \MVC\MySql;
use MVC\Tools;

if (!isset($_SESSION['login'])) {
    header('Location:' . INCLUDE_PATH);
    die();
}

$user = MySql::connect()->prepare('SELECT * FROM users');
$user->execute();
$user = $user->fetchAll(MySql::connect()::FETCH_ASSOC);

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
    <link rel="stylesheet" href="<?php echo PATH_INTERATIONS ?>styles/css/style.home.css">
    <link rel="stylesheet" href="<?php echo PATH_INTERATIONS ?>styles/css/style.comunity.css">
    <link rel="stylesheet" href="<?php echo PATH_INTERATIONS ?>styles/css/style.tools.css">
    <title>Comunidade</title>
</head>

<body>
    <?php Cache::validateCache('aside') ?>

    <main id="main">
        <?php
        Cache::validateCache('header')
        ?>

        <section class="solicitacoes">
            <div class="friends_wp">
                <h2>Solicitações Pendentes <i class="bx bx-group"></i></h2>

                <div class="friends_request">
                    <div class="friends_request_wp">

                    <?php
                            if(isset($_GET['aceitar']))
                                UsuariosModel::AceitarSolicitacao();
                            else if(isset($_GET['recusar']))
                                UsuariosModel::RecusarSolicitacao();
                       
                            $requestWait = UsuariosModel::requestWaiting(Tools::getToken($_SESSION['id']));

                            if(count($requestWait) == 0)
                                echo '<p style="text-align:center; width: 100%;">Sem solicitações pendentes no momento. ;)</p>';
        
                            foreach ($requestWait as $value) {
                                $usersRequesting = UsuariosModel::listRequest($value['send']); ?>

                            <div class="card">
                                <div class="bg">
                                    <figure>
                                        <img src="https://www.b2b-infos.com/wp-content/uploads/photo-de-profil-pro-682x1024.jpg" class="img_friend"></img>
                                    </figure>
                                    <div class="box_info">
                                        <h3><?php echo $usersRequesting['Nome'] ?></h3>
                                        <p>Possui amizade com: <span class="amigos_comum"></span><span class="amigos_comum"></span></p>
                                        <div class="actions">
                                                <a href="?aceitar=<?php echo $value['send']; ?>"  class="btn_user aceite">Aceitar Solicitação<i class="bx bx-check"></i></a>
                                                <a href="?recusar=<?php echo $value['send']; ?>" class="btn_user recuse">Recusar Solicitação <i class="bx bx-x"></i></a>
                                            <a href="#" class="btn_user seeProfile"> Ver perfil<i class="bx bx-user"></i></a>
                                        </div>
                                    </div><!-- /.box_info -->
                                </div>
                                <div class="blob"></div>
                            </div><!--card-->
                       
                       <?php } // Fechamento do foreach() ?>
                    </div><!-- /.friends_request_wp -->
                </div><!-- /.friends_request -->
            </div><!-- /.friends_wp -->
        </section>

        <section class="friends">
            <div class="friends_wp">
                <h2>Seus amigos <i class="bx bx-group"></i></h2>

                <div class="friends_request">
                    <div class="friends_request_wp">
                        <?php
                            $friends = UsuariosModel::listFriends();
                            $meToken = Tools::getToken($_SESSION['id']);

                            foreach ($friends as $value) {
                                if ($value['send'] == $meToken) {
                                    $friend = UsuariosModel::listRequest($value['receive']);
                                    UsuariosModel::showFriends($friend['Nome']);
                                } else if ($value['receive'] == $meToken) {
                                    $friend = UsuariosModel::listRequest($value['send']);
                                    UsuariosModel::showFriends($friend['Nome']);
                                }
                            } // Fechando o foreach() 
                        ?>
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
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            if (isset($_POST['idUser'])) {
                                $idUser = $_POST['idUser'];
                                UsuariosModel::sendSolicitation($idUser);
                            }
                        }

                        foreach ($user as $key => $value) {

                            if ($value['Id'] == $_SESSION['id'])
                                continue;
                        ?>
                            <div class="card">
                                <div class="bg">
                                    <figure>
                                        <img src="https://www.b2b-infos.com/wp-content/uploads/photo-de-profil-pro-682x1024.jpg" class="img_friend"></img>
                                    </figure>

                                    <div class="box_info">
                                        <h3><?php echo $value['Nome'] ?></h3>
                                        <p>Possui amizade com: <span class="amigos_comum"></span><span class="amigos_comum"></span></p>
                                        <div class="actions">
                                            <form method="post" class="forms">
                                                <input type="hidden" name="idUser" value="<?php echo Tools::getToken($value['Id']); ?>">

                                                <?php
                                                if (UsuariosModel::checkStatusSolicitation(Tools::getToken($value['Id']))) {
                                                ?>
                                                    <button type="submit" class="btn_user seeProfile">Pendente <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                    </button>
                                                <?php } else { ?>
                                                    <button type="submit" class="btn_user send_user" name="enviar">Enviar Solicitação <i class="bx bx-send"></i></button>
                                                <?php } ?>

                                                <button class="btn_user seeProfile" type="submit"> Ver perfil<i class="bx bx-user"></i></button>
                                            </form>
                                        </div><!--actions-->
                                    </div><!-- /.box_info -->
                                </div><!--bg-->
                                <div class="blob"></div>
                            </div><!--card-->
                        <?php } // Fechando o foreach() 
                        ?>
                    </div><!-- /.friends_request_wp -->
                </div><!-- /.friends_request -->
            </div><!-- /.friends_wp -->
        </section>
    </main>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="<?php echo PATH_INTERATIONS; ?>js/func.feed.js"></script>
    <script src="<?php echo PATH_INTERATIONS; ?>js/request.js"></script>
</body>

</html>