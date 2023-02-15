<?php

namespace App\Models;

use Exception;

class Store {

    //Montagem da estrutura de arquivos para construção do layout,
    //passando estruturas (arquivos) e dados, como arrays de produtos para views por ex.
    //Estes arquivos são passados por parametros, uma vez que for chamado o metodo na classe Main.
    public static function Layout($estruturas, $dados = null){
        if(!is_array($estruturas)){
            throw new Exception('Operação inválida inválida');
        }

        //se existir parametro dados, extraia para trabalhar com variaveis
        if(!empty($dados) && is_array(($dados))){
            extract($dados);
        }

        //loop de execução para inclusão dos arquivos na montagem do layout
        foreach($estruturas as $estrutura){
            include('app/views/'.$estrutura.'.php');
        }
    }


    //Metodo de Redirecionamento
    public static function redirect($rota = ''){
        //Redirecionamento chamando a URL + a rota
        header('Location:'.BASE_URL.'?a='.$rota);
    }


    //Metodo debug
    public static function printData($data){
        if(is_array($data) || is_object($data)){
            echo '<pre>';
            print_r($data);
        }else{
            echo '<pre>';
            echo($data);
        }
        die("Finish...");
    }
}