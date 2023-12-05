$(function () {
    $(".forms").submit(function(e){
        e.preventDefault(); // Previne o padrão.
        let formData = $(this).serialize().split('=')[1];

        $.ajax({
            type: "POST",
            url: "http://localhost/social-media/comunity",
            data: { 'idUser': formData},
            success: function (response) {
                let secaoMayKnow = $(response).find('.MayKnow').html();

                if(secaoMayKnow != '' || secaoMayKnow != undefined)
                    $('.MayKnow').html(secaoMayKnow);
                else
                    return false;
            }, error: function () {
                // aqui você pode lidar com erros
                alert("Ocorreu um erro ao enviar os dados.");
                return false;
            }
        }); //Fechamento da requisição AJAX
    }); // Fechamento do método submit do formulário

    const urlQuery = window.location.href.split('?')

    if (urlQuery[1].match(/aceitar/) !== null || urlQuery[1].match(/recusar/) !== null) {
        // Função para apagar a query após ser executada, para evitar do user ficar tentando spammar solicitação.
        setTimeout(() => {
            window.history.pushState('', '', 'comunity');

            $.ajax({
                type: "GET",
                url: "http://localhost/social-media/comunity",
                success: function (response) {
                    let secaoFriendsRequest = $(response).find('section.solicitacoes').html();
    
                    if(secaoFriendsRequest != '' || secaoFriendsRequest != undefined)
                        $('section.solicitacoes').html(secaoFriendsRequest);
                    else
                        return false;
                }, error: function () {
                    // aqui você pode lidar com erros
                    alert("Ocorreu um erro ao enviar os dados.");
                    return false;
                }
            }); //Fechamento da requisição AJAX

            const icons = document.querySelectorAll('ul.menu_aside li')
            icons.forEach(element => {
                // Serve para marcar a página que o user está no menu aside, pq ao executar a ação do pedido de amizade ocorre um bug na marcação.
                let filho = element.children[0]
                let attr = filho.getAttribute('data-status')
                let url = window.location.href.split('/')

                if (attr == url[url.length - 1])
                    element.classList.add('active')
                else if (url[url.length - 1] == '')
                    if (attr === 'feed')
                        element.classList.add('active')
            });

        }, 1000)
    }
})