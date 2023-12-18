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

        public static function showPosts(){
            $dados = [];
            $meToken = Tools::getToken($_SESSION['id']);  // Pego o meu token de usuário

            $meusPosts = MySql::connect()->prepare("SELECT posts.*, users.img_profile FROM posts INNER JOIN users
            ON posts.token_user = users.token WHERE token_user = ?");  // Vou selecionar os meus posts
            $meusPosts->execute([$meToken]);
            $totalPostsMe = $meusPosts->fetchAll(MySql::connect()::FETCH_ASSOC);

            if($meusPosts->rowCount() === 1) // Eu postei apenas uma vez, adicione no array "dados"
                $dados[] = $totalPostsMe[0];
            else if($meusPosts->rowCount() > 1){ // Eu fiz mais de um post, por isso devemos rodar um laço de repetição dentro deles e adicioná-los no array "dados"
                foreach ($totalPostsMe as $valor)  
                    $dados[] = $valor;           
            }
            
            foreach (UsuariosModel::listFriends() as  $value) {
                // Laço de repetição nos amigos que o usuário tem.
                if($value['send'] == $meToken){
                    // Quem enviou o pedido de amizade fui eu, por isso quero o token de quem recebeu   
                    $posts = MySql::connect()->prepare("SELECT posts.*, users.Nome, users.img_profile FROM posts INNER JOIN users
                                     ON posts.token_user = users.token WHERE posts.token_user = ?"); 
                    $posts->execute([$value['receive']]);
                    $userPosts = $posts->fetchAll(MySql::connect()::FETCH_ASSOC);

                    if($posts->rowCount() === 0) // Sem posts desse amigo, pule
                        continue;
                    else if($posts->rowCount() === 1) // O amigo só postou uma vez, adicione no array "dados"
                        $dados[] = $userPosts[0];
                    else{ // O user fez mais de um post, por isso devemos rodar um laço de repetição dentro deles e adicioná-los no array "dados"
                        foreach ($userPosts as $valor)  
                              $dados[] = $valor;           
                    }
                }else if($value['receive'] == $meToken){
                    // Quem recebeu o pedido fui eu, por isso quero o token de quem enviou
                    $posts = MySql::connect()->prepare("SELECT posts.*, users.Nome FROM posts INNER JOIN users
                                     ON posts.token_user = users.token WHERE posts.token_user = ?"); 
                    $posts->execute([$value['send']]);
                    $userPosts = $posts->fetchAll(MySql::connect()::FETCH_ASSOC);

                    if($posts->rowCount() === 0) // Sem posts desse amigo, pule
                        continue;
                    else if($posts->rowCount() === 1) // O amigo só postou uma vez, adicione no array "dados"
                        $dados[] = $userPosts[0];
                    else{ // O user fez mais de um post, por isso devemos rodar um laço de repetição dentro deles e adicioná-los no array "dados"
                        foreach ($userPosts as $valor)  
                            $dados[] = $valor;           
                    }
                }
            }
            
            return $dados;
        }

        // TO DO: CRIAR A VALIDAÇÃO PARA ANEXOS ENVIADOS
    }

?>