
const btn = document.getElementById('btnPass');
const password = document.querySelector('.password');
let open = true;

btn.addEventListener('click', ()=>{
    if(open){
        btn.classList.remove('bx-hide');
        btn.classList.add('bx-show');
        password.setAttribute('type','text');
        open = false;
    }else{
        btn.classList.remove('bx-show');
        password.setAttribute('type','password');
        btn.classList.add('bx-hide');
        open = true;
    }
})

const btnInfoPass = document.getElementById('btnInfoPass');
const infoCampo = document.getElementById('infoCampo');

btnInfoPass.addEventListener('mouseenter', ()=>infoCampo.classList.add('active'))

btnInfoPass.addEventListener('mouseout', ()=>infoCampo.classList.remove('active'))

    const requerimentsList = document.querySelectorAll('#requerimentsList li')

    const requeriments = [
        {regex: /.{8,}/, index: 0}, //Verifica o número de caracteres
        {regex: /[0-9]/, index: 1}, // Verifica se tem pelo menos um número na senha
        {regex: /[a-z]/, index: 2}, // Verifica se tem uma letra minúscula na senha
        {regex: /[A-Z]/, index: 3}, // Verifica se tem uma letra maiuscula na senha
        {regex: /[^A-Za-z0-9]/, index: 4} //Verifica se tem um caracter especial
    ]


password.addEventListener('keyup', (e)=>{

    requeriments.forEach(item=>{
        const valid = item.regex.test(e.target.value);
        const requerimentsItem = requerimentsList[item.index]

        if(valid){
            requerimentsItem.firstElementChild.className = 'bx bx-check'
            requerimentsItem.classList.add('valid')
        }else{
            requerimentsItem.firstElementChild.className = 'bx bx-x'
            requerimentsItem.classList.remove('valid')
        }
    })
})

password.addEventListener('focus', () => infoCampo.classList.add('active'))