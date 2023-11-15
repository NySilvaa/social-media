<?php
    namespace MVC;
    use \MVC\Views\MainView;

    class Cache{
        public static function validateCache($component){
            if(isset($_SESSION['login'])){
                $data = json_decode(file_get_contents('cache'));
                // Renovando o cache
                if($data->tempo < time()){
                    $data = json_encode([
                        'tempo' => time() * (60*30),
                        'header' => file_get_contents(PATH_INTERATIONS.'pages/header.php'),
                        'aside' => file_get_contents(PATH_INTERATIONS.'pages/aside.php')
                    ]);
                    file_put_contents('cache',$data);
                    $data = json_decode($data); 
                }
                echo $data->$component;
            }else{
                // Criando um novo cache
                    $data = json_encode([
                        'tempo' => time() * (60*60),
                        'header' => file_get_contents(PATH_INTERATIONS.'pages/header.php'),
                        'aside' => file_get_contents(PATH_INTERATIONS.'pages/aside.php')
                    ]);
                    file_put_contents('cache',$data);
                    $data = json_decode($data);
                    MainView::render($component);
            }
        }
    }

?>