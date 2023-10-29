<?php
    namespace MVC;
    use Exception;
    use PDO;
    date_default_timezone_set('America/Sao_Paulo');

    class MySql{
        private static $pdo;
        private const DbData = [
            'host' => 'localhost',
            'dbName' => 'social_media',
            'user'=> 'root',
            'password' => ''
        ];

        public static function connect(){
            if(self::$pdo == null){
                try{
                    // Tentando se conectar com o banco de dados
                    self::$pdo = new PDO("mysql:host=".self::DbData['host'].";dbname=".self::DbData['dbName'], 
                    self::DbData['user'], self::DbData['password'], [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"]);
                    self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                }catch(Exception $e){
                    // Ocorreu um erro na conexão
                    error_log(date("d/m/Y H:i:s")." Ocorreu um erro ao se conectar com o banco de dados! \n Esse foi o erro: ".$e->getMessage()."\n",3,'error_log.log');
                    die("Não foi possível realizar a conexão com o banco de dados. Tente recarregar a página.");
                }
            }

            return self::$pdo;
        }
    }

?>