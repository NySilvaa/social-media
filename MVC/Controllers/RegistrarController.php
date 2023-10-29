<?php
    namespace MVC\Controllers;
    use \MVC\Views\MainView;
    use \MVC\Bcrypt;
    use \MVC\MySql;

    class RegistrarController{

        public function index(){
            MainView::render('registrar');
                // Usuário  vai realizar o cadastro dele na página registrar.          
        }

        public function registerUser($arr){
            $control = true; // Variável de controle
            $query = "INSERT INTO users VALUES(null";

            foreach ($arr as $key => $value) {
                if($key == 'acao' || $key == 'ConfirmPass' || $key == 'policy')
                // Valores que não devem ser adicionados à database
                    continue; 

                if($value == ""){
                    // Valores vazios não são permitidos.
                    $control = false;
                    break;
                }

                if($key == 'Senha')
                    // Vamos encriptografar ela
                    $value = Bcrypt::hash($value);

                $query.= ",?";
                $data[] = $value;
            }

            $query.= ")";
            if($control){
                // Os valores passados são coerentes aqueles que são esperados. A inserção pode ser feita.
                $sql = MySql::connect()->prepare($query);
                $sql->execute($data);
            }
            return $control;
        }
    }

?>