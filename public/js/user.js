

$(document).ready(function(){

    $("#cep").focusout(function(){
        $.ajax({
            url: 'https://viacep.com.br/ws/'+$(this).val()+'/json/',
            dataType: 'json',
            success: function(resposta){
                $("#logradouro").val(resposta.logradouro);
                $("#bairro").val(resposta.bairro);
            }
        });
    });
})




