<?php

namespace App\Factorys;

class Pix {

    public function generate_pix($order)
    {

        date_default_timezone_set('America/Sao_Paulo');
        $today = date('Y-m-d\TH:i:s.vP');

        $endpoint = PAGSEGURO_ENDPOINT;
        $token = PAGSEGURO_TOKEN;

        foreach($order['info'] as $infoData){
            $body = [
                "reference_id"=> $infoData["pd_codigo"],
                "customer"=> [
                    "name"=> $order['client']->c_nome,
                    "email"=> $order['client']->c_email,
                    "tax_id"=> "12345678909",
                    "phones"=> [
                        [
                            "country"=> "55",
                            "area"=> "11",
                            "number"=> $order['client']->c_telefone,
                            "type"=> "MOBILE"
                        ]
                    ]
                ],
                "items"=> [
                    [
                        "name"=> $infoData["pd_codigo"],
                        "quantity"=> 1,
                        "unit_amount"=> $infoData["pd_total"]
                    ]
                ],
                "qr_codes"=> [
                    [
                        "amount"=> [
                            "value"=> $infoData["pd_total"]
                        ],
                        "expiration_date"=> date('Y-m-d\TH:i:s.vP', strtotime($today. '+ 3 days')),
                    ]
                ],
                "shipping"=> [
                    "address"=> [
                        "street"=> $order['client']->c_logradouro,
                        "number"=> $order['client']->c_numero,
                        "complement"=> "",
                        "locality"=> $order['client']->c_bairro,
                        "city"=> "Rio de Janeiro",
                        "region_code"=> "RJ",
                        "country"=> "BRA",
                        "postal_code"=> $order['client']->c_cep,
                    ]
                ],
                "notification_urls"=> [
                    "https://meusite.com/notificacoes"
                ]
            ];
        }




        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $endpoint);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($body));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        // curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, TRUE);
        // curl_setopt($curl, CURLOPT_CAINFO, "/path/to/cacert.pem");
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer '. $token
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);
        
        curl_close($curl);

        echo "<pre>";
        var_dump($response);

        echo "<pre>";
        var_dump($body);

        Store::printData($response);


        if($error){
           return false;
        }else{
            $_SESSION['generate_pix'] = $response;
        }
    }
}