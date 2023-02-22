<?php

namespace App\Controllers;

use App\Factorys\Store;

class Teste {

    public function teste()
    {


        

        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'teste',
            'layouts/footer',
            'layouts/html_footer',
        ]);
    }
}