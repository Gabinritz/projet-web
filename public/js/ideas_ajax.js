let url = '/ideas'
$.ajaxSetup({
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
});

function unvote(id) {
    $.ajax({
        type: 'DELETE',
        url: url + '/vote/' + id,
        success: function(data) {
            console.log(data)
            $('#thumb-'+id).css('color', '#212121')
            $('#thumb-'+id).attr('onclick', 'vote('+id+')')
            document.getElementById('vote_count-'+id).innerHTML--
        },
        error: function(data) {
            console.log('Error : ', data)
        }
    })
}

function vote(id) {
    $.ajax({
        type: 'POST',
        url: url + '/vote',
        data: {
            'id': id
        },
        dataType: 'json',
        success: function(data) {
            console.log(data)
            $('#thumb-'+id).css('color', '#4CAF50')
            $('#thumb-'+id).attr('onclick', 'unvote('+id+')')
            document.getElementById('vote_count-'+id).innerHTML++
        },
        error: function(data) {
            console.log('Error : ', data)
        }
    })
}

function deleteIdea(id) {
    $.ajax({
        type: 'DELETE',
        url: url + '/' + id,
        success: function(data) {
            console.log(data)
            $('#idea-'+id).remove()
        },
        error: function(data) {
            console.log('Error : ', data)
        }
    })
}

function accept(id) {
    $.get(url + '/' + id, function(data) {
        console.log(data)
        $('#id').val(data.id)
        $('#name').val(data.name)
        $('#description').val(data.description)
    })
    
    checkText(document.getElementById('name'))
    checkText(document.getElementById('description'))
    checkText(document.getElementById('date'))
    $('#addIdea').show()
}


$('#submitBde').click(function(e) {
    e.preventDefault()
    let formData = new FormData(document.getElementById('formBde'))
    $.ajax({
        type: 'POST',
        url: url,
        data: formData,
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function(data) {
            console.log(data)
            $('#idea-'+data.id).remove()
            $('#formBde').remove()
        },
        error: function(data) {
            console.log('Error : ', data)
        }
    })
})

$('#submitStudent').click(function(e) {
    e.preventDefault()
    let formData = new FormData(document.getElementById('formStudent'))
    $.ajax({
        type: 'POST',
        url: url + '/add',
        data: formData,
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function(data) {
            console.log(data)
            $('#idea-'+(data.id-1)).append('test')
        },
        error: function(data) {
            console.log('Error : ', data)
        }
    })
})


function acceptt(e) {
    let form = document.getElementById('addIdea')
    let accepts = document.getElementsByClassName('accept__btn')
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