<?php

namespace App\Controllers;

use App\Models\Product;
use App\Models\Store;

class User {

    

    public static function cliente_logado(){
        // verifica se existe um cliente com sessao
        return isset($_SESSION['logged']);
    }

    // ===========================================================
    //pagina de login

    public function login(){

        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'login',
            'layouts/footer',
            'layouts/html_footer'
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

    // ===========================================================
    //Inserindo usuario

    public function insert_user(){

        // verifica se já existe sessão aberta
        if ($this->cliente_logado()) {
            Store::redirect("index");
            return;
        }

        // verifica se houve submissão de um formulário
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            Store::redirect("index");
            return;
        }

        // verifica se senha 1 = senha 2
        if ($_POST['senha'] !== $_POST['confirmar_senha']) {

            // as passwords são diferentes
            $_SESSION['erro'] = 'As senhas não estão iguais.';
            Store::redirect("register");
            return;
        }

        if(empty($_POST['nome'] || $_POST['email'])){

            $_SESSION['erro'] = 'Campos vazios';
            Store::redirect("register");
            return;
        }

        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'success_new_user',
            'layouts/footer',
            'layouts/html_footer'
        ]);

    }
}