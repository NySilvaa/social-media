<?php
    namespace MVC;

use DateTime;
use \MVC\MySql;
    use \MVC\Tools;

    class Cookie{
        public static function generateCookie($id){
            $user = Tools::getToken($id);

            $checkExistCookie = MySql::connect()->prepare("SELECT * FROM `cookie` WHERE token = ?");
            $checkExistCookie->execute([$user]);

            if($checkExistCookie->rowCount() == 1)
                //Não é necessário criar um cookie, pois já existe um
                return false;
            else{
                if(isset($_POST['cookie'])){
                    // O usuário clicou para lembrar mesmo após fechar o navegador
                        
                        $sql = MySql::connect()->prepare("INSERT INTO `cookie` VALUES(null, ?,?,?)");
                        if(!$sql->execute([$_SERVER['REMOTE_ADDR'], $user, date("Y-m-d")])){
                            Tools::alert('error','Não foi possível salvar o cookie.','Tente novamente mais tarde');
                            die();
                        }else{
                            setcookie("userToken", $user, time() + (60*60*24*3));
                    }
                }     
            }
        }

        public static function deleteCookie($id){
            $token = Tools::getToken($id);

            $checkExistCookie = MySql::connect()->prepare("SELECT `data` FROM `cookie` WHERE token = ?");
            $checkExistCookie->execute([$token]);
            $checkExistCookie = $checkExistCookie->fetch()[0];

            $date = DateTime::createFromFormat('Y-m-d', $checkExistCookie);
            $date = $date->format("d/m/Y");

            $splitDateDB = substr($date, 0, 2);
            $splitDateAtual = substr(date('d/m/Y'), 0, 2);

            if(((int) $splitDateAtual - (int) $splitDateDB) == 4){
                // O cookie expirou, devemos apagar o dado no banco de dados.
                $del = MySql::connect()->prepare("DELETE FROM `cookie` WHERE token = ?");
                $del->execute([$token]);
            }
        }
    }

?>