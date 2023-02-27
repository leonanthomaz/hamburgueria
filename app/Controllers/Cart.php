<?php

namespace App\Controllers;

use App\Factorys\Email;
use App\Models\Product;
use App\Factorys\Store;
use App\Models\Cart as ModelsCart;
use App\Models\Client;
use App\Models\Connect;
use App\Factorys\Pix;
use App\Factorys\Whatsapp;

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

    //Pegar subtotal do itens carrinho
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

    //Pegar total geral do carrinho
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

    //Pega os id's dos produtos e verifica no banco para detalhes
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

    //Gerar pedido
    public function send_order()
    {

        //*****//

        // verifica se existe cliente logado
        if(!isset($_SESSION['client'])){
            Store::redirect("cart");
        }

        //*****//

        //*** ITENS DO CARRINHO POR ID E QTD **//
        $cart = [];
        foreach($_SESSION['cart'] as $key => $qtd){
            
            array_push($cart, [
                "pdp_id_cliente" => $_SESSION['client'],
                "pdp_id_produto" => $key,
                "pdp_qtd" => $qtd,
                "pdp_codigo" => $_SESSION['purchase_code'],
            ]);
        }
        $order['cart_order'] = $cart;

        //*****//

        //*** INFORMAÇÕES DA COMPRA **//
        $info = [];
        array_push($info, [
            "pd_id_cliente" => $_SESSION['client'],
            "pd_codigo" => $_SESSION['purchase_code'],
            "pd_total" => intval($_SESSION['total']),
            "pd_cupom" => isset($_SESSION['discount_coupon']) ? $_SESSION['discount_coupon'] : NULL,
            "pd_observacao" => $_POST['observacao'],
            "pd_status" => 1,
            "pd_pagamento" => $_POST['pagamento'],
        ]);
        $order['info'] = $info;
        // Store::printData($order['info']);

        //*****//

        //*** ATUALIZANDO CLIENTE NA BASE DE DADOS **//
        $c = new Client;
        $client = $c->update_client();
        
        if(!$client){
            $_SESSION['erro'] = 'Erro ao processar seu pedido. Tente novamente!';
            Store::redirect("checkout");
            return;
        }
        
        //*** PUXANDO INFORMAÇÕES DO CLIENTE ATUALIZADAS **//
        $client = $c->search_client($_SESSION['email']);
        $order['client'] = $client;

        //*****//

        //*** INSERINDO O PEDIDO NO BANCO **//
        $ct = new ModelsCart;
        $result = $ct->order_submit($order['cart_order'], $order['info']);

        if(!$result){
            $_SESSION['erro'] = 'Erro ao processar seu pedido. Tente novamente!';
            return;
        }else{

            //*** SE O PEDIDO FOR EM PIX, GERAR O QRCODE **//
            if($_POST['pagamento'] == "pix"){
                $pix = new Pix();
                $response = $pix->generate_pix($order['client'], $order['info']);

                // Store::printData($response);
                // die("aqui");
                if(!$response){
                    $_SESSION['erro'] = 'Falha ao registrar o pix!';
                    Store::redirect("checkout");
                    return;
                }else{
                    $_SESSION['qrcode_pix'] = $response;
                }
            }

            // *** ENVIO DA COMPRA POR EMAIL **//
            $email = new Email;
            $confirm_email = $email->confirmation_email_new_order($_SESSION['email'], $order['info']);

            if(!$confirm_email){
                $_SESSION['erro'] = 'Falha ao enviar email de compra!';
                Store::redirect("checkout");
                return;
            }

            //*** PREPARANDO WHATSAPP PARA DISPARO COM INFORMAÇÕES DE COMPRA **//
            $whatsapp = new Whatsapp;
            $send_whatsapp = $whatsapp->whatsapp_send_msg($order['client'], $_SESSION['purchase_code']);

            if(!$send_whatsapp){
                $_SESSION['erro'] = 'Falha ao enviar dados da compra pelo whatsapp!';
                Store::redirect("checkout");
                return;
            }


            //*** LIMPANDO SEÇÕES **//
            // unset($_SESSION['qrcode_pix']);
            unset($_SESSION['cart']);
            unset($_SESSION['purchase_code']);
            unset($_SESSION['discount_coupon']);
            unset($_SESSION['total']);
            

            //*** FINALIZANDO NA PÁGINA DE CONFIRMAÇÃO DE PEDIDO **//
            Store::Layout([
                'layouts/html_header',
                'layouts/header',
                'success_new_order',
                'layouts/footer',
                'layouts/html_footer'
            ], $order);

        }
    }

    public function teste_cart()
    {
        $cart_itens = $this->get_products_by_cart();
        $cart = [];
        foreach($cart_itens["cart"] as $item){
            $pdp_id = $item["p_id"];
            $pdp_nome = $item["p_nome"];
            $pdp_imagem = $item["p_imagem"];
            $pdp_qtd = $item["qtd"];
            $pdp_subtotal = $item["subtotal"];

            array_push($cart, [
                "pdp_id" => $pdp_id,
                "pdp_nome" => $pdp_nome,
                "pdp_imagem" => $pdp_imagem,
                "pdp_qtd" => $pdp_qtd,
                "pdp_subtotal" => $pdp_subtotal,
            ]);
        }
        $order['cart_itens'] = $cart;
    }
}