<?php

namespace App\Models;

use Exception;

class Store {

    //Montagem da estrutura de arquivos para construção do layout,
    //passando structure (arquivos) e data, como arrays de produtos para views por ex.
    //Estes arquivos são passados por parametros, uma vez que for chamado o metodo na classe Main.
    public static function Layout($structures, $data = null){
        if(!is_array($structures)){
            throw new Exception('Operação inválida inválida');
        }

        //se existir parametro data, extraia para trabalhar com variaveis
        if(!empty($data) && is_array(($data))){
            extract($data);
        }

        //loop de execução para inclusão dos arquivos na montagem do layout
        foreach($structures as $structure){
            include('app/views/'.$structure.'.php');
        }
    }


    //Metodo de Redirecionamento
    public static function redirect($route = ''){
        //Redirecionamento chamando a URL + a route
        header('Location:'.BASE_URL.'?a='.$route);
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