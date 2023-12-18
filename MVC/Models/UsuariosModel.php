<?php

namespace MVC\Models;

use \MVC\MySql;
use \MVC\Tools;

class UsuariosModel{
    public static function sendSolicitation($tokenUser){
        if (self::checkStatusSolicitation($tokenUser)) {
            // O usuário já enviou/recebeu uma solicitação antes. Por isso, não pode enviar novamente
            Tools::alert('error', 'Solicitação Pendente', 'Já existe um pedido de amizade entre você e essa pessoa.');
            return false;
        } else {
            // Não existe vínculo entre os dois, pode enviar o pedido de amizade
            $Metoken = Tools::getToken($_SESSION['id']);
            $sql = MySql::connect()->prepare("INSERT INTO `solicitacoes_de_amizade` VALUES(null, ?,?,?)");
            if ($sql->execute([$Metoken, $tokenUser, 'pendente'])) {
                Tools::alert('success', 'Solicitação enviada.', 'Aguarde a confirmação realizada pela pessoa.');
                return true;
            } else {
                Tools::alert('error', 'Solicitação não Enviada', 'Algo falhou. Tente novamente mais tarde.');
                return false;
            }
        }
    }

    public static function checkStatusSolicitation($tokenUser){
        // Método para verificar se existe algum pedido de amizade entre os usuários
        $Metoken = Tools::getToken($_SESSION['id']);
        $sql = MySql::connect()->prepare("SELECT * FROM `solicitacoes_de_amizade` 
        WHERE (`send` = ? AND `receive` = ?) OR (`receive` = ? AND `send` = ?)");
        $sql->execute([$Metoken, $tokenUser, $Metoken, $tokenUser]);

        return ($sql->rowCount() == 1) ? $sql->fetch(MySql::connect()::FETCH_ASSOC)['status'] : 's/ conexões';
    }

    public static function requestWaiting($token){
        $users = MySql::connect()->prepare("SELECT * FROM `solicitacoes_de_amizade` WHERE `receive` = ? AND status = ?");
        $users->execute([$token, 'pendente']);
        return $users->fetchAll(MySql::connect()::FETCH_ASSOC);
    }

    public static function listRequest($token){
        $users = MySql::connect()->prepare("SELECT * FROM `users` WHERE `token` = ?");
        $users->execute([$token]);

        return $users->fetch(MySql::connect()::FETCH_ASSOC);
    }

    private static function checkUser(){
        if (isset($_GET['aceitar'])) {
            $token = MySql::connect()->prepare("SELECT `token` FROM `users` WHERE token = ?");
            $token->execute([$_GET['aceitar']]);

            return ($token->rowCount() == 1) ? $token->fetch(MySql::connect()::FETCH_ASSOC)['token'] : false;
        } else if (isset($_GET['recusar'])) {
            $token = MySql::connect()->prepare("SELECT `token` FROM `users` WHERE token = ?");
            $token->execute([$_GET['recusar']]);

            return ($token->rowCount() == 1) ? $token->fetch(MySql::connect()::FETCH_ASSOC)['token'] : false;
        }
    }

    public static function AceitarSolicitacao(){
        if (self::checkUser() !== false) {
            // Existe um usuário cadastrado com esse token
            $tokenMe = Tools::getToken($_SESSION['id']);
            $updateRequest = MySql::connect()->prepare("UPDATE `solicitacoes_de_amizade` SET status = ?
                WHERE `send` = ? AND `receive` = ?");

            if ($updateRequest->execute(['aceita', self::checkUser(),$tokenMe])) {
                // O pedido foi aceito com sucesso
                Tools::alert('success', 'Pedido aceito', 'Mande uma mensagem e inicie uma conversa entre vocês.');
                return true;
            } else {
                Tools::alert('error', 'O Pedido não foi confirmado', 'Tente novamente mais tarde.');
                return false;
            }
        } else {
            Tools::alert('error', 'O usuário não existe', 'Você está selecionando um usuário que não tem conta conosco.');
            return false;
        }
    }

    public static function RecusarSolicitacao(){
        if (self::checkUser() !== false) {
            // existe um usuário cadastrado com esse token
            $tokenMe = Tools::getToken($_SESSION['id']);
            $deleteRequest = MySql::connect()->prepare("DELETE FROM `solicitacoes_de_amizade` WHERE `send` = ? AND `receive` = ?");

            if ($deleteRequest->execute([self::checkUser(), $tokenMe])) {
                // O pedido foi recusado com sucesso
                Tools::alert('success', 'Solicitação recusada', 'Navegue pela nossa rede social e conheça novas pessoas');
                return true;
            } else {
                Tools::alert('error', 'Exclusão mal sucedida.', 'Tente novamente mais tarde.');
                return false;
            }
        } else {
            Tools::alert('error', 'O usuário não existe', 'Você está selecionando um usuário que não tem conta conosco.');
            return false;
        }
    }

    public static function listFriends(){
        $meToken = Tools::getToken($_SESSION['id']);
        $sql = MySql::connect()->prepare("SELECT * FROM `solicitacoes_de_amizade`  WHERE (`send` = ?  OR `receive` = ? ) AND `status` = ?");
        $sql->execute([$meToken, $meToken, 'aceita']);
        return $sql->fetchAll(MySql::connect()::FETCH_ASSOC);

        /* Nesse método será requisitado do banco de dados todas as amizades que o usuário tem que foram aceitas, e como não será printado o valor 
        da sessão dele. Nos foreach() que forem executados nas páginas, a lógica será basicamente essa:
            foreach(...){
                if(Quem enviou fui eu?){Se sim, então vou pegar o token de quem recebeu.}
                
                else if(Agora, quem recebeu fui eu?){Se sim, então vou pegar o token de quem enviou}
            }
        */
    }

}
