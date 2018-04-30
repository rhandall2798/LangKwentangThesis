$(function() {
    DataTableAnswers();
})

function AddAnswers(suggestion_id, user_level, userid) {
    
    var myanswer = $('#myanswer').val();
    var data = 'suggestion_id='+suggestion_id+'&user_level='+user_level+'&userid='+userid+'&myanswer='+myanswer;
    
    if(myanswer === '') {
        
        alert('Oh snap! You should write your answer!');
    } else {
        
        $.ajax({
            
            type: "POST",
            url: '../AdminDesign/php/ajaxAddAnswersSuggestion.php',
            data: data,
            success: function(data) {
                if(data.trim() == 1) {
                    
                    DataTableAnswers();
                    $('#myanswer').val(null);
                } else {
                    
                    if(data.trim() == 0) {
                        alert("Oh snap! We are unable to process your answer!");
                    }
                }
            }
        })
    }
}

function DataTableAnswers() {
    $.post('../AdminDesign/php/DataTableSuggestion.php', function(data) {
        $('#answers-list').html(data);
    })
}