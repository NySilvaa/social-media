<?php
    namespace MVC;

    class Tools{
        public static function alert($status, $title, $msg){
            echo '
                <div class="box_alert '. $status.'">
                    <h4>'.$title.'</h4>
                    <p>'.$msg.'</p>
                </div>';
        }
    }

?>