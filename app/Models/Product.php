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

    public function products_by_id($ids)
    {
        $database = new Connect;
        $products = $database->select("SELECT * FROM produtos WHERE p_id IN ($ids)");
        return $products;
    }

    public function products_by_category($ct)
    {
        $database = new Connect;
        $products = $database->select("SELECT * FROM produtos WHERE p_categoria IN ($ct)");
        return $products;
    }
}