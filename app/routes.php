<?php

//Definindo bloco de classes predefinidas para montagem da logica a partir da URL
$rotas = [
    "index" => "main@index",
    "dashboard" => "main@dashboard"
];

//Definindo rota padrão
$acao = "index";

//Verificação da rota passada por URL
if(isset($_GET['a'])){
    if(!key_exists($_GET['a'], $rotas)){
        $acao = 'index';
    }else{
        $acao = $_GET['a'];
    }
}

//Desestruturação da rota, dividindo em duas partes
$partes = explode('@', $rotas[$acao]);

//O controlador recebe o caminho da classe, especificando a primeira parte
$controlador = 'App\\Controllers\\'.ucfirst($partes[0]);

//Especificando a parte dois como método
$metodo = $partes[1];

//Instanciando a classe controladora, com a primeira parte definida
$ctr = new $controlador();

//Chamando o metodo também definido
$ctr->$metodo();






