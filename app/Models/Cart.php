<?php

namespace App\Models;

use App\Models\Product;
use App\Factorys\Store;

class Cart {


    public function order_submit($cart, $info)
    {
        // regista o novo cliente na base de dados
        $db = new Connect();

        foreach($cart as $item_cart){
            // parametros
            $params = [
                ':pdp_id_cliente' => intval($item_cart["pdp_id_cliente"]),
                ':pdp_id_produto' => intval($item_cart["pdp_id_produto"]),
                ':pdp_qtd' => intval($item_cart["pdp_qtd"]),
                ':pdp_codigo' => trim($item_cart["pdp_codigo"]),
            ];

            $db->insert("INSERT INTO pedidos_produtos VALUES(
                NULL,
                :pdp_id_cliente,
                :pdp_id_produto,
                :pdp_qtd,
                :pdp_codigo,
                NOW(),
                NOW(),
                NULL
            )", $params);
        }

        foreach($info as $item_info){
            $params = [
                ':pd_id_client' => intval($item_cart["pdp_id_cliente"]),
                ':pd_codigo' => trim($item_info["pd_codigo"]),
                ':pd_total' => trim($item_info["pd_total"]),
                ':pd_cupom' => $item_info["pd_cupom"],
                ':pd_observacao' => trim($item_info["pd_observacao"]),
                ':pd_status' => intval($item_info["pd_status"]),
                ':pd_pagamento' => trim($item_info["pd_pagamento"]),
            ];
            $db->insert("INSERT INTO pedidos VALUES(
                NULL,
                :pd_id_client,
                :pd_codigo,
                :pd_total,
                :pd_cupom,
                :pd_observacao,
                :pd_status,
                :pd_pagamento,
                NOW(),
                NOW(),
                NULL
            )", $params);
        }

        return true;

    }

    public function verify_purchase_code($code)
    {
        $db = new Connect;
        $params = [
            ':pd_codigo' => $code,
        ];
        $code_verify = $db->select("SELECT pd_codigo FROM pedidos WHERE pd_codigo = ':pd_codigo", $params);

        if(count($code_verify) != 0){
            return false;
        }

    }
}
