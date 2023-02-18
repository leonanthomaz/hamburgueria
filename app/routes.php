<?php

//Definindo bloco de classes predefinidas para montagem da logica a partir da URL
$routes = [

    //Principal
    "maintenance" => "main@maintenance",
    "index" => "main@index",
    "dashboard" => "main@dashboard",

    //Carrinho
    "cart" => "cart@cart",
    "addCart" => "cart@addCart",

    //Usuários
    "login" => "user@login",
    "register" => "user@register",
    "cep" => "user@cep",

    //metodos - usuarios
    "insert_user" => "user@insert_user",
    "success_new_user" => "user@success_new_user",

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






