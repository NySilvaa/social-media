<?php
    use \MVC\Controllers\HomeController;

    $homeController = new HomeController;
    $homeController->logoff();
?>

<h3>Home</h3>
<a href="?logoff">Sair</a>