function regist() {
    alert('oi');
    var data = $("#register-form").serialize();
    console.log(data);
    alert(data);

    $.ajax({
        
        type : 'POST',
        url  : 'reg/register.php',
        data : data,
        beforeSend: function()
        {
            $("#error").fadeOut();
            $("#btn-submit").html('<span class="glyphicon glyphicon-transfer"></span>   sending ...');
        },
        success :  function(data)
        {

            if(data==1){

                $("#error").fadeIn(1000, function(){


                    $("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span>   Sorry email already taken !</div>');

                    $("#btn-submit").html('<span class="glyphicon glyphicon-log-in"></span>   Create Account');

                });

            }
            else if(data=="registered")
            {

                $("#btn-submit").html('Signing Up');
                setTimeout('$(".form-signin").fadeOut(500, function(){ $(".signin-form").load("successreg.php"); }); ',5000);

            }
            else{

                $("#error").fadeIn(1000, function(){

                    $("#error").html('<div class="alert alert-danger"><span class="glyphicon glyphicon-info-sign"></span>   '+data+' !</div>');

                    $("#btn-submit").html('<span class="glyphicon glyphicon-log-in"></span>   Create Account');

                });

            }
        }
    });
    return false;
}
