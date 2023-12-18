<?php
    // Arquivo de configuração do site
    use MVC\Application;

    require("vendor/autoload.php");
    session_start(); // Inicia as sessões
    date_default_timezone_set("America/Sao_Paulo"); // Pega a data e hora atual com base nesse fuso horário
    define('BASE_DIR', __DIR__); // Pega o diretório completo

    define('PATH_INTERATIONS', 'http://localhost/social-media/MVC/Views/');
    // Constant para usar em atributos "href" e "src" com o intuito de minimizar o código.

    define('INCLUDE_PATH', 'http://localhost/social-media/');
    // Constant para redirecionamentos entre as páginas do site

    function recoverPost($post){
        // Serve para recuperar os valores digitados pelo usuário caso ele não tenha passado nas verificações pela primeira vez
        if(isset($_POST[$post]))
            return $_POST[$post];
    }

    $app = new Application();
    $app->run();

?>