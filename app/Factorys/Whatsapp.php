<?php

namespace App\Factorys;

class Whatsapp
{

public function whatsapp_send_msg($client, $codigo)
    {
        $params = array(
            'token' => WHATSAPP_API_TOKEN,
            'to' => $client->c_telefone,
            'body' => "Oi, ".$client->c_nome."! Sua compra realizada com sucesso! Segue o código da compra: '.$codigo.'."
        );
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.ultramsg.com/instance32974/messages/chat',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => http_build_query($params),
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded"
            ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
            return false;
        } 

        return $response;
    }
}
