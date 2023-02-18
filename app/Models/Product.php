<?php

namespace App\Models;

use App\Models\Connect;

class Product {

    public function productList()
    {
        $database = new Connect;
        $products = $database->select("SELECT * FROM produtos");
        return $products;
    }

    public function productListAvailable()
    {
        $database = new Connect;
        $products = $database->select("SELECT * FROM produtos WHERE p_disponivel = '1'");
        return $products;
    }
}