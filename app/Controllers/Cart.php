<?php

namespace App\Controllers;

use App\Models\Product;
use App\Models\Store;

class Cart {

    public function add_cart(){

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

        $total = count($cart);

        echo $total;
    }

    public function minus_cart()
    {

        $id = $_GET['id'];
        $cart = $_SESSION['cart'];

        if(key_exists($id, $cart)){
            $cart[$id]--;
        }

        if($cart[$id] === 0){
            unset($cart[$id]);
        }

        $_SESSION['cart'] = $cart;
        
        $total = count($cart);

        echo $total;

        Store::redirect("cart");
    }

    public function plus_cart()
    {

        $id = $_GET['id'];
        $cart = $_SESSION['cart'];

        if(key_exists($id, $cart)){
            $cart[$id]++;
        }

        $_SESSION['cart'] = $cart;
        
        $total = count($cart);

        echo $total;

        Store::redirect("cart");
    }

    public function delete_cart()
    {

        // limpa o carrinho de todos os produtos
        unset($_SESSION['cart']);
        unset($_SESSION['total']);
        // refrescar a página do carrinho
        Store::redirect("cart");
    }

    public function checkout_cart()
    {
        // Store::printData($_SESSION['client']);
        // verifica se existe cliente logado
        if (!isset($_SESSION['client'])) {

            // coloca na sessão um referrer temporário
            $_SESSION['tmp_cart'] = true;

            // redirecionar para o quadro de login
            Store::redirect('login');
        } else {
            Store::redirect('checkout');
        }
    }
    
}