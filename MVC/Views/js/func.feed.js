const loader = document.getElementById('loading_box')
document.addEventListener('DOMContentLoaded', ()=>{
    loader.classList.add('loading')
})

window.onload = ()=>{
    loader.classList.remove('loading')
}

const btn = document.querySelector('.btn_menu')
let control =  true

const menuAside = ()=>{
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
    const notifications = document.querySelectorAll('.not_profile')
    
    notifications.forEach(element => {
        let attr = element.getAttribute('data_icon')

        if(attr === 'bell')
            element.innerHTML = '<i class="bx bx-bell new align_box"></i>';
        else if(attr === 'msg')
            element.innerHTML = '<i class="bx bx-envelope new align_box"></i>'
    });
}

btn.addEventListener('click', ()=>{
    menuAside()
    return false;
})

if(window.innerWidth <= 850){
    menuAside()
    const aside_mobile = document.getElementById('asideMobile')

    let asideWidth = aside_mobile.clientWidth
    console.log(asideWidth)
}else{
    const aside_mobile = document.getElementById('asideMobile')
    aside_mobile.classList.remove('open')
}

window.addEventListener('resize', ()=>{
    setTimeout(()=>{
        if(window.innerWidth <= 850){
            changeIconHeader()
            menuAside()
        }else{
            const aside_mobile = document.getElementById('asideMobile')
            aside_mobile.classList.remove('open')
            control = true
            menuAside()
        }
            
    }, 100)
})

const BtnActive = ()=>{
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