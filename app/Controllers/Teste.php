<?php

namespace App\Controllers;

use App\Factorys\Store;
use League\OAuth2\Client\Provider\Facebook;

class Teste {

    public function teste()
    {

        //INICIANDO SESSÃO
        $url = "https://ws.sandbox.pagseguro.uol.com.br/v2/sessions?email=luzia.ts.rj@gmail.com&token=351E81DE328A4D59B2C1BE10C01E5222";

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        $error = curl_error($curl);
        curl_close($curl);
        // $data = json_encode($response);
        $session = simplexml_load_string($response);
        // echo $data;
        echo json_encode($session);

        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'teste',
            'layouts/footer',
            'layouts/html_footer'
        ]);

    }
}