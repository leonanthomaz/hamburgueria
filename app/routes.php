<?php

//Definindo bloco de classes predefinidas para montagem da logica a partir da URL
$routes = [
    "teste" => "teste@teste",

    //Principal
    "maintenance" => "main@maintenance",
    "index" => "main@index",
    "about" => "main@about",
    "contact" => "main@contact",
    "products" => "main@products",
    "login" => "main@login",
    "login_facebook" => "main@login_facebook",
    "register" => "main@register",
    "cart" => "main@cart",
    "checkout" => "main@checkout",

    //Boas vindas
    "success_new_client" => "client@success_new_client",
    "success_email_link_confirm" => "client@success_email_link_confirm",
    "success_new_order" => "cart@success_new_order",

    //Carrinho
    "add_cart" => "cart@add_cart",
    "delete_cart" => "cart@delete_cart",
    "minus_cart" => "cart@minus_cart",
    "plus_cart" => "cart@plus_cart",
    "checkout_cart" => "cart@checkout_cart",
    "get_total" => "cart@get_total",
    "delete_item_cart" => "cart@delete_item_cart",
    "coupon" => "cart@coupon",
    "send_order" => "cart@send_order",

    //Cliente
    "register_submit" => "client@register_submit",
    "login_submit" => "client@login_submit",
    "login_google_submit" => "client@login_google_submit",
    "login_facebook_submit" => "client@login_facebook_submit",
    "logout" => "client@logout",

    //Serviços de Email
    'email_validate_purl' => 'client@email_validate_purl',
    'email_link_confirm' => 'client@email_link_confirm',
];

//Definindo rota padrão
$action = ROUTE_MAIN;

//Verificação da rota passada por URL
if(isset($_GET['a'])){

    if($action === "maintenance"){
        $routes = ["maintenance" => "main@maintenance"];
    }

    if(!key_exists($_GET['a'], $routes)){
        $action = ROUTE_MAIN;
    }else{
        $action = $_GET['a'];
    }
}

//Desestruturação da rota, dividindo em duas parts
$parts = explode('@', $routes[$action]);

//O controller recebe o caminho da classe, especificando a primeira parte
$controller = 'App\\Controllers\\'.ucfirst($parts[0]);

//Especificando a parte dois como método
$method = $parts[1];

//Instanciando a classe controllera, com a primeira parte definida
$ctr = new $controller();

//Chamando o method também definido
$ctr->$method();






