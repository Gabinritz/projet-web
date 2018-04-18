function changeLogin(state) {
    let loginPage = document.getElementById('login')
    let registerPage = document.getElementById('register')

    if (state == 1) {
        loginPage.classList.add('hidden')
        registerPage.classList.remove('hidden')
    } else {
        registerPage.classList.add('hidden')
        loginPage.classList.remove('hidden')
    }
}

let content = document.getElementById('hamburger-content')
let sidebarBody = document.getElementById('hamburger-sidebar-body')
let button = document.getElementById('hamburger-button')
let overlay = document.getElementById('hamburger-overlay')
let activatedClass = 'hamburger-activated'; 

sidebarBody.innerHTML = content.innerHTML; 
button.addEventListener('click', function(e) { 
    e.preventDefault()
    this.parentNode.classList.add(activatedClass)
})

button.addEventListener('keydown', function(e) {
    if (this.parentNode.classList.contains(activatedClass)) { 
        if (e.repeat === false && e.which === 27) {
            this.parentNode.classList.remove(activatedClass)
        }
    } 
})
overlay.addEventListener('click', function(e) {
    e.preventDefault()
    this.parentNode.classList.remove(activatedClass)
})







let modals = document.getElementsByClassName('modal')
let closes = document.getElementsByClassName('close')
let body = document.getElementById('body')

function modal(id) {
    for (let i = 0; i < modals.length; i++) {
        let modal = document.getElementById('modal-' + id)
        let close = document.getElementById('close-' + id)
        let preview = document.getElementById('preview-' + id)
        let react = document.getElementById('react-' + id)
        let image = document.getElementById('img-' + id)

        modal.style.display = "flex"
        body.style.overflow = "hidden"

        close.onclick = function (event) {
            modal.style.display = "none"
            body.style.overflow = "auto"
        }
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none"
                body.style.overflow = "auto"
            }
        }


        if (window.innerWidth < 992) {
            react.style.display = "none"
            image.style.display = "flex"
            close.style.color = "#d90119"
            preview.style.backgroundColor = "transparent"

            close.onclick = function (event) {
                modal.style.display = "none"
                body.style.overflow = "auto"
                react.style.display = "none"
                image.style.display = "flex"
                close.style.color = "#D90119"
                preview.style.backgroundColor = "transparent"
            }
            preview.onclick = function (event) {
                if (react.style.display == "none") {
                    react.style.display = "block"
                    image.style.display = "none"
                    close.style.color = "#212121"
                    preview.style.backgroundColor = "#212121"
                } else {
                    react.style.display = "none"
                    image.style.display = "flex"
                    close.style.color = "#D90119"
                    preview.style.backgroundColor = "transparent"
                }
            }
        } else {
            react.style.display = "block"
            image.style.display = "flex"
            close.style.color = "#d90119"
        }
    }
}



function showNotif(a) {
    let top = a.offsetTop
    let left = a.offsetLeft
    let box = document.getElementById('notif__box')

    if (box.style.display == 'none') {
        box.style.display = 'block'
        box.style.top = 'calc(12px + '+top+'px)'
        box.style.right = 'calc(100vw - '+left+'px - 12px)'
    } else {
        box.style.display = 'none'
    }
}