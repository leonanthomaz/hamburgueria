<?php

namespace App\Models;

use App\Models\Connect;

class Product {

    public function product_list()
    {
        $database = new Connect;
        $products = $database->select("SELECT * FROM produtos");
        return $products;
    }

    public function product_list_available()
    {
        $database = new Connect;
        $products = $database->select("SELECT * FROM produtos WHERE p_disponivel = '1'");
        return $products;
    }
}