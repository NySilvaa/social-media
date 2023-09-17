<?php
    namespace MVC\Controllers;
    use \MVC\Views\MainView;

    class HomeController{

        public function index(){
            isset($_SESSION['login']) ? MainView::render('home') : MainView::render('login');
                //                                          Renderiza a página home     Renderiza a página registrar               
        }
    }

?>