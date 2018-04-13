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

function accept(e) {
    let form = document.getElementById('addIdea')
    let accepts = document.getElementsByClassName('accept__btn');
    let name = document.getElementById('name')
    let desc = document.getElementById('description')
    let id = document.getElementById('id')

    for (let i=0; i<accepts.length; i++)  {
        accepts[i].onclick = function(e) {
            if (form.classList.contains('hidden')) {
                form.classList.replace('hidden', 'visible')
            }
        name.value = document.getElementById('idea-name-' + i).innerHTML
        desc.value = document.getElementById('idea-desc-' + i).innerHTML
        id.value = document.getElementById('idea-id-' + i).innerHTML
        }
    }
}

function expand(e) {
    let form = document.getElementById('addIdea')
    let expand = document.getElementById('addIdea__expand')
    
    if (form.classList.contains('hidden')) {
        form.classList.replace('hidden', 'visible')
    } else {
        form.classList.replace('visible', 'hidden')
    }
}