<?php
    namespace MVC\Controllers;
    use \MVC\Views\MainView;

    class RegistrarController{

        public function index(){
            MainView::render('registrar');
                // Usuário  vai realizar o cadastro dele na página registrar.           
        }
    }

?>