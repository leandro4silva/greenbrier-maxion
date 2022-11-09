const Modal = {
    wrapper: document.querySelector('.modal-wrapper'),
    buttonClose: document.querySelector('.close'),
    open(){
        this.wrapper.classList.add('open')    
    },
    close(){
        this.wrapper.classList.remove('open')
    }
}

Modal.buttonClose.onclick = function(){
    Modal.close()
}

window.addEventListener('keydown', handleKeyDown)

function handleKeyDown(event){
    if(event.key == 'Escape' && Modal.wrapper.classList.contains('open')){
        Modal.close()
    }
}

export {
    Modal
}