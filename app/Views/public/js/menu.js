
$(document).ready(function(){

    $("#icon-close").hide()

    function menu(){
        $("#menu").toggleClass("active")

        let active = $("#menu").hasClass("active")

        $("#icon").attr('aria-expanded', active);

        if(active){
            $("#icon").attr('aria-label', 'Fechar Menu');
            $("#icon").attr('aria-haspopup', true);
            
            $("#icon-open").hide()
            $("#icon-close").show()
        }else{
            $("#icon").attr('aria-label', 'Abrir Menu');
            $("#icon").attr('aria-haspopup', false);

            $("#icon-open").show()
            $("#icon-close").hide()
        }
    }
    $("#icon").click(menu)
})

