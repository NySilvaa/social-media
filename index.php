<?php
    // Arquivo de configuração do site

    require("vendor/autoload.php");
    date_default_timezone_set("America/Sao_Paulo");

    session_start();

    use MVC\Application;

    define('PATH_INTERATIONS', 'http://localhost/social-media/MVC/Views/');
    // Constant para usar em atributos "href" e "src" com o intuito de minimizar o código.

    define('INCLUDE_PATH', 'http://localhost/social-media/');

    $app = new Application();
    $app->run();

?>