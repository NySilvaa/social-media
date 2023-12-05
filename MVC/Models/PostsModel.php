<?php 
    namespace MVC\Models;
    use \MVC\Tools;
    use \MVC\MySql;
    use \MVC\Models\UsuariosModel;

    class PostsModel{
        public static function validatePost($posts, $file){
            if($posts['post_content'] == '' && $file['name'] == ''){
                Tools::alert('error', 'Post Inválido', 'Você precisa adicionar algo para postar.');
                return false;
            }else{
               if($file['name'] == ''){
                    // Não foi selecionado nenhum arquivo ou imagem para ser postado, apenas texto
                    $post = strip_tags($posts['post_content']);
                    $token = Tools::getToken($_SESSION['id']);
                    $date = date('Y-m-d H:i:s', time());
                    $sql = MySql::connect()->prepare("INSERT INTO posts VALUES (null, ?,?,?,?)");
                    if($sql->execute([$token, $post, 's/ img' ,$date])){
                        // Tudo certo na criação do post
                        Tools::alert('success', 'Post Enviado', 'Seu conteúdo foi postado com sucesso.');
                    }else{
                        // Algo falhou na hora de postar
                        Tools::alert('error', 'Post não Enviado', 'Algo falhou na sua postagem. Tente novamente mais tarder');
                        return false;
                    }
               }else{
                    $extension = explode('/', $file['type'])[0];

                    switch($extension){
                        case 'image':
                            if(self::validadeImgPost($file)){
                                // A imagem atende aos requisitos
                                $post = strip_tags($posts['post_content']);
                                $token = Tools::getToken($_SESSION['id']);
                                $imgFormato = explode('.', $file['name']);
                                $imgName = uniqid().'.'.$imgFormato[count($imgFormato) -1];
                                $date = date('Y-m-d H:i:s', time());
                                $sql = MySql::connect()->prepare("INSERT INTO posts VALUES (null, ?,?,?,?)");
                                if($sql->execute([$token, $post,$imgName ,$date])){
                                    // Tudo certo na criação do post
                                    Tools::alert('success', 'Post Enviado', 'Seu conteúdo foi postado com sucesso.');
                                    move_uploaded_file($file['tmp_name'], BASE_DIR.'/MVC/Views/posts_img/'.$imgName);
                                    }else{
                                        // Algo falhou na hora de postar
                                        Tools::alert('error', 'Post não Enviado', 'Algo falhou na sua postagem. Tente novamente mais tarde');
                                        return false;
                                    }
                            }
                        break;

                        case 'video':
                            if(self::validateVideoPost($file)){
                                // A imagem atende aos requisitos
                                $post = strip_tags($posts['post_content']);
                                $token = Tools::getToken($_SESSION['id']);
                                $videoFormato = explode('.', $file['name']);
                                $videoName = uniqid().'.'.$videoFormato[count($videoFormato) -1];
                                $date = date('Y-m-d H:i:s', time());
                                $sql = MySql::connect()->prepare("INSERT INTO posts VALUES (null, ?,?,?,?)");
                                if($sql->execute([$token, $post,$videoName ,$date])){
                                    // Tudo certo na criação do post
                                    Tools::alert('success', 'Post Enviado', 'Seu conteúdo foi postado com sucesso.');
                                    move_uploaded_file($file['tmp_name'], BASE_DIR.'/MVC/Views/posts_img/'.$videoName);
                                    }
                            }
                        break;

                        default:
                            Tools::alert('error', 'Erro ao selecionar o arquivo', 'Arquivo com extensão não permitida');
                            Tools::redirect('/social-media/');
                        break;
                    }
               }
            }
        }

        private static function validadeImgPost($img){
            switch($img['type']){
                case 'image/jpeg':
                    $fileSize = (int) ($img['size'] / 1024);

                    if($fileSize < 5000)
                        return true;
                    else
                        return false;
                break;

                case 'image/jpg':
                    $fileSize = (int) ($img['size'] / 1024);

                    if($fileSize < 5000)
                        return true;
                    else
                        return false;
                break;

                case 'image/png':
                    $fileSize = (int) ($img['size'] / 1024);

                    if($fileSize < 5000)
                        return true;
                    else
                        return false;
                break;

                case 'image/gif':
                    $fileSize = (int) ($img['size'] / 1024);

                    if($fileSize < 5000)
                        return true;
                    else
                        return false;
                break;

                default:
                    return false;
            }
        }

        private static function validateVideoPost($video){
            $fileSize = (int) ($video['size'] / 1024);

            if($fileSize <= 120000){
                // Pode anexar o vídeo
                return true;
            }else{
                // Vídeo muito pesado
                Tools::alert('error', 'Post não enviado', 'O vídeo que você anexou é muito pesado. Tente outro.');
                return false;
            }
        }

        public static function showPostFriends(){
            $dados = [];

           $posts = MySql::connect()->prepare("SELECT posts.*, users.Nome FROM posts INNER JOIN users ON posts.token_user = users.token"); 
           $posts->execute();
           $posts = $posts->fetchAll(MySql::connect()::FETCH_ASSOC);
           $meToken = Tools::getToken($_SESSION['id']);

           $meusPosts = MySql::connect()->prepare('SELECT * FROM posts WHERE token_user = ?');
           $meusPosts->execute([$meToken]);
           $meusPosts = $meusPosts->fetchAll(MySql::connect()::FETCH_ASSOC);

           foreach ($meusPosts as $value)
                $dados[] = $value;
           

            foreach (UsuariosModel::listFriends() as  $value) {
                // Laço de repetição nos amigos que o usuário tem.
                if($value['send'] == $meToken){
                    // Quem enviou fui eu, por isso quero o id de quem recebeu   

                    foreach ($posts as $valor) {
                       if($value['receive'] == $valor['token_user']){
                         $dados[] = $valor; 
                       }       
                    }
                }else if($value['receive'] == $meToken){
                    // Quem recebeu o pedido fui eu, por isso quero o id de quem enviou

                    foreach ($posts as $valor) {
                        if($value['send'] == $valor['token_user']){
                            $dados[] = $valor; 
                          }     
                    }
                }
            }
            
            return $dados;
        }

        // TO DO: CRIAR A VALIDAÇÃO PARA ANEXOS ENVIADOS
    }

?>