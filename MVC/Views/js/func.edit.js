const displayFile = ()=>{
    // Função para mostrar a imagem selecionada pelo usuário em tempo real antes dele fazer o post  
    const imagem = document.getElementById('edit_img--profile') // O arquivo selecionado
    
    const file = imagem.files[0]

    if(file){
        let objectURL = URL.createObjectURL(file)
        const avatar = document.querySelector('.pic_profile')
        const btnAvatar = document.querySelector('.updatePic')

        avatar.innerHTML = `<img src="${objectURL}" />`       
        btnAvatar.classList.add('active')
    }
}