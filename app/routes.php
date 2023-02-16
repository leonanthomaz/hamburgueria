<?php

//Definindo bloco de classes predefinidas para montagem da logica a partir da URL
$routes = [

    //Principal
    "index" => "main@index",
    "dashboard" => "main@dashboard",
    "login" => "main@login",

    //Carrinho
    "cart" => "cart@cart",
    "addCart" => "cart@addCart",

];

//Definindo rota padrão
$action = "index";

//Verificação da rota passada por URL
if(isset($_GET['a'])){
    if(!key_exists($_GET['a'], $routes)){
        $action = 'index';
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






