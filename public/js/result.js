var Result = function(){};

Result.success = function(title, msg){
    var output = '';

    if(typeof msg === 'undefined'){
        output = "Success";
    }else{
        output = msg
    }

    $("#alert").addClass("alert-success");
    $("#alert").find("#alert-title").html(title);
    $("#alert").find("#alert-msg").html(msg);
    $("#alert").show();
    setTimeout(function() {
        $("#alert").fadeOut();
    }, 5000);
};

Result.error = function(title, msg){
    var output = '';

    if(typeof msg == 'undefined'){
        output = "Error";
    }

    if(typeof msg == 'object'){
        for (var key in msg) {
            if (typeof msg[key] == 'object'){
                for(var _key in msg[key]){
                    output += msg[key][_key] + "<br />";
                }
            }else{
                output += msg[key] + "<br />";
            }
        }
    }else{
        output += msg;
    }

    $("#alert").addClass("alert-danger");
    $("#alert").find("#alert-title").html(title);
    $("#alert").find("#alert-msg").html(msg);
    $("#alert").show();
    setTimeout(function(){
        $("#alert").fadeOut();
    }, 5000);

};