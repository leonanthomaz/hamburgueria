// $(document).ready(function(){
//     alert("aewew")
// })

const addCart = (id) => {
    
    $.ajax({
        type: "GET",
        url: `?a=addCart&id=${id}`,
        // beforeSend: function (){
        //     $("body").addClass("ativo")
        // },
        success: function (response) {
            console.log(response)
        }
    });
}
