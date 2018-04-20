let url = '/bde-website/public/activities'
$.ajaxSetup({
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
});

function unlike(idActivity, idPhoto) {
    $.ajax({
        type: 'DELETE',
        url: url + '/' + idActivity + '/like/' + idPhoto,
        success: function(data) {
            console.log(data)
            $('#like-'+idPhoto).css('color', '#212121')
            $('#like-'+idPhoto).attr('onclick', 'like('+idActivity+','+idPhoto+')')
            document.getElementById('like_count-'+idPhoto).innerHTML--
            document.getElementById('item_count_likes-'+idPhoto).innerHTML--
            document.getElementById('preview_count_likes-'+idPhoto).innerHTML--
        },
        error: function(data) {
            console.log('Error : ', data)
        }
    })
}

function like(idActivity, idPhoto) {
    $.ajax({
        type: 'POST',
        url: url + '/' + idActivity + '/like/' + idPhoto,
        data: {
            'idActivity': idActivity,
            'idPhoto': idPhoto
        },
        dataType: 'json',
        success: function(data) {
            console.log(data)
            $('#like-'+idPhoto).css('color', '#F44336')
            $('#like-'+idPhoto).attr('onclick', 'unlike('+idActivity+','+idPhoto+')')
            document.getElementById('like_count-'+idPhoto).innerHTML++
            document.getElementById('item_count_likes-'+idPhoto).innerHTML++
            document.getElementById('preview_count_likes-'+idPhoto).innerHTML++
        },
        error: function(data) {
            console.log('Error : ', data)
        }
    })
}


$('.formComment').submit(function(e) {
    e.preventDefault()
    let formData = new FormData()
    let idPhoto = $('#comment-id', this).val()
    console.log(idPhoto)
    formData.append('idPhoto', idPhoto)
    formData.append('comment', $('#comment-'+idPhoto).val())
    $.ajax({
        type: 'POST',
        url: url + '/photos/' + idPhoto,
        data: formData,
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function(data) {
            console.log(data)
            $('#contents-'+idPhoto).append('<div class="section-react-comments-bloc">\
                <span class="section-react-comments-user">'+data.user+'</span>\
                <span class="section-react-comments-content">'+data.content+'</span>\
            </div>')
            document.getElementById('item_count_comments-'+idPhoto).innerHTML++
            document.getElementById('preview_count_comments-'+idPhoto).innerHTML++
            $('#comment-'+idPhoto).val('')
        },
        error: function(data) {
            console.log('Error : ', data)
        }
    })
})
