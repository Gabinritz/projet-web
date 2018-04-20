$('#search').keyup(function(e) {
    let input = $(this)
    let val = input.val()
    if(val == '') { $("#filter .card.card__activity").show() }
    let regexp = '\\b(.*)'
    for (let i in val) {
        regexp += '('+val[i]+')(.*)'
    }
    regexp += '\\b'
    $('#filter h3>.card__title').show()
    $('#filter').find('h3').each(function() {
        let name = $(this)
        let results = name.text().match(new RegExp(regexp, 'i'))
        console.log(results)
        if(!results) {
            name.parent().parent().parent().parent().hide()
        }
    })
})

let closeAdd = document.getElementById('close__add')
let modalAdd = document.getElementById('modal__add')
let btnAdd = document.getElementById('product__add')

btnAdd.onclick = function() {
    modalAdd.style.display = "flex";
}
closeAdd.onclick = function() {
    modalAdd.style.display = "none";
}
window.onclick = function(event) {
    if (event.target == modalAdd) {
        modalAdd.style.display = "none";
    }
}


function deleted() {
    let closeDel = document.getElementById('close__del')
    let modalDel = document.getElementById('modal__del')
    let btnDel = document.getElementById('product__del')
    modalDel.style.display = 'flex'

    closeDel.onclick = function() {
        modalDel.style.display = "none"
    }

    window.onclick = function(event) {
        if (event.target == modalDel) {
            modalDel.style.display = "none";
        }
    }
}