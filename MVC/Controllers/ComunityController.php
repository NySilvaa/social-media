<?php
    namespace MVC\Controllers;
    use MVC\Views\MainView;

    class ComunityController{
        public function index(){
            MainView::render('comunity');
        }
    }
?>