<?php

namespace App\Controllers;

use App\Models\Product;
use App\Models\Store;

class Cart {

    public function cart(){
        

        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'cart',
            'layouts/footer',
            'layouts/html_footer'
        ]);
    }

    public function addCart(){

        $id = $_GET['id'];

        $cart = [];

        if(isset($_SESSION['cart'])){
            $cart = $_SESSION['cart'];
        }

        if(key_exists($id, $cart)){
            $cart[$id]++;
        }else{
            $cart[$id] = 1;
        }

        $_SESSION['cart'] = $cart;

        $total = 0;

        foreach($cart as $qtd){
            $total += $qtd;
        }

        echo $total;
        
    }
    
}