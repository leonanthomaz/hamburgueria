<?php

namespace App\Models;

use App\Models\Connect;

class Product {

    public function listar_produtos()
    {
        $banco = new Connect;
        $produtos = $banco->select("SELECT * FROM produtos");
        return $produtos;
    }

    public function listar_produtos_disponiveis()
    {
        $banco = new Connect;
        $produtos = $banco->select("SELECT * FROM produtos WHERE p_disponivel = '1'");
        return $produtos;
    }
}