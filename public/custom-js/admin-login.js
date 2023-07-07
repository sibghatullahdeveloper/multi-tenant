$(document).ready(function(e){
    // Submit form for admin-login
    $("#admin-login").submit(function(e) {
        //prevent Default functionality
        e.preventDefault();
        //get the action-url of the form
        var actionurl = admin_login_route;
        var data = $("#admin-login").serialize();
        
        console.log(data);
        //do your own request an handle the results
        $.ajax({
                url: actionurl,
                type: 'post',
                dataType: 'application/json',
                data: data,
                beforeSend: function() {
                    // showPreLoader();
                },
                success: function(data) {
                    console.log(data);
                    if(data.success != false){
                        
                    }else{
                        // bootbox.alert(data.message);
                    }
                },
                error: function(jq,status,message) {
                    console.log(jq.responseText);
                    let messages = JSON.parse(jq.responseText);
                    bootbox.alert({
                        message: messages.message,
                        className: 'rubberBand animated',
                        backdrop: true,
                    });                    

                    window.setTimeout(function(){
                        bootbox.hideAll();
                    }, 4000); 
                },
                complete: function() {
                    // hidePreLoader();
                },

        });

    });
});