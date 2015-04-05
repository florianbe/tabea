
$('.btn-delete').click(function (){
    if (confirm(m_answer)){
        var token = $(this).data('token');
        var question = $(this).data('item_id');
        var seq_id = $(this).data('seq_id');

        route = route.replace('__id__', question);

        $.ajax({
            method: 'POST',
            url: route,
            data: {_method: 'delete', _token :token}
        }).done(function() {
            location.reload;
        });
    }
});

$('.btn-back').click(function (){
    parent.history.back();
    return false;
});