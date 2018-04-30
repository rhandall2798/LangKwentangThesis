$(function() {
    DataTableUsers();
    DataTableComplaints();
    ShowSuggestions();
})

function DataTableComplaints() {
    $.post('../AdminDesign/php/ajaxShowComplaints.php', function(data) {
        $('#data-complaints').html(data);
    })
}

function DataTableUsers() {
    $.post('../AdminDesign/php/ajax.php', function(data) {
        $('#data-lists').html(data);
    })
}

function ShowSuggestions(){
        $.post('../AdminDesign/php/ajaxShowSuggestions.php', function(data) {
        $('#data-listko').html(data);
    })
}


function DeleteUser(userid) {
    
    swal({
        title:"Notice me senpai!",
        text: "You are about to <b>delete</b> the selected user. Do you want to continue?",
        type: "warning",
        confirmButtonText: "Yes, delete it!",
        confirmButtonColor: "#ff5454",
        cancelButtonText: "No!",
        showCancelButton: true,
        closeOnConfirm: true,
        html: true
    }, function(isConfirm) {
        
        if(isConfirm) {
            
            var data = 'userid='+userid;
            
            $.ajax({
                type: "POST",
                url: '../AdminDesign/php/ajaxDeleteUser.php',
                data: data,
                cache: false,
                success: function(data) {
                    if(data.trim() == 1) {
                        swal({
                            title: "Deleted!",
                            text: "The selected user has successfully deleted!",
                            type: "success",
                            confirmButtonText: "Horrayyy!"
                        }, function() {
                            DataTableUsers();
                        })
                    } else {
                        swal({
                            title: "Oh snap!",
                            text: "We are unable to delete the selected data. Please try again later.",
                            type: "error",
                            confirmButtonText: "Retry",
                            confirmButtonColor: "#ff5454"
                        })
                    }
                }
            })
        }
    })
}

function manageData(key){
    var username = $("#username");
    var password = $("#password");
    var userlevel = $("#userlevel");
    var status = $("#status");
    

    if(isNotEmpty(username) && isNotEmpty(password) && isNotEmpty(userlevel) && isNotEmpty(status)){
        $.ajax({
            url: '../AdminDesign/php/ajaxCreateUser.php',
            method: 'POST',
            dataType: 'text',
            data:{
                key:key,
                username: username.val(),
                password: password.val(),
                userlevel: userlevel.val(),
                status: status.val()
            }, success: function(data){
                  swal({
                        title: "Success!",
                        text: "You have successfully Registered data",
                        type: "success",
                        confirmButtonText: "Continue"
                    },function(){
                       DataTableUsers();
                       });
            }
        })
    }
}

function isNotEmpty(caller){
               
        if(caller.val() == ''){
        caller.css('border','1px solid red');
        return false;
    }
    else{
              
        caller.css('border','');
        return true;
    }
}

function GetUserDetails(userid) {
    // Add User ID to the hidden field for furture usage
    $("#hidden_user_id").val(userid);
    $.post("../AdminDesign/php/readUserDetails.php", {
            id: userid
        },
        function (data, stats) {
            // PARSE json data
            var user = JSON.parse(data);
            // Assing existing values to the modal popup fields
            $("#updateusername").val(user.username);
            $("#updatepassword").val(user.password);
            $("#updateuserlevel").val(user.user_level);
            $("#updatestatus").val(user.status);
        }
    );
    // Open modal popup
    $("#update_user_modal").modal("show");
}

function UpdateUserDetails() {
    // get values
    var upusername = $("#updateusername").val();
    var uppassword = $("#updatepassword").val();
    var upuserlevel = $("#updateuserlevel").val();
    var upstatus = $("#updatestatus").val();
 
    // get hidden field value
    var id = $("#hidden_user_id").val();
 
    // Update the details by requesting to the server using ajax
    $.post("../AdminDesign/php/updateUserDetails.php", {
            id: id,
            username: upusername,
            password: uppassword,
            userlevel: upuserlevel,
            status: upstatus
        
        },
        function (data, status) {
        
        
            
            // hide modal popup
            $("#update_user_modal").modal("hide");
            // reload Users by using readRecords();
            DataTableUsers();
        
        
        }
    );
}





function getSuggestionDetails(userid) {
    // Add User ID to the hidden field for furture usage
    $("#hidden_user_id").val(userid);
    $.post("../AdminDesign/php/readSuggestionDetails.php", {
            id: userid
        },
        function (data, stats) {
            // PARSE json data
            var user = JSON.parse(data);
            // Assing existing values to the modal popup fields
            $("#upsubject").val(user.subject);
            $("#upsuggestion").val(user.suggestion);
            $("#updatestatus").val(user.status);
        }
    );
    // Open modal popup
    $("#update_suggestion_modal").modal("show");
}

function UpdateSuggestionDetails() {
    // get values
    var upsubject = $("#upsubject").val();
    var upsuggestion = $("#upsuggestion").val();
    var upstatus = $("#updatestatus").val();
 
    // get hidden field value
    var id = $("#hidden_user_id").val();
 
    // Update the details by requesting to the server using ajax
    $.post("../AdminDesign/php/updateSuggestionDetails.php", {
            id: id,
            subject: upsubject,
            suggestion: upsuggestion,
            status: upstatus
        
        },
        function (data, status) {
        
        
        if(data.trim() == 1) {
                        swal({
                            title: "Updated!",
                            text: "The selected problem has successfully updated!",
                            type: "success",
                            confirmButtonText: "Horrayyy!"
                        }, function() {
                            $("#update_suggestion_modal").modal("hide");
                            DataTableSuggestions();
                        })
                    }
           
        
        
        }
    );
}

function getComplaintDetails(userid) {
       // Add User ID to the hidden field for furture usage
    $("#hidden_user_id").val(userid);
    $.post("../AdminDesign/php/readComplaintDetails.php", {
            id: userid
        },
        function (data, stats) {
            // PARSE json data
            var user = JSON.parse(data);
            // Assing existing values to the modal popup fields
            $("#upsubject").val(user.subject);
            $("#upsuggestion").val(user.problem);
            $("#updatestatus").val(user.status);
        }
    );
    // Open modal popup
    $("#update_complaint_modal").modal("show");
}

function UpdateComplaintDetails() {
    // get values
    var upsubject = $("#upsubject").val();
    var upsuggestion = $("#upsuggestion").val();
    var upstatus = $("#updatestatus").val();
 
    // get hidden field value
    var id = $("#hidden_user_id").val();
 
    // Update the details by requesting to the server using ajax
    $.post("../AdminDesign/php/updateComplaintDetails.php", {
            id: id,
            subject: upsubject,
            suggestion: upsuggestion,
            status: upstatus
        
        },
        function (data, status) {
            
        
            
            // hide modal popup
            $("#update_complaint_modal").modal("hide");
            // reload Users by using readRecords();
           
        
        
        }
    );
}

function updatepopulation(){
    
    var uppopulation = $("#population").val();
    
    $.post("../AdminDesign/php/updatepopulationdetail.php",{
        population: uppopulation
    },
          function (data,status){
        $("#populationmodal").modal("hide");
    });
}







