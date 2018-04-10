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