<?php

namespace App\Controllers;

use App\Models\Product;
use App\Factorys\Store;
use App\Models\Cart as ModelsCart;
use App\Models\Client;
use App\Models\Connect;

class Cart {

    //Adicionar ao Carrinho
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

    //Diminuir quantidade de item do Carrinho
    public function minus_cart()
    {

        $id = $_GET['id'];
        $cart = $_SESSION['cart'];

        if(key_exists($id, $cart)){
            $cart[$id]--;
        }

        if($cart[$id] === 0){
            $cart[$id] = 1;
        }

        $_SESSION['cart'] = $cart;
        
        $total = $cart[$id];

        echo $total;
    }

    //Acrescentar quantidade de item do Carrinho
    public function plus_cart()
    {

        $id = $_GET['id'];
        $cart = $_SESSION['cart'];

        if(key_exists($id, $cart)){
            $cart[$id]++;
        }

        $_SESSION['cart'] = $cart;
        
        $total = $cart[$id];

        echo $total;
    }

    //Deletar item do Carrinho
    public function delete_item_cart()
    {

        $id = $_GET['id'];
        $cart = $_SESSION['cart'];

        // Store::printData($cart);

        if(key_exists($id, $cart)){
            unset($cart[$id]);
            unset($_SESSION['total']);
        }

        $_SESSION['cart'] = $cart;
        
    }

    //Deletar todos os itens do Carrinho
    public function delete_cart()
    {

        // limpa o carrinho de todos os produtos
        unset($_SESSION['cart']);
        unset($_SESSION['total']);
        // refrescar a página do carrinho
        Store::redirect("cart");
    }

    //Validação para rota do checkout. Bloqueio para usuário deslogado.
    public function checkout_cart()
    {

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

    //Pegar total do carrinho
    public function get_subtotal()
    {
        $ids = [];
        $cart = $_SESSION['cart'];
        foreach ($cart as $product_id => $qtd) {
            array_push($ids, $product_id);
        }

        $ids = implode(",", $ids);
        $p = new Product;
        $results = $p->products_by_id($ids);

        $data_temp = [];

        foreach($cart as $product_id => $qtd_cart){

            // imagem do produto
            foreach ($results as $product_id_by_db) {

                if ($product_id_by_db->p_id == $product_id) {

                    $qtd = $qtd_cart;
                    $subtotal = $product_id_by_db->p_preco * $qtd;

                    // colocar o produto na coleção
                    array_push($data_temp, [
                        'subtotal' => $subtotal
                    ]);

                    break;
                }
            }
        }

        return $data_temp;    
    }

    //Pegar total do carrinho
    public function get_total()
    {
        $ids = [];
        $cart = $_SESSION['cart'];
        foreach ($cart as $product_id => $qtd) {
            array_push($ids, $product_id);
        }

        $ids = implode(",", $ids);
        $p = new Product;
        $results = $p->products_by_id($ids);

        $data_temp = [];

        foreach($cart as $product_id => $qtd_cart){

            // imagem do produto
            foreach ($results as $product_id_by_db) {

                if ($product_id_by_db->p_id == $product_id) {

                    $qtd = $qtd_cart;
                    $subtotal = $product_id_by_db->p_preco * $qtd;

                    // colocar o produto na coleção
                    array_push($data_temp, [
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
        $_SESSION['total'] = isset($_SESSION['discount_coupon']) ? $total - COUPON_PRICE : $total;
        // $_SESSION['total'] = $total;

        $data = [
            'total' => isset($_SESSION['discount_coupon']) ? $total - COUPON_PRICE : $total  
            // 'total' => $total                        
        ];

        echo json_encode($data);    
    }

    public function get_products_by_cart()
    {
        $ids = [];
        $cart = $_SESSION['cart'];
        foreach ($cart as $product_id => $qtd) {
            array_push($ids, $product_id);
        }

        $ids = implode(",", $ids);
        $p = new Product;
        $results = $p->products_by_id($ids);

        $data_temp = [];

        foreach($cart as $product_id => $qtd_cart){

            // imagem do produto
            foreach ($results as $product_id_by_db) {

                if ($product_id_by_db->p_id == $product_id) {

                    $product_id = $product_id_by_db->p_id;
                    $p_nome = $product_id_by_db->p_nome;
                    $p_imagem = $product_id_by_db->p_imagem;
                    $qtd = $qtd_cart;
                    $subtotal = $product_id_by_db->p_preco * $qtd;

                    // colocar o produto na coleção
                    array_push($data_temp, [
                        'p_id' => $product_id,
                        'p_nome' => $p_nome,
                        'p_imagem' => $p_imagem,
                        'qtd' => $qtd,
                        'p_preco' => $product_id_by_db->p_preco,
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
        $_SESSION['total'] = isset($_SESSION['discount_coupon']) ? $total - COUPON_PRICE : $total;
        // $_SESSION['total'] = $total;

        $data = [
            'cart' => $data_temp            
        ];

        return $data;
    }

    //Cupom de desconto
    public function coupon()
    {

        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            Store::redirect();
            return;
        }   

        $coupon = trim(strtoupper($_POST['coupon']));

        if($coupon !== CART_COUPON){
            $_SESSION['erro'] = 'Cupom inválido!';
            Store::redirect('cart');
            return;
        }

        $_SESSION['discount_coupon'] = $coupon;
        Store::redirect('cart');
    }

    public function send_order()
    {
        // verifica se existe cliente logado
        if(!isset($_SESSION['client'])){
            Store::redirect();
        }

        $c = new Client;
        $client = $c->update_client();
        
        if(!$client){
            $_SESSION['erro'] = 'Erro ao processar seu pedido. Tente novamente!';
            Store::redirect("cart");
            return;
        }

        $cart = [];
        foreach($_SESSION['cart'] as $key => $qtd){
            
            array_push($cart, [
                "pdp_id_cliente" => $_SESSION['client'],
                "pdp_id_produto" => $key,
                "pdp_qtd" => $qtd,
                "pdp_codigo" => $_SESSION['purchase_code'],
            ]);
        }
        $order['cart'] = $cart;

        $info = [];
        array_push($info, [
            "pd_id_cliente" => $_SESSION['client'],
            "pd_codigo" => $_SESSION['purchase_code'],
            "pd_cupom" => isset($_SESSION['discount_coupon']) ? $_SESSION['discount_coupon'] : NULL,
            "pd_observacao" => $_POST['observacao'],
            "pd_status" => 1,
            "pd_pagamento" => $_POST['pagamento'],
        ]);

        $order['info'] = $info;
        $client = $c->search_client($_SESSION['email']);
        $order['client'] = $client;

        $ct = new ModelsCart;
        $result = $ct->inset_order($order['cart'], $order['info']);

        if(!$result){
            $_SESSION['erro'] = 'Erro ao processar seu pedido. Tente novamente!';
            Store::redirect("cart");
            return;
        }else{

            unset($_SESSION['cart']);
            unset($_SESSION['purchase_code']);
            unset($_SESSION['discount_coupon']);
            unset($_SESSION['total']);
            
            Store::Layout([
                'layouts/html_header',
                'layouts/header',
                'success_new_order',
                'layouts/footer',
                'layouts/html_footer'
            ], $order);

        }
    }
}