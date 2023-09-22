<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH ?>styles/css/style.registrar.min.css">
    <title>Cadastre-se agora e junte-se a nós</title>
</head>
<body>
        <section class="registrar">
            <div class="container ">
                <div class="register_wp d-flex">
                    <div class="form_register">
                        <div class="title_register">
                            <h1 class="logo txt-orange"><i class='bx bxs-invader'></i></h1>
                            <h2 class="txt-dark">Get Started Now!</h2>
                            <p class="title_desc">Welcome in our social media, create account to start your experience.</p>
                        </div>

                    <form action="" method="post">
                        <div class="social-medias d-flex">
                            <a href="http://" class="box-midia"><i class='bx bxl-google' ></i> Sign in with Google</a>
                            <a href="http://" class="box-midia"><i class='bx bxl-apple' ></i> Sign in with Apple</a>
                        </div>

                            <div class="form_wp">
                                <label for="name" class="txt-dark">Nome</label>
                                <input type="text" id="nome"  name="nome" />
                                <span><i class='bx bx-user'></i></span>
                            </div><!-- /.form_wp -->

                            <div class="form_wp">
                                <label for="email" class="txt-dark">Email</label>
                                <input type="text" id="email" name="email" />
                                <span><i class='bx bx-envelope'></i></span>
                            </div><!-- /.form_wp -->
                            
                            <div class="form_wp w50">
                                <label for="password" class="txt-dark">Senha</label>
                                <input type="password" id="password"  name="password" />
                                <span class="pw"><i class='bx bx-hide'></i></span>
                            </div><!-- /.form_wp -->

                            <div class="form_wp w50">
                                <label for="ConfirmPass" class="txt-dark">Repetir Senha</label>
                                <input type="password" id="ConfirmPass"  name="ConfirmPass" />
                                <span class="pw"><i class='bx bx-hide'></i></span>
                            </div><!-- /.form_wp -->

                                <div class="form_wp">
                                    <input type="checkbox" name="policy" id="policy" >
                                    <label for="policy" class="check"><i class="bx bx-check"></i></label>
                                    <p>I'm Read and Agree With to the <a href="#">Privacy Policy</a></p>
                                </div>
                                <!-- /.form_wp -->

                            <div class="form_wp">
                                <button type="submit" name="Enviar" id="btn-form">Criar Conta</button>
                            </div><!-- /.form_wp -->
                        </form>

                        <p class="login">Já possui uma conta? <a href="/">Sign in</a></p>
                    </div>
                    <!-- /.form_register -->

                    <div class="form_img"></div><!-- /.form_img -->
                </div><!-- /.register_wp -->
                
            </div>
        </section>

        <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
</body>
</html>