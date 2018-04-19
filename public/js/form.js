function inputValid(input, valid) {
    if (valid) {
        if (input.classList.contains('input__invalid')) {
            input.classList.replace('input__invalid', 'input__valid')
        } else { input.classList.add('input__valid') }
    } else {
        if (input.classList.contains('input__valid')) {
            input.classList.replace('input__valid', 'input__invalid')
        } else { input.classList.add('input__invalid') }
    }
}


function checkX(input) {
    if (0) {
        inputValid(input, false)
    } else { inputValid(input, true) }
}

function checkFile(input) {
    if (input.files.length == 0) {
        inputValid(input, false)
    } else { inputValid(input, true) }
}

function checkText(input) {
    if(input.value.length < 1) {
        inputValid(input, false)
        return false
    } else {
        inputValid(input, true)
        return true
    }
    console.log(input)
}

function checkNumber(input) { // isNaN
    if(input.value.length < 0) {
        inputValid(input, false)
        return false
    } else {
        inputValid(input, true)
        return true
    }
}


function checkMail(input) {
    let regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/

    if (!regex.test(input.value)) {
        inputValid(input, false)
        return false
    } else {
        inputValid(input, true)
        return true
    }
}
function checkPassword(input) {
    let regex = /^(?=.*\d)(?=.*[A-Z])(?!.*[^a-zA-Z0-9@#$^+=])(.{4,16})$/

    if (!regex.test(input.value)) {
        inputValid(input, false)
        return false
    } else {
        inputValid(input, true)
        return true
    }
}

function checkForm_login(form) {
    let mail = checkMail(form.email)
    let password = checkMail(form.password)

    if (mail && password) {
        return true
    } else { 
        alert("Veuillez remplir correctement tous les champs")
    }
}

function checkForm(form) {
    let name = checkText(form.name)
    let description = checkText(form.description)
    let date = checkText(form.date)
    let place = checkText(form.place)
    
    if ( name && description && date && place) {
        return true
    } else {
        alert("Veuillez remplir correctement tous les champs")
    }
}