$(function() {
    DataTableAnswers();
})

function AddAnswers(complaint_id, user_level, userid) {
    
    var myanswer = $('#myanswer').val();
    var data = 'complaint_id='+complaint_id+'&user_level='+user_level+'&userid='+userid+'&myanswer='+myanswer;
    
    if(myanswer === '') {
        
        alert('Oh snap! You should write your answer!');
    } else {
        
        $.ajax({
            
            type: "POST",
            url: '../AdminDesign/php/ajaxAddAnswers.php',
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
    $.post('../AdminDesign/php/DataTableAnswers.php', function(data) {
        $('#answers-list').html(data);
    })
}