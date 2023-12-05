const loader = document.getElementById('loading_box')
// Os dois métodos abaixo são para o loader ser carregado enquanto o documento está carregando.
document.addEventListener('DOMContentLoaded', ()=>{
    loader.classList.add('loading')
})
window.onload = ()=>{loader.classList.remove('loading')}

const displayFile = ()=>{
    // Função para mostrar a imagem selecionada pelo usuário em tempo real antes dele fazer o post
    const imagem = document.getElementById('img')
    const container = document.getElementById('container')

   const file = imagem.files[0]

   if(file){
        let objectURL = URL.createObjectURL(file)
        const box = document.getElementById('whats_new-box')

        box.style.height = '500px'
        container.innerHTML = `<img src="${objectURL}" />`
   }
}

let control =  true

const menuAside = ()=>{
    // Função de aparecer e esconder o menu lateral
    const aside = document.getElementById('asideDesktop')
    const aside_mobile = document.getElementById('asideMobile')
    const main = document.getElementById('main')

    if(control){
        aside.classList.add('active')
        main.classList.add('active')
        setTimeout(()=>{
            aside_mobile.classList.add('open')
        }, 400)
        control = false
    }else{
        aside.classList.remove('active')
        aside_mobile.classList.remove('open')
        setTimeout(()=>{
            main.classList.remove('active')
        }, 60)
        control = true
    }
}

const changeIconHeader = ()=>{
    // Quando chegar em telas menores, os ícones e mensagem do header viram apenas ícones para ocupar menos espaço.
    const notifications = document.querySelectorAll('.not_profile')
    
    notifications.forEach(element => {
        let attr = element.getAttribute('data_icon')

        if(attr === 'bell')
            element.innerHTML = '<i class="bx bx-bell new align_box"></i>';
        else if(attr === 'msg')
            element.innerHTML = '<i class="bx bx-envelope new align_box"></i>'
    });
}

const btn = document.querySelector('.btn_menu')
btn.addEventListener('click', ()=>{
    // Botão bars que está no header e serve para ocultar ou mostrar o menu lateral.
    menuAside()
    return false;
})

let time;

window.addEventListener('resize', ()=>{
    // Quando o user redimensionar a janela do site, vai executar a função para adaptar algumas partes do site para telas menores.
    clearTimeout(time)
   time = setTimeout(()=>{
        if(window.innerWidth <= 850){
            changeIconHeader()
            menuAside()
        }

        if(window.innerWidth <= 730){
            const btnSearch = document.getElementById('btnSearch')
            btnSearch.style.display = 'none'
        }
    }, 1000)
})

const BtnActive = ()=>{
    // Função para deixar um cor diferente em algum item no menu lateral com base na página em que o usuário está
    const icons = document.querySelectorAll('ul.menu_aside li')

    icons.forEach(element => {
        let filho = element.children[0]
        let attr = filho.getAttribute('data-status')
        let url = window.location.href.split('/')
    
        if(attr == url[url.length-1])
            element.classList.add('active')
        else if(url[url.length-1] == '')
            if(attr === 'feed')
                element.classList.add('active')
    });
}
BtnActive()

const btnChat = document.getElementById('btn_chat')

btnChat.addEventListener('click', ()=>{
    // Função para mostrar a seção de interações do usuário quando ele estiver em uma tela menor.
    const interationsSection = document.getElementById('interationsSection')

    if(control){
        interationsSection.classList.add('active')
        btnChat.classList.add('menu_active')
        control = false
    }else{
        interationsSection.classList.remove('active')
        btnChat.classList.remove('menu_active')
        control = true
    }
})