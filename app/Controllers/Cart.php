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
            $cart[$id] = 1;
        }

        $_SESSION['cart'] = $cart;
        
        $total = $cart[$id];

        echo $total;
    }

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

    public function delete_item_cart()
    {

        $id = $_GET['id'];
        $cart = $_SESSION['cart'];

        // Store::printData($cart);

        if(key_exists($id, $cart)){
            unset($cart[$id]);
        }

        $_SESSION['cart'] = $cart;
        
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

    public function get_total()
    {
        if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
            $data = [
                'total' => null
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

                        $qtd = $qtd_cart;
                        $subtotal = $product->p_preco * $qtd;
                        
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

            $data = [
                'total' => $total            
            ];
        }

        echo json_encode($data);    
    }

    public function coupon(){

        if($_POST['coupon'] !== CART_COUPON){
            $_SESSION['erro'] = 'Cupom inválido!';
            Store::redirect('cart');
            return;
        }else{
            $_SESSION['discount_coupon'] = $_POST['coupon'];
            Store::redirect('cart');
        }
        
        // return $result;
        // Store::printData($_POST['coupon']);
    }
}