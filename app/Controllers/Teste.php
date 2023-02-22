<?php

namespace App\Controllers;

use App\Factorys\Store;

class Teste {

    public function teste()
    {
        //facebook
        // $provider = new \League\OAuth2\Client\Provider\Facebook([
        //     'clientId'          => '{facebook-app-id}',
        //     'clientSecret'      => '{facebook-app-secret}',
        //     'redirectUri'       => 'https://example.com/callback-url',
        //     'graphApiVersion'   => 'v2.10',
        // ]);

        
        

        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'teste',
            'layouts/footer',
            'layouts/html_footer',
        ]);
    }
}