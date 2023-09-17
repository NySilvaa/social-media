<?php
    namespace MVC;

    class Application{
        private $controller;

        public function setApp(){
            $loadName = 'MVC\Controllers\\';
            $url = explode('/', @$_GET['url']);

            $url[0] == '' ? $loadName.="Home" : $loadName.=ucfirst(strtolower($url[0]));

            $loadName.="Controller";

            if(file_exists($loadName.".php"))
                $this->controller = new $loadName();
            else{
                include("Views/pages/404.php");
                die();
            }
        }

        public function run(){
            $this->setApp();
            $this->controller->index();
        }
    }

?>