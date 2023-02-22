$(document).ready(function(){

    $("#cep").focusout(function(){
        $.ajax({
            url: 'https://viacep.com.br/ws/'+$(this).val()+'/json/',
            dataType: 'json',
            success: function(resposta){
                console.log(resposta)
                $("#logradouro").val(resposta.logradouro);
                $("#bairro").val(resposta.bairro);
            }
        });
    });

    $("#cep_checkout").focusout(function(){
        $.ajax({
            url: 'https://viacep.com.br/ws/'+$(this).val()+'/json/',
            dataType: 'json',
            success: function(resposta){
                console.log(resposta)
                $("#logradouro_checkout").val(resposta.logradouro);
                $("#bairro_checkout").val(resposta.bairro);
            }
        });
    });
})




