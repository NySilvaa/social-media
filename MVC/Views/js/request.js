const urlQuery = window.location.href.split('?')

if(urlQuery[1].match(/aceitar/) !== null || urlQuery[1].match(/recusar/) !== null){
    // Função para apagar a query após ser executada, para evitar do user ficar tentando floppar solicitação.
    setTimeout(()=>{
        window.history.pushState('','','comunity');
        const icons = document.querySelectorAll('ul.menu_aside li')
    
        icons.forEach(element => {
            // Serve para marcar a página que o user está no menu aside, pq ao executar a ação do 
            // pedido de amizade ocorre um bug na marcação.
            let filho = element.children[0]
            let attr = filho.getAttribute('data-status')
            let url = window.location.href.split('/')
        
            if(attr == url[url.length-1])
                element.classList.add('active')
            else if(url[url.length-1] == '')
                if(attr === 'feed')
                    element.classList.add('active')
        });
        
    }, 1000)
}