$(document).ready(function () {
    const btnSignIn = $('#btn-sign-in');
    console.log("ready");
    
    btnSignIn.click(function (){
        const idValue = $('#id').val(), pwValue = $('#pw').val();
        console.log("click");
        console.log(idValue, pwValue);
        
        const checkMsg = $('#check_msg');
        $.ajax({
            type: "post",
            url: "sign_in.php",
            data: {"id" : idValue, "pw" : pwValue},
            success: function (response) {
                if(response){
                    checkMsg.text(response);
                    checkMsg.removeClass("hidden");
                } else {
                    location.href = 'index.php';
                }
            }
        });
    });
    
});