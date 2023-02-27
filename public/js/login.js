
$(document).ready(()=>{
    $("#register-form").hide()
})

const login = () => {
    $("#tab-login").addClass("active")
    $("#tab-register").removeClass("active")

    $('#login-form').show().fadeIn(function(){ 
        $('#content').animate({
            left: "80px"
        }, 500); 
    },1500).css('left' ,'0');
    $("#register-form").hide()
}

const register = () => {
    $("#tab-register").addClass("active")
    $("#tab-login").removeClass("active")

    // $("#register-form").show('fast')
    $('#register-form').show().fadeIn(function(){ 
        $('#content').animate({
            left: "80px"
        }, 500); 
    },1500).css('left' ,'0');
    $("#login-form").hide()

}

