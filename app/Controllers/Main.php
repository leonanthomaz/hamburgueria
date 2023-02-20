<?php

namespace App\Controllers;

use App\Models\Client;
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
        $products = $p->product_list_available();

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
        
        // verifica se já existe um utilizador logado
        if (Store::logged()) {
            Store::redirect();
            return;
        }
        
        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'register',
            'layouts/footer',
            'layouts/html_footer'
        ]);
    }

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
            $results = $p->products_by_id($ids);

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

    public function checkout(){

        // verifica se existe cliente logado
        if(!isset($_SESSION['client'])){
            Store::redirect();
        }

        // verifica se pode avançar para a gravação da encomenda
        if(!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0){
            Store::redirect();
            return;
        }

        // -------------------------------------------------------
        // informações do carrinho
        $ids = [];
        foreach ($_SESSION['cart'] as $p_id => $qtd) {
            array_push($ids, $p_id);
        }

        $ids = implode(",", $ids);
        $p = new Product;
        $results = $p->products_by_id($ids);

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

        // preparar os dados da view
        $data = [];
        $data['cart'] = $data_temp;

        // -------------------------------------------------------
        // buscar informações do cliente
        $c = new Client();
        $data_c = $c->search_client($_SESSION['client']);
        $data['client'] = $data_c;

        // -------------------------------------------------------
        // gerar o código da encomenda
        if(!isset($_SESSION['purchase_code'])){
            $purchase_code = Store::generate_purchase_code();
            $_SESSION['purchase_code'] = $purchase_code;
        }

        // apresenta a página do carrinho
        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'checkout',
            'layouts/footer',
            'layouts/html_footer',
        ], $data);

    }
}
