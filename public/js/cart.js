

const add_cart = (id) => {
    $.ajax({
        type: "GET",
        url: `?a=add_cart&id=${id}`,
        success: function (response) {
            console.log(response)
            $("#count_cart").html(
                `<div id="count_cart">Carrinho
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span>${response}</span>
                </div>`)
        }
    });
}


const minus_cart = (id) => {
    $.ajax({
        type: "GET",
        url: `?a=minus_cart&id=${id}`,
        success: function (response) {
            console.log(response)
            $("#qtd"+id).html(response)
            $.ajax({
                type: "GET",
                contentType: "application/json",
                url: "?a=get_total",
                // dataType: "JSON",
                success: function (response) {
                    // console.log(response)
                    console.log(JSON.parse(response))
                    let data = JSON.parse(response)
                    $("#total_cart").html(data.total.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}))                  
                }
            });
        }
    });
}

const plus_cart = (id) => {
    $.ajax({
        type: "GET",
        url: `?a=plus_cart&id=${id}`,
        success: function (response) {
            console.log(response)
            $("#qtd"+id).html(response)
            $.ajax({
                type: "GET",
                contentType: "application/json",
                url: "?a=get_total",
                // dataType: "JSON",
                success: function (response) {
                    // console.log(response)
                    console.log(JSON.parse(response))
                    let data = JSON.parse(response)
                    $("#total_cart").html(data.total.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}))                  
                }
            });
        }
    });
}

const delete_item_cart = (id) => {
    $.ajax({
        type: "GET",
        url: `?a=delete_item_cart&id=${id}`,
        success: function () {
        //    console.log(response)
        location.reload(); 
        }
    });
}




