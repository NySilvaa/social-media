<?php
    namespace MVC\Controllers;

    use MVC\Bcrypt;
    use MVC\Views\MainView;
    use MVC\MySql;

    
    class EditController{
        public function index(){
            MainView::render('edit');
        }
        
        public static function updateData($arr){
            if($arr['Senha'] !== $arr['confirmSenha'])
                return false;

            $first = true;
            $query = "UPDATE users SET ";

            foreach ($arr as $key => $value) {
                if($value == '') // Usuário não deseja atualizar esse valor
                    continue;

                if(($key == 'atualizar') || ($key == 'confirmSenha'))
                    continue;

                if($key == 'Senha')
                    $value = Bcrypt::hash($value);

                if($first){
                    $query .= "$key = ?";
                    $first = false;
                }else
                    $query .= ", $key = ?";


                $par[] = strip_tags($value);       
            }

            $query.= " WHERE Id = ".$_SESSION['id'];

            $sql = MySql::connect()->prepare($query);
            $sql->execute($par);

            if($sql->rowCount() === 1){
                // Deu certo
                $_SESSION['nome'] = $arr['Nome'];
                return true;    
            }else
                return false;
        }

        public static function validadePictureProfile($img){
            switch($img['type']){
                case 'image/jpeg':
                    $fileSize = (int) ($img['size'] / 1024);

                    if($fileSize < 3000)
                        return true;
                    else
                        return 'tamanho invalido';
                break;

                case 'image/jpg':
                    $fileSize = (int) ($img['size'] / 1024);

                    if($fileSize < 3000)
                        return true;
                    else
                        return 'tamanho invalido';
                break;

                case 'image/png':
                    $fileSize = (int) ($img['size'] / 1024);

                    if($fileSize < 3000)
                        return true;
                    else
                        return 'tamanho invalido';
                break;

                case 'image/gif':
                    $fileSize = (int) ($img['size'] / 1024);

                    if($fileSize < 3000)
                        return true;
                    else
                        return 'tamanho invalido';
                break;

                default:
                    return false;
            }
        }
    }
?>