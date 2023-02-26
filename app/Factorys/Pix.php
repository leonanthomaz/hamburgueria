<?php

namespace App\Factorys;

class Pix
{

    public function generate_pix($client, $info)
    {

        date_default_timezone_set('America/Sao_Paulo');
        $today = date('Y-m-d\TH:i:s.vP');

        $endpoint = PAGSEGURO_ENDPOINT;
        $token = PAGSEGURO_TOKEN;

        $body = [
            "reference_id" => $info[0]["pd_codigo"],
            "customer" => [
                "name" => $client->c_nome,
                "email" => $client->c_email,
                "tax_id" => "12345678909",
                "phones" => [
                    [
                        "country" => "55",
                        "area" => $client->c_telefone[0] . $client->c_telefone[1],
                        "number" => substr($client->c_telefone, 2),
                        "type" => "MOBILE"
                    ]
                ]
            ],
            "items" => [
                [
                    "name" => $info[0]["pd_codigo"],
                    "quantity" => 1,
                    "unit_amount" => $info[0]["pd_total"] * 1000
                ]
            ],
            "qr_codes" => [
                [
                    "amount" => [
                        "value" => $info[0]["pd_total"] * 1000
                    ],
                    "expiration_date" => date('Y-m-d\TH:i:s.vP', strtotime($today . '+ 3 days')),
                ]
            ],
            "shipping" => [
                "address" => [
                    "street" => $client->c_logradouro,
                    "number" => $client->c_numero,
                    "complement" => "apto 12",
                    "locality" => $client->c_bairro,
                    "city" => "Rio de Janeiro",
                    "region_code" => "RJ",
                    "country" => "BRA",
                    "postal_code" => $client->c_cep,
                ]
            ],
            "notification_urls" => [
                "https://meusite.com/notificacoes"
            ]
        ];

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
            'Authorization: Bearer ' . $token
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);

        $session = json_decode($response);

        if ($error) {
            return false;
        }

        return $session;
    }
}
