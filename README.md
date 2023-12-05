# Projeto Rede social

Nesse projeto será feito uma rede social utilizando a linguagem PHP e implementando conceitos como MVC e criptografia de dados.

Nele também terá a inclusão dinâmica de classes utilizando a dependência PSR-4 do PHP.

Comando para add: composer dump-autoload
(Para usar o método acima, deve-se ter a biblioteca do composer instalada.)

Será usado o modelo de URLs amigáveis com os comandos do arquivo .htaccess

Para estilizar será utilizado o pré-processador CSS conhecido como LESS, onde ao final do código será disponibilizado um arquivo css.min para melhorar o desempenho.

Paletas de cores do site:
#e0e0e0 (background do site)
#EBEEF2
#D9965B
#595959
#151515

Para criptografia dos dados, será utilizada a classe "ByCript" onde os dados não poderão ser descriptografados, apenas comparados.
Abaixo terá um link explicando melhor sobre essa classe.


Para o banco de dados, foi utilizado a database do MySQL que utiliza modelo relacional. 
Foram criadas três databases, sendo uma para guardar o registro dos usuários. Nela tinha os seguintes campos:

Id (Auto incremento)
Nome
Email
Password
token
Data_registro

Já a segunda tabela foi usada para as solicitações de amizade, seus campos eram:

Id (Auto incremento)
Send
Receive
Status (aceita, pendente)

Por fim, a terceira foi usada para o sistema de cookies da página, seus campos eram:

Id (Auto incremento)
Ip
token
data

*Sistema de amizade*

Para o sistema de aceitar ou recusar a solicitação de amizade será utilizado a coluna "token" da primeira tabela.

Basicamente, cada card contendo as informações sobre o usuário que mandou o pedido, terá dois botões de links (aceitar e recusar), ambos terão como valor passado no attr "href" a ação em forma de query ("?aceitar" ou "?recusar" o pedido)e o seu token, que será um identificador único de cada usuário. Isso porque, independente de qual seja a ação requisitada (aceitar ou recusar o pedido) será recuperado essa ação na query que vai estar na URL e o token do usuário, e será por meio dele que  será feita a exclusão ou a confirmação do pedido de amizade.

A escolha de criar uma coluna com um identificador único (token) mesmo já tendo uma coluna chamada "Id" foi para evitar do usuário ficar mudando o valor na URL e ficar espamando pedidos de amizades, e mesmo que ele faça isso com o valor do token, será difícil acertar a combinação de um usuário cadastrado.

Agora, para enviar o pedido, o sistema foi um pouco diferente, basicamente terá um input do tipo hidden que armazenará o Id do usuário, ao clicar em "Enviar solicitação", o Id será enviado via POST e recuperado pelo PHP, depois é só pegar o Id desse usuário e enviar para a tabela de solicitações.