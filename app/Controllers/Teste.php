<?php

namespace App\Controllers;

use App\Factorys\Pix;
use App\Factorys\Store;

class Teste
{

    public function teste()
    {
        $pix = new Pix;
        $pix->get_order_pix();
    }
}
