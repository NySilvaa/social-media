<?php
    namespace MVC;
    use \MVC\MySql;

    class Tools{
        public static function alert($status, $title, $msg){
            echo '
                <div class="box_alert '. $status.'">
                    <h4>'.$title.'</h4>
                    <p>'.$msg.'</p>
                </div>';
        }

        public static function getToken($id){
            $user = MySql::connect()->prepare('SELECT `token` FROM users WHERE `Id` = ?');
            $user->execute([$id]);
            return $user->fetch()[0];
        }

    }

?>