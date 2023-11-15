<?php
    use \MVC\Bcrypt;
    use \MVC\Tools;
    use \MVC\MySql;
    use \MVC\Cookie;

    if(isset($_COOKIE['userToken'])){
        // O usuário clicou anteriormente no botão "Lembrar de mim" e possui um cookie salvo
        $check = MySql::connect()->prepare('SELECT * FROM users WHERE token = ?');
        $check->execute([$_COOKIE['userToken']]);
        $data = $check->fetch();

        if($check->rowCount() == 1){
            $_SESSION['login'] = uniqid();
            $_SESSION['nome'] = $data['Nome'];
            $_SESSION['id'] = $data['Id'];
            header('Location: '.INCLUDE_PATH);
            die();
        }
    }
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
    <title>Sign Up</title>
</head>
<body>
    <section class="registrar">
        <div class="container ">
            <div class="register_wp d-flex">
                <div class="form_register">
                    <div class="title_register">
                        <h1 class="logo txt-purple"><i class='bx bxs-invader'></i></h1>
                        <h2 class="txt-dark">Welcome back!</h2>
                        <p class="title_desc">Connect now and see the main events of the moment.</p>
                    </div>

                    <form action="" method="post">
                        <div class="social-medias d-flex">
                            <a href="http://" class="box-midia"><i class='bx bxl-google' ></i> Sign in with Google</a>
                            <a href="http://" class="box-midia"><i class='bx bxl-apple' ></i> Sign in with Apple</a>
                        </div>

                        <div class="form_wp">
                            <label for="email" class="txt-dark">Email</label>
                            <input type="text" id="email" name="email" />
                            <span><i class='bx bx-envelope'></i></span>
                        </div><!-- /.form_wp -->
                        
                        <div class="form_wp">
                            <label for="password" class="txt-dark">Senha</label>
                            <input type="password" class="password"  name="password" />
                            <span class="pw"><i class='bx bx-hide' id="btnPass"></i></span>        
                        </div><!-- /.form_wp -->

                        <div class="form_wp w50">
                            <input type="checkbox" name="cookie" id="cookie" >
                            <label for="cookie" class="check"><i class="bx bx-check"></i></label>
                            <p>Lembrar de mim.</p>
                        </div><!-- /.form_wp -->

                        <div class="form_wp w50" style="text-align: right; font-size: 0.9rem;"><a href="#" style="color: #865DFF; font-weight: 600;">Esqueci a senha.</a></div>
                        <!-- /.form_wp -->

                        <div class="form_wp">
                            <button type="submit" name="login" id="btn-form">Sign Up</button>
                        </div><!-- /.form_wp -->
                    </form>

                    <p class="login">Ainda não possui uma conta? <a href="<?php echo INCLUDE_PATH?>registrar">Create Account</a></p>
                </div><!-- /.form_register -->                

                <div class="form_img"></div><!-- /.form_img -->
            </div><!-- /.register_wp -->
        </div><!--container-->
    </section>

    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <script src="<?php echo PATH_INTERATIONS; ?>js/func.form.js"></script>
</body>
</html>

<?php
    if(isset($_POST['login'])){
        // Usuário está tentando fazer o login
        $email = $_POST['email'];
        $senha = $_POST['password'];

        $check = MySql::connect()->prepare('SELECT * FROM users WHERE Email = ?');
        $check->execute([$email]);

        if($check->rowCount() == 0)
        // Vejo se existe algum registro salvo no BD com esse email
            Tools::alert('error','Email Inválido.','O email inserido não existe ou não foi escrito corretamente.');
        else{
            // Aqui é verificado se existe algum registro que bate com o email e senha digitado.
            $data = $check->fetch();

            if(Bcrypt::check($senha, $data['Senha'])){
                // Verifico se a senha que o user digitou é a mesma que está encriptografada e salva no BD.
                    $_SESSION['login'] = uniqid();
                    $_SESSION['nome'] = $data['Nome'];
                    $_SESSION['id'] = $data['Id'];
                    Cookie::generateCookie($_SESSION['id']);
                    header('Location: '.INCLUDE_PATH);
                    die();
             }else
                Tools::alert('error','Usuário Inválido.','Email ou senha estão incorretos. Tente novamente.');
        }
    }
?>