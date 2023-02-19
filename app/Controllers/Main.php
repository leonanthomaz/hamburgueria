<?php

namespace App\Controllers;

use App\Models\Product;
use App\Models\Store;

class Main {

    // *** Páginas ****

    public function maintenance(){
        
        Store::Layout([
            'layouts/html_header',
            'maintenance',
            'layouts/html_footer'
        ]);
    }
    
    public function index(){

        $p = new Product;
        $products = $p->productListAvailable();

        // Store::printData($produtos);
    
        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'home',
            'layouts/footer',
            'layouts/html_footer'
        ], ["products" => $products]);
    }

    public function login(){

        // verifica se já existe um utilizador logado
        if (Store::logged()) {
            Store::redirect();
            return;
        }

        // apresentação do formulário de login
        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'login',
            'layouts/footer',
            'layouts/html_footer',
        ]);
    }

    public function register(){
        
        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'register',
            'layouts/footer',
            'layouts/html_footer'
        ]);
    }

}
