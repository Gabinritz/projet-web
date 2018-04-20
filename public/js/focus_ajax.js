let url = '/activities'
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
            $('#like-'+idPhoto).css('color', '#212121')
            $('#like-'+idPhoto).attr('onclick', 'unlike('+idActivity+','+idPhoto+')')
            document.getElementById('like_count-'+idPhoto).innerHTML++
        },
        error: function(data) {
            console.log('Error : ', data)
        }
    })
}