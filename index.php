<?php
    // Arquivo de configuração do site
    use MVC\Application;

    require("vendor/autoload.php");
    session_start();
    date_default_timezone_set("America/Sao_Paulo");
    define('BASE_DIR', __DIR__);

    define('PATH_INTERATIONS', 'http://localhost/social-media/MVC/Views/');
    // Constant para usar em atributos "href" e "src" com o intuito de minimizar o código.

    define('INCLUDE_PATH', 'http://localhost/social-media/');
    // Constant para redirecionamentos entre as páginas do site

    $app = new Application();
    $app->run();

?>