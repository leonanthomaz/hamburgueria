<?php

//https://dev.pagseguro.uol.com.br/reference/create-qrcode-order

//

$data = json_decode($response);
echo "<pre>";
print_r($data->qr_codes[0]->links[0]);
echo "********";
?>

<img src="<?php echo $data->qr_codes[0]->links[0]->href ?>" alt="">

<?php foreach($response as $item): ?>
<?php endforeach; ?>

***************

<?php

namespace App\Controllers;

use App\Factorys\Store;

class Teste {

    public function teste()
    {

        $endpoint = PAGSEGURO_ENDPOINT;
        $token = PAGSEGURO_TOKEN;

        $body = [
            "reference_id"=> "ex-00001",
            "customer"=> [
                "name"=> "Jose da Silva",
                "email"=> "email@test.com",
                "tax_id"=> "12345678909",
                "phones"=> [
                    [
                        "country"=> "55",
                        "area"=> "11",
                        "number"=> "999999999",
                        "type"=> "MOBILE"
                    ]
                ]
            ],
            "items"=> [
                [
                    "name"=> "nome do item",
                    "quantity"=> 1,
                    "unit_amount"=> 500
                ]
            ],
            "qr_codes"=> [
                [
                    "amount"=> [
                        "value"=> 500
                    ],
                    "expiration_date"=> date('Y-m-d\TH:i:s.vP', strtotime("2023-02-29T20:15:59-03:00". '+ 3 days')),
                ]
            ],
            "shipping"=> [
                "address"=> [
                    "street"=> "Avenida Brigadeiro Faria Lima",
                    "number"=> "1384",
                    "complement"=> "apto 12",
                    "locality"=> "Pinheiros",
                    "city"=> "São Paulo",
                    "region_code"=> "SP",
                    "country"=> "BRA",
                    "postal_code"=> "01452002"
                ]
            ],
            "notification_urls"=> [
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
            'Authorization: Bearer '. $token
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);

        if($error){
            var_dump($error);
            die();
        }

        // var_dump(json_decode($response), true);
      
        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'teste',
            'layouts/footer',
            'layouts/html_footer'
        ], ["response" => $response]);

        // Store::printData($payload);
        
        
        //facebook
        // $provider = new \League\OAuth2\Client\Provider\Facebook([
        //     'clientId'          => '{facebook-app-id}',
        //     'clientSecret'      => '{facebook-app-secret}',
        //     'redirectUri'       => 'https://example.com/callback-url',
        //     'graphApiVersion'   => 'v2.10',
        // ]);
    }
}