$('#search').keyup(function(e) {
    let input = $(this)
    let val = input.val()
    if (val == '') {
        $('#filter .card.card__activity').show()
    }
    let regexp = '\\b(.*)(a)(.*)(k)(.*)\\b'
    for(let i in val) {
        regexp += '('+val[i]+')(.*)'
    }
    regexp += '\\b'
    console.log($('#filter').find('.card.card__activity>.card__content>h3'))
    $('#filter .card.card__activity').show()
    $('#filter').find('.card.card__activity>.card__content>h3').each(function() {
        let name = $(this)
        let results = name.text().match(new RegExp(regexp, 'i'))
        if (results) {
            let string = ''
            for (let i in results) {
                if(i>0) {
                    if(i%2 == 0) {
                        string+='<h3>'+results[i]+'</h3>'
                    } else {
                        string += results[i]
                    }
                }
            }
            name.empty().append(string)
        } else {
            name.parent().parent().hide()
        }
    })
})