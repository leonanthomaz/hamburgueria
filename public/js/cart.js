

const add_cart = (id) => {

    $.ajax({
        type: "GET",
        url: `?a=add_cart&id=${id}`,
        success: function (response) {
            console.log(response)
            $("#count_cart").html(response)
        }
    });
}


const remove_cart = (id) => {
    $.ajax({
        type: "GET",
        url: `?a=minus_cart&id=${id}`,
        success: function (response) {
            console.log(response)
            $("#count_cart").html(response)
        }
    });
}




