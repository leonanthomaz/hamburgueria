<?php

namespace App\Controllers;

use App\Models\Product;
use App\Models\Store;

class Cart {

    public function cart(){
        
        if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
            $data = [
                'cart' => null
            ];
        }else{

            $ids = [];
            foreach ($_SESSION['cart'] as $p_id => $qtd) {
                array_push($ids, $p_id);
            }

            $ids = implode(",", $ids);
            $p = new Product;
            $results = $p->productsById($ids);

            $data_temp = [];

            foreach($_SESSION['cart'] as $p_id => $qtd_cart){

                // imagem do produto
                foreach ($results as $product) {

                    if ($product->p_id == $p_id) {

                        $p_id = $product->p_id;
                        $p_nome = $product->p_nome;
                        $p_imagem = $product->p_imagem;
                        $qtd = $qtd_cart;
                        $subtotal = $product->p_preco * $qtd;

                        // colocar o produto na coleção
                        array_push($data_temp, [
                            'p_id' => $p_id,
                            'p_nome' => $p_nome,
                            'p_imagem' => $p_imagem,
                            'qtd' => $qtd,
                            'p_preco' => $product->p_preco,
                            'subtotal' => $subtotal
                        ]);

                        break;
                    }
                }
            }

            // calcular o total
            $total = 0;
            foreach ($data_temp as $item) {
                $total += $item['subtotal'];
            }
            
            array_push($data_temp, $total);

            // colocar o preço total na sessao
            $_SESSION['total'] = $total;

            $data = [
                'cart' => $data_temp            
            ];
        }

        // Store::printData($data);

        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'cart',
            'layouts/footer',
            'layouts/html_footer'
        ], $data);

        
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