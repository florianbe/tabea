
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

var rules_SetQuestionGroupField = function(){
    var options = '';
    $.each(dd_data.questiongroups, function(i, item) {
        options += '<option value="' + dd_data.questiongroups[i].id + '">' + dd_data.questiongroups[i].name + '</option>';

    });

    document.getElementById("questiongroups").innerHTML = options;
};

var rules_setQuestionField = function(){
    var options = '';

    $.each(dd_data.questiongroups, function(qg, questiongroup) {
        if (questiongroup.id == $('#questiongroups').val())
        {
            $.each(questiongroup.questions, function(q, question) {
                options += '<option value="' + question.id + '">' + question.text + '</option>';
            });
        }
    });
    document.getElementById("questions").innerHTML = options;
};

var rules_setAnswerField = function(){
    var options = '';

    $.each(dd_data.questiongroups, function(qg, questiongroup) {
        if (questiongroup.id == $('#questiongroups').val())
        {
            $.each(questiongroup.questions, function(q, question) {
                if(question.id == $('#questions').val())
                {
                    $.each(question.answers, function(a, answer) {
                        options += '<option value="' + answer.id + '">' + answer.text + '</option>';
                    });
                }
            });
        }
    });
    document.getElementById("answers").innerHTML = options;
};