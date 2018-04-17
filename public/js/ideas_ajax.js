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
                var newNumber = Number($('#x').val()) - 1;
                $('#vote_count-' + id).text(newNumber);
                $('#count_val-' + id).val(newNumber);
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
                var newNumber = Number($('#x').val()) + 1;
                $('#vote_count-'+id).text(newNumber);
                $('#count_val-'+id).val(newNumber);
            },
            error: function(data) {
                console.log('Error : ', data)
            }
        })
    }