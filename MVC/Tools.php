<?php
    namespace MVC;
    use \MVC\MySql;

    class Tools{
        public static function alert($status, $title, $msg){
            echo '
                <div class="box_alert '. $status.'">
                    <h4>'.$title.'</h4>
                    <p>'.$msg.'</p>
                </div>

                <script>
                    setTimeout(function() {
                        $(".box_alert").fadeOut("slow");
                    }, 3000);
                </script>
                ';
        }

        public static function getToken($id){
            $user = MySql::connect()->prepare('SELECT `token` FROM users WHERE `Id` = ?');
            $user->execute([$id]);
            return $user->fetch(MySql::connect()::FETCH_ASSOC)['token'];
        }

        public static function redirect($url){
            echo "<script>window.location.href = '$url'</script>";
            die();
        }

    }

?>