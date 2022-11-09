
const divMsg = document.querySelector('#msg');
const buttonCloseMsg = document.querySelector('#close-msg');

buttonCloseMsg.addEventListener("click", function() {
    divMsg.classList.add('hidden');
})