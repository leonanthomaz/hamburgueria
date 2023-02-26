<?php

namespace App\Factorys;

use App\Models\Cart;
use Exception;

class Store {

    //Criação do Layout
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
    public static function redirect($route = null){
        //Redirecionamento chamando a URL + a route
        if(!empty($route)){
            header('Location: ?a='.$route);
        }else{
            header('Location: ?a=index');
        }
    }

    //Criação do Hash (purl)
    public static function criarHash($num_caracteres = 12){

        // criar hashes
        $chars = '01234567890123456789abcdefghijklmnopqrstuwxyzabcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZABCDEFGHIJKLMNOPQRSTUWXYZ';
        return substr(str_shuffle($chars), 0, $num_caracteres);
    }

    //Gerando código de compra
    public static function generate_purchase_code(){
       // gerar um código de encomenda
       $code = "";
       $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZABCDEFGHIJKLMNOPQRSTUVWXYZABCDEFGHIJKLMNOPQRSTUVWXYZ";
       $code .= substr(str_shuffle($chars),0,4);
       $code .= rand(1000000,99999999);
       return $code;
    }

    //Verificar se existe cliente logado
    public static function logged(){
        // verifica se existe um cliente com sessao
        return isset($_SESSION['client']);
    }

    //Metodo de depuração
    public static function printData($data){
        if(is_array($data) || is_object($data)){
            echo '<pre>';
            print_r($data);
        }else{
            echo '<pre>';
            echo($data);
        }
        die("Terminado");
    }
}