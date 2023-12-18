<?php

    use \MVC\Controllers\HomeController;
    use \MVC\Views\MainView;
    use MVC\Controllers\EditController;
    use  \MVC\MySql;
    use MVC\Tools;

    if (!isset($_SESSION['login'])) {
        header('Location:' . INCLUDE_PATH);
        die();
    }

    $homeController = new HomeController;
    $homeController->logoff();

    $user = MySql::connect()->prepare('SELECT * FROM users WHERE Id = ?');
    $user->execute([$_SESSION['id']]);
    $user = $user->fetch(MySql::connect()::FETCH_ASSOC);
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
    <link rel="stylesheet" href="<?php echo PATH_INTERATIONS ?>styles/css/style.edit.css">
    <link rel="stylesheet" href="<?php echo PATH_INTERATIONS ?>styles/css/style.tools.css">
    <title>Editar Perfil</title>
</head>

<body>
    <?php MainView::render('aside'); ?>

    <main id="main">
        <?php MainView::render('header'); ?>

        <div class="img_profile">
            <form  method="post" class="formAvatar" enctype="multipart/form-data">
                <label for="edit_img--profile" class="pic_profile" >
                    <?php if ($user['img_profile'] === '') { ?>
                        <i class="bx bx-user"></i>
                    <?php } else {
                        echo '<img src="' . PATH_INTERATIONS . 'img_profile/' . $user['img_profile'] . '" alt="Foto de Perfil" />';
                    } ?>

                </label>
                <input type="file" name="edit_img-profile" id="edit_img--profile" style="display: none;"  onchange="displayFile()" accept="image/*">
                <button type="submit" class="updatePic" name="updatePicture">Alterar Foto <i class='bx bx-image-alt'></i></button>
            </form>
        </div>

        <div class="info_profile box_feed">
            <form class="form" method="post">
                    <p class="title">Alterar Dados </p>
                    <label>
                        <input placeholder="" required type="text" class="input" name="Nome" value="<?php echo recoverPost('Nome'); ?>">
                        <span>Novo Nome</span>
                    </label>

                    <label>
                        <input placeholder="" required type="email" class="input" name="Email" value="<?php echo recoverPost('Email'); ?>">
                        <span>Novo Email</span>
                    </label>

                    <div class="flex">
                        <label>
                            <input placeholder="" required type="password" class="input" name="Senha">
                            <span>Nova Senha</span>
                        </label>
                        <label>
                            <input placeholder="" required type="password" class="input" name="confirmSenha">
                            <span>Confirm password</span>
                        </label>
                    </div>
                    <button class="submit" name="atualizar">Submit</button>
            </form>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="<?php echo PATH_INTERATIONS; ?>js/func.edit.js"></script>
</body>

</html>

<?php
    if (isset($_POST['atualizar'])) {
        if (EditController::updateData($_POST)) // Deu certo a atualização dos dados
            Tools::alert('success', 'Dados Atualizados', 'Seus dados foram atualizados com sucesso!');
        else
            Tools::alert('error', 'Algo falhou', 'Você não inseriu os dados permitidos. Tente novamente.');
    }

    if(isset($_POST['updatePicture'])){
        // O usuário quer trocar a foto de perfil
        $picture = $_FILES['edit_img-profile'];

        if($picture === '')
            return false;
        else{
            if(EditController::validadePictureProfile($picture) === 'tamanho invalido'){
                Tools::alert('error', 'Tamanho Inválido', 'Sua imagem deve ter menos de 3mb.');
                return false;
            }else if(!EditController::validadePictureProfile($picture)){
                Tools::alert('error', 'Formato Inválido', 'O arquivo escolhido deve ser uma imagem.');
                return false;
            }else{
                $extension = explode('.', $picture['name']);
                $pictureName = uniqid().'.'.$extension[count($extension) -1];
                $sql = MySql::connect()->prepare("UPDATE users SET img_profile = ? WHERE Id = ?");
                $sql->execute([$pictureName, $_SESSION['id']]);

                if($sql->rowCount() === 1){
                    // Deu certo
                    Tools::alert('success', 'Imagem Alterada', 'Sua imagem foi atualizada com sucesso.');
                    $_SESSION['img'] = $pictureName;
                    move_uploaded_file($picture['tmp_name'], BASE_DIR.'/MVC/Views/img_profile/'.$pictureName);
                }else{
                    Tools::alert('error', 'Algo Falhou', 'Sua alteração falhou. Tente novamente mais tarde');
                    return false;
                }  
            }
        }
    }
?>