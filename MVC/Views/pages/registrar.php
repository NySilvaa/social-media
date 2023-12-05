<?php
    use \MVC\Controllers\RegistrarController;
    use \MVC\Tools;
    use \MVC\MySql;
    MySql::connect();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="keywords" content="social media, like, rede social, conectar, login">
    <meta name="description" content="Rede social para fins de testes">
    <meta name="author" content="Nycolas Ramos da Silva">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="<?php echo PATH_INTERATIONS ?>styles/css/style.registrar.min.css">
    <title>Cadastre-se agora e junte-se a nós</title>
</head>
<body>

    <div class="tools">
        <div class="cookie-card">
            <span class="title">🍪 Aceita cookies?</span>
            <p class="description">Nós usamos cookies para garantir a melhor experiência no site para você. <a href="#">Leia as nossas políticas de uso</a>. </p>
            <div class="actions">
                <button class="pref">
                    Gerenciar Cookies
                </button>
                <button class="accept">
                    Aceitar
                </button>
            </div>
        </div>
    </div>

    <section class="registrar">
        <div class="container ">
            <div class="register_wp d-flex">
                <div class="form_register">
                    <div class="title_register">
                        <h1 class="logo txt-purple"><i class='bx bxs-invader'></i></h1>
                        <h2 class="txt-dark">Get Started Now!</h2>
                        <p class="title_desc">Welcome in our social media, create account to start your experience.</p>
                    </div><!--title_register-->

                    <form action="" method="post">
                        <div class="social-medias d-flex">
                            <a href="http://" class="box-midia"><i class='bx bxl-google' ></i> Sign in with Google</a>
                            <a href="http://" class="box-midia"><i class='bx bxl-apple' ></i> Sign in with Apple</a>
                        </div>

                        <div class="form_wp">
                            <label for="name" class="txt-dark">Nome</label>
                            <input type="text" id="name"  name="Nome" />
                            <span><i class='bx bx-user'></i></span>
                        </div><!-- /.form_wp -->

                        <div class="form_wp">
                            <label for="email" class="txt-dark">Email</label>
                            <input type="text" id="email" name="Email" />
                            <span><i class='bx bx-envelope'></i></span>
                        </div><!-- /.form_wp -->
                        
                        <div class="form_wp w50">
                            <div class="dropup_form" id="infoCampo">
                                    <ul class="txt_gray" id="requerimentsList">
                                        <p>Password must constains:</p>
                                        <li><i class="bx bx-x"></i> At least 8 characters length</li>
                                        <li><i class="bx bx-x"></i> At least number (0...9)</li>
                                        <li><i class="bx bx-x"></i> At least lowercase letter (a...z)</li>
                                        <li><i class="bx bx-x"></i> At least uppercase letter (A...Z)</li>
                                        <li><i class="bx bx-x"></i> At least special symbol (!...@)</li>
                                    </ul>
                                </div><!-- /.dropup_form -->

                            <label for="password" class="txt-dark">Senha <i class='bx bx-error-circle' id="btnInfoPass"></i></label>
                            <input type="password" class="password"  name="Senha"  id="password"/>
                            <span class="pw"><i class='bx bx-hide' id="btnPass"></i></span>
                        </div><!-- /.form_wp -->

                        <input type="hidden" name="token" value="<?php echo uniqid() ?>">

                        <div class="form_wp w50">
                            <label for="ConfirmPass" class="txt-dark">Repetir Senha</label>
                            <input type="password" id="ConfirmPass"  name="ConfirmPass" />
                        </div><!-- /.form_wp -->

                            <div class="form_wp">
                                <input type="checkbox" name="policy" id="policy" >
                                <label for="policy" class="check"><i class="bx bx-check"></i></label>
                                <p>I'm Read and Agree With to the <a href="#">Privacy Policy</a></p>
                            </div><!-- /.form_wp -->

                            <input type="hidden" name="date_registro" value="<?php echo date("Y-m-d") ?>">
                            <div class="form_wp">
                                <button type="submit" name="acao" id="btn-form">Criar Conta</button>
                            </div><!-- /.form_wp -->
                    </form>

                    <p class="login">Já possui uma conta? <a href="<?php echo INCLUDE_PATH?>">Sign in</a></p>
                </div><!-- /.form_register -->     

                <div class="form_img"></div><!-- /.form_img -->
            </div><!-- /.register_wp --> 
        </div>
    </section>
    <?php

    if(isset($_POST['acao'])){
       $createUser = new RegistrarController();
       
       if($createUser->registerUser($_POST)){
           $_SESSION['registrar'] = true;
            Tools::redirect('/social-media/');
       }else
            Tools::alert('error','Seu login falhou','Ocorreu algum erro no registro. Tente novamente mais tarde.');
            return false;
    }
    ?>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <script src="<?php echo PATH_INTERATIONS; ?>js/func.form.js" defer></script>
</body>
</html>