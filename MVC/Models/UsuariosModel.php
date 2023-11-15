<?php
    namespace MVC\Models;
    use \MVC\MySql;
    use \MVC\Tools;

    class UsuariosModel{
        public static function sendSolicitation($id){
            if(self::checkStatusSolicitation($id)){
                // O usuário já enviou/recebeu uma solicitação antes. Por isso, não pode enviar novamente
                Tools::alert('error', 'Solicitação Pendente', 'Já existe um pedido de amizade entre você e essa pessoa.');
                return false;
            }else{
                // Não existe vínculo entre os dois, pode enviar o pedido de amizade.
                $sql = MySql::connect()->prepare("INSERT INTO `solicitacoes_de_amizade` VALUES(null, ?,?,?)");
                $sql->execute([$_SESSION['id'], $id, 'pendente']);
                Tools::alert('success', 'Solicitação enviada.', 'Aguarde a confirmação realizada pela pessoa.');
                return true;
            }
        }

        public static function checkStatusSolicitation($id){
            // Método para verificar se existe algum pedido de amizade entre os usuários
                $sql = MySql::connect()->prepare("SELECT * FROM `solicitacoes_de_amizade` 
                WHERE (`send` = ? AND `receive` = ?) OR (`receive` = ? AND `send` = ?)");
                $sql->execute([$_SESSION['id'],$id, $_SESSION['id'], $id]);

                return ($sql->rowCount() == 1) ? true : false;
        }

        public static function requestWaiting($id){
            $users = MySql::connect()->prepare("SELECT * FROM `solicitacoes_de_amizade` 
            WHERE `receive` = ? AND status = ?");
            $users->execute([$id, 'pendente']);
            
            return $users->fetchAll();
        }

        public static function listRequest($id){
            $users = MySql::connect()->prepare("SELECT * FROM `users` 
            WHERE `id` = ?");
            $users->execute([$id]);
            
            return $users->fetch();
        }

        private static function checkUser(){
            if(isset($_GET['aceitar'])){
                $token = MySql::connect()->prepare("SELECT `Id` FROM `users` WHERE token = ?");
                $token->execute([$_GET['aceitar']]);

                return ($token->rowCount() == 1) ? $token->fetch()[0] : false;
            }else if(isset($_GET['recusar'])){
                $token = MySql::connect()->prepare("SELECT `Id` FROM `users` WHERE token = ?");
                $token->execute([$_GET['recusar']]);

                return ($token->rowCount() == 1) ? $token->fetch()[0] : false;
            }
        }

        public static function AceitarSolicitacao(){
           if(self::checkUser() !== false){
                // existe um usuário cadastrado com esse token
                $updateRequest = MySql::connect()->prepare("UPDATE `solicitacoes_de_amizade` SET status = ?
                WHERE `send` = ? AND `receive` = ?");
    
                if($updateRequest->execute(['aceita', self::checkUser(), $_SESSION['id']])){
                    // O pedido foi aceito com sucesso
                    Tools::alert('success','Pedido aceito', 'Mande uma mensagem e inicie uma conversa entre vocês.');
                    return true;
                }else{
                    Tools::alert('error','Pedido não confirmado', 'Tente novamente mais tarde.');
                    return false;
                }

           }else{
                Tools::alert('error','O usuário não existe', 'Você está selecionando um usuário que não tem conta conosco.');
                return false;
           }
        }

        public static function RecusarSolicitacao(){
            if(self::checkUser() !== false){
                // existe um usuário cadastrado com esse token
                $deleteRequest = MySql::connect()->prepare("DELETE FROM `solicitacoes_de_amizade`
                WHERE `send` = ? AND `receive` = ?");
    
                if($deleteRequest->execute([self::checkUser(), $_SESSION['id']])){
                    // O pedido foi recusado com sucesso
                    Tools::alert('success','Solicitação recusada', 'Navegue pela nossa rede social e conheça novas pessoas');
                    return true;
                }else{
                    Tools::alert('error','Exclusão mal sucedida.', 'Tente novamente mais tarde.');
                    return false;
                }
           }else{
                Tools::alert('error','O usuário não existe', 'Você está selecionando um usuário que não tem conta conosco.');
                return false;
           }
        }
    }

?>