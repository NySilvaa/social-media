const btn = document.querySelector('.btn_menu')
let control =  true

const menuAside = ()=>{
    const aside = document.getElementById('aside')
    const aside_mobile = document.querySelector('.aside_mobile')
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
    const main = document.querySelector('main.active')
    main.style.width = `calc(100% - 50px)`
}

window.addEventListener('resize', ()=>{
    setTimeout(()=>{
        if(window.innerWidth <= 850){
            changeIconHeader()
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