<?php

namespace App\Controllers;

use App\Models\Client as MC;
use App\Models\Connect;
use App\Models\Product;
use App\Models\Store;

class Client {

    // *** Logout ****

    public function logout(){

        // remove as variáveis da sessão
        unset($_SESSION['client']);
        unset($_SESSION['email']);
        unset($_SESSION['name']);

        // redireciona para o início da loja
        Store::redirect();
    }

    //**** Register ***/
    //inserindo novo cliente
    public function register_submit(){

        if (Store::logged()) {
            Store::redirect();
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            Store::redirect();
            return;
        }     
        
        if(empty($_POST['c_nome'] 
                        || $_POST['c_nome'] 
                        || $_POST['c_email'] 
                        || $_POST['c_telefone'] 
                        || $_POST['c_cep']
                        || $_POST['c_logradouro'] 
                        || $_POST['c_bairro'] 
                        || $_POST['c_senha'] 
                        || $_POST['c_confirmar_senha']
                        )){

            $_SESSION['erro'] = 'Campos vazios';
            Store::redirect("register");
            return;
        }

        if ($_POST['c_senha'] !== $_POST['c_confirmar_senha']) {

            $_SESSION['erro'] = 'As senhas não estão iguais.';
            Store::redirect("register");
            return;
        }

        
        // verifica na base de dados se existe cliente com mesmo email
        $c = new MC;
        if ($c->db_verify_email($_POST['c_email'])) {

            $_SESSION['erro'] = 'Já existe um cliente com o mesmo email.';
            Store::redirect("register");            
            return;
        }

        // inserir novo cliente na base de dados e devolver o purl
        $email = strtolower(trim($_POST['c_email']));
        $c = new MC;
        $purl = $c->register_validate();

        // envio do email para o cliente
        $e = new Email();
        $results = $e->confirmation_email_new_client($email, $purl);

        if ($results) {

            // apresenta o layout para informar o envio do email
            Store::Layout([
                'layouts/html_header',
                'layouts/header',
                'success_new_client',
                'layouts/footer',
                'layouts/html_footer',
            ]);
            return;
        } else {
            echo 'Aconteceu um erro';
        }
    }

    //**** login ***/
    //Validar login
    public function login_submit()
    {
        if (Store::logged()) {
            Store::redirect();
            return;
        }

        // verifica se foi efetuado o post do formulário de login
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            Store::redirect();
            return;
        }

        // validar se os campos vieram corretamente preenchidos
        if (
            !isset($_POST['c_email']) ||
            !isset($_POST['c_senha']) ||
            !filter_var(trim($_POST['c_email']), FILTER_VALIDATE_EMAIL)
        ) {
            // erro de preenchimento do formulário
            $_SESSION['erro'] = 'Login inválido';
            Store::redirect('login');
            return;
        }

        if(empty($_POST['c_email']) || empty($_POST['c_senha'])){
            // erro de preenchimento do formulário
            $_SESSION['erro'] = 'Preencha todos os campos!';
            Store::redirect('login');
            return;
        }

        // prepara os dados para o model
        $email = trim(strtolower($_POST['c_email']));
        $senha = trim($_POST['c_senha']);

        // carrega o model e verifica se login é válido
        $c = new MC;
        $result = $c->login_validate($email, $senha);

        // analisa o resultado
        if(is_bool($result)){
         
            // login inválido
            $_SESSION['erro'] = 'Erro ao validar...';
            Store::redirect('login');
            return;

        } else {

            // login válido. Coloca os dados na sessão
            $_SESSION['client'] = $result->c_id;
            $_SESSION['email'] = $result->c_email;
            $_SESSION['name'] = $result->c_nome;

            // redirecionar para o local correto
            if(isset($_SESSION['tmp_cart'])){
                
                // remove a variável temporária da sessão
                unset($_SESSION['tmp_cart']);

                // redireciona para resumo da encomenda
                Store::redirect('checkout');

            } else {
                // redirectionamento para a loja
                Store::redirect();
            }
        }
    }

    //**** email ***/
    //Confirmar email por link
    public function email_link_confirm()
    {

        if (Store::logged()) {
            Store::redirect();
            return;
        }

        // verificar se existe na query string um purl
        if (!isset($_GET['purl'])) {
            Store::redirect();
            return;
        }

        $purl = $_GET['purl'];

        // verifica se o purl é válido
        if (strlen($purl) != 12) {
            Store::redirect();
            return;
        }

        $c = new MC;
        $result = $c->email_validate_purl($purl);

        if ($result) {

            // apresenta o layout para informar a conta foi confirmada com sucesso
            Store::Layout([
                'layouts/html_header',
                'layouts/header',
                'success_email_link_confirm',
                'layouts/footer',
                'layouts/html_footer',
            ]);
            return;
        } else {

            // redirecionar para a página inicial
            Store::redirect();
        }
    }









}