<?php
    namespace MVC\Controllers;
    use MVC\Views\MainView;

    class ProfileController{
        public function index(){
            MainView::render('profile');
        }
    }
?>