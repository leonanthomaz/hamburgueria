<?php

namespace App\Controllers;

use App\Models\Client as MC;
use App\Factorys\Store;
use App\Factorys\Email;


class Client {

    // *** Logout ****

    public function logout(){

        // remove as variáveis da sessão
        unset($_SESSION['client']);
        unset($_SESSION['email']);
        unset($_SESSION['name']);
        unset($_SESSION['discount_coupon']);

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
        || $_POST['c_email']  
        || $_POST['c_senha'] 
        || $_POST['c_confirmar_senha']
        )){

            $_SESSION['erro'] = 'Campos vazios';
            Store::redirect("register");
            return;
        }

        if ($_POST['c_senha'] !== $_POST['c_confirma_senha']) {

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

        if(!filter_input(INPUT_POST, "c_email", FILTER_VALIDATE_EMAIL)){
            $_SESSION['erro'] = 'Conta de email inválida. Verifique e tente novamente.';
            Store::redirect("register");            
            return;
        }else{
            $email = filter_input(INPUT_POST, "c_email", FILTER_VALIDATE_EMAIL);
            $c = new MC;
            $purl = $c->register_validate();
        }
        

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

    //Login com o Google
    public function login_google(){

        // if(!isset($_POST['credential']) || !isset($_POST['g_csrf_token'])){
        //     $_SESSION['erro'] = 'Credenciais nao encontradas...';
        //     Store::redirect();
        //     return;
        // }
          
        // $cookie = $_COOKIE['g_csrf_token'] ?? "";
          
        // if($_POST['g_csrf_token'] != $cookie){
        //     $_SESSION['erro'] = 'Credenciais nao encontradas...';
        //     Store::redirect();
        //     return;
        // }


        // $id_token = $_POST['credential'];
        // $client = new \Google\Client(['client_id' => GOOGLE_CLIENT_ID]);  // Specify the CLIENT_ID of the app that accesses the backend
        // $httpClient = new \GuzzleHttp\Client([
        //     'base_uri' => 'http://localhost',
        //     'verify' => false
        // ]);
        // $client->setHttpClient($httpClient);
        
        // $payload = $client->verifyIdToken($id_token);

        // if(isset($payload)){
        //     Store::Layout([
        //         'layouts/html_header',
        //         'layouts/header',
        //         'profile',
        //         'layouts/footer',
        //         'layouts/html_footer',
        //     ], [ "payload" => $payload]);
        // }else{
        //     $_SESSION['erro'] = 'Credenciais jamais encontradas...';
        //     Store::redirect();
        //     return;
        // }

    }

    // public function login_facebook()
    // {

    // }

    //Página de perfil do usuário
    public function login_google_validate(){

        if(!isset($_POST['credential']) || !isset($_POST['g_csrf_token'])){
            $_SESSION['erro'] = 'Credenciais nao encontradas...';
            Store::redirect();
            return;
        }else{
            $_SESSION['client_google_token'] = $_POST['credential'];
            Store::redirect();
        }
            
        $cookie = $_COOKIE['g_csrf_token'] ?? "";
            
        if($_POST['g_csrf_token'] != $cookie){
            $_SESSION['erro'] = 'Credenciais nao encontradas...';
            Store::redirect();
            return;
        }else{
            $_SESSION['client_google_cookie'] = $cookie;
            Store::redirect();
        }

    }

}