<?php

namespace App\Controllers;

use App\Models\Client;
use App\Models\Product;
use App\Factorys\Store;

class Main
{

    // *** Páginas ****

    //Página de manutenção
    public function maintenance()
    {

        Store::Layout([
            'layouts/html_header',
            'maintenance',
            'layouts/html_footer'
        ]);
    }

    //Página Inicial
    public function index()
    {

        $p = new Product;
        $products = $p->product_list_available();

        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'home',
            'layouts/footer',
            'layouts/html_footer'
        ], ["products" => $products]);
    }

    //Página de Login
    public function login()
    {

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
            'layouts/html_footer',
        ]);
    }

    //Página de Registro
    public function register()
    {

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

    //Página do Carrinho
    public function cart()
    {

        if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
            $data = [
                'cart' => null
            ];
        } else {
            $cart = new Cart;
            $data = $cart->get_products_by_cart();
        }

        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'cart',
            'layouts/html_footer'
        ], $data);
    }

    //Página de Checkout
    public function checkout()
    {

        // verifica se existe cliente logado
        if (!isset($_SESSION['client'])) {
            Store::redirect();
            return;
        }

        // verifica se pode avançar para a gravação da encomenda
        if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
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

        foreach ($_SESSION['cart'] as $p_id => $qtd_cart) {

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

        // preparar os dados da view
        $data = [];
        $data['cart'] = $data_temp;

        // -------------------------------------------------------
        // buscar informações do cliente
        // -------------------------------------------------------
        $c = new Client();
        $data_c = $c->search_client($_SESSION['email']);
        $data['client'] =  $data_c;

        // -------------------------------------------------------
        // gerar o código da encomenda
        if (!isset($_SESSION['purchase_code'])) {
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

    //Página de listagem de todos os produtos
    public function products()
    {

        $id = 0;

        $p = new Product;
        $products = $p->products_by_category($id);


        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'products',
            'layouts/footer',
            'layouts/html_footer',
        ], ["products" => $products]);
    }
}
