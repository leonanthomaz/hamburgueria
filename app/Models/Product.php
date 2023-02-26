<?php

namespace App\Models;

use App\Models\Connect;

class Product {

    //Listar todos os produtos
    public function product_list()
    {
        $database = new Connect;
        $products = $database->select("SELECT * FROM produtos");
        return $products;
    }

    //Listar produtos disponiveis
    public function product_list_available()
    {
        $database = new Connect;
        $products = $database->select("SELECT * FROM produtos WHERE p_disponivel = '1'");
        return $products;
    }

    //Listar produtos por Ids
    public function products_by_id($ids)
    {
        $database = new Connect;
        $products = $database->select("SELECT * FROM produtos WHERE p_id IN ($ids)");
        return $products;
    }

    //Listar produtos por categoria
    public function products_by_category($ct)
    {
        $database = new Connect;
        $products = $database->select("SELECT * FROM produtos WHERE p_categoria = '$ct'");
        return $products;
    }

    //Listar produtos por destaque
    public function product_by_top()
    {
        $database = new Connect;
        $products = $database->select("SELECT * FROM produtos WHERE p_destaque = '1'");
        return $products;
    }

}