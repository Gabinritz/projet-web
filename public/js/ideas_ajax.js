    let url = '/ideas'
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

    function unvote(id) {
        $.ajax({
            type: 'DELETE',
            url: url + '/' + id,
            success: function(data) {
                console.log(data)
                $('#thumb-'+id).css('color', '#212121')
                $('#thumb-' + id).attr('onclick', 'vote(' + id + ')')
                let x = $('#vote_count-'+id)
                x.textContent--
            },
            error: function(data) {
                console.log('Error : ', data)
            }
        })
    }

    function vote(id) {
        $.ajax({
            type: 'POST',
            url: url,
            data: {
                'id': id
            },
            dataType: 'json',
            success: function(data) {
                console.log(data)
                $('#thumb-' + id).css('color', '#4CAF50')
                $('#thumb-' + id).attr('onclick', 'unvote('+id+')')
                let x = $('#vote_count-2')
                x.textContent++
            },
            error: function(data) {
                console.log('Error : ', data)
            }
        })
    }