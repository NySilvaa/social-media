<?php
    // Arquivo de configuração do site

    require("vendor/autoload.php");

    session_start();

    use MVC\Application;

    define('INCLUDE_PATH', 'http://localhost/social-media/MVC/Views/');
    // Constant para usar em atributos "href" "src" com o intuito de minimizar o código.

    $app = new Application();
    $app->run();

?>