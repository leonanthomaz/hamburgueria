$(document).ready(function(){

    $.ajax({
        type: 'GET',
        url: '?a=teste',
        dataType: 'json',

        success: function(resposta){
            console.log(resposta)
            let idSession = resposta.id;
            PagSeguroDirectPayment.setSessionId(idSession)

            //Get CreditCard Brand and check if is Internationl
            // $("#creditCardNumber").keyup(function(){
            //     if ($("#creditCardNumber").val().length >= 6) {
            //         PagSeguroDirectPayment.getBrand({
            //             cardBin: $("#creditCardNumber").val().substring(0,6),
            //             success: function(response) { 
            //                     console.log(response);
            //                     $("#creditCardBrand").val(response['brand']['name']);
            //                     $("#creditCardCvv").attr('size', response['brand']['cvvSize']);
            //             },
            //             error: function(response) {
            //                 console.log(response);
            //             }
            //         })
            //     };
            // })

            PagSeguroDirectPayment.getPaymentMethods({
                success: function(res){
                    console.log(res)
                },
                error: function(error){
                    console.log(error)
                }
            })

        }
    });

})




