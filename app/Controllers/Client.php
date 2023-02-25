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
        unset($_SESSION['google_token']);
        
        unset($_SESSION['oauth2state']);
        unset($_SESSION['facebook_token']);

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

        
        if(!$_POST['c_nome'] || !$_POST['c_email'] || !$_POST['c_senha'] || !$_POST['c_confirma_senha']){
            $_SESSION['erro'] = 'Preencha todos os campos!';
            Store::redirect("register");
            return;
        }

        function isValidPassword() {
            $pattern = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{6,12}$/';
            // $pattern = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[$*&@#])[0-9a-zA-Z$*&@#]{8,}$/';
            return preg_match($pattern, $_POST['c_senha']) ? true : false;
        }

        if ($_POST['c_senha'] !== $_POST['c_confirma_senha']) {
            $_SESSION['erro'] = 'As senhas não estão iguais.';
            Store::redirect("register");
            return;
        }

        if(!isValidPassword()){
            $_SESSION['erro'] = '
            <p>A senha precisa ser composta por 6 a 12 caracteres e pelo ao menos uma letra maúscula, uma minúscula e um número!</p>
            ';
            Store::redirect("register");
            return;
        }

        if(!filter_input(INPUT_POST, "c_email", FILTER_VALIDATE_EMAIL)){
            $_SESSION['erro'] = 'Conta de email inválida. Verifique e tente novamente.';
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

        $email = $_POST['c_email'];
        $c = new MC;
        $purl = $c->register_validate();
        
        if(!$purl){
            $_SESSION['erro'] = 'Falha ao completar cadastro. Tente novamente!';
            Store::redirect("register");            
            return; 
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
            $_SESSION['erro'] = 'Falha na requisição. Tente novamente mais tarde.';
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
            }

            Store::redirect();        }
    }

    public function login_google_submit()
    {
        if(!isset($_POST['credential']) || !isset($_POST['g_csrf_token'])){
            $_SESSION['erro'] = 'Erro ao validar seu login com Google.!';
            Store::redirect("login");
            return;
        }
            
        $cookie = $_COOKIE['g_csrf_token'] ?? "";
            
        if($_POST['g_csrf_token'] != $cookie){
            $_SESSION['erro'] = 'Erro ao validar seu login com Google.!';
            Store::redirect("login");
            return;
        }

        $id_token = $_POST['credential'];
        $client = new \Google\Client(['client_id' => GOOGLE_CLIENT_ID]);  // Specify the CLIENT_ID of the app that accesses the backend
        $httpClient = new \GuzzleHttp\Client([
            'base_uri' => 'http://localhost',
            'verify' => false
        ]);
        
        $client->setHttpClient($httpClient);
        $jwt = new \Firebase\JWT\JWT; //Allow for discrepancies between server and auth times
        $jwt::$leeway = 100;
        $payload = $client->verifyIdToken($id_token);

        // Store::printData($payload);

        if(!isset($payload)){
            $_SESSION['erro'] = 'Erro ao processar cliente!';
            Store::redirect("login");
            return;
        }

        // verifica na base de dados se existe cliente com mesmo email
        $c = new MC;

        $client = $c->db_verify_email($payload['email']);

        if($client){
            $client = $c->search_client($payload['email']);

            $_SESSION['client'] =  $client->c_id;
            $_SESSION['name'] =  $client->c_nome;
            $_SESSION['email'] = $client->c_email;
            $_SESSION['google_token'] = $client->c_id_google;

            Store::redirect();
        }else{
            // Use these details to create a new profile
            $_SESSION['name'] = $payload['name'];
            $_SESSION['email'] = $payload['email'];
            $_SESSION['google_token'] = $payload['sub'];

            $c->insert_client_google();
            $client = $c->search_client($payload['email']);

            $_SESSION['client'] =  $client->c_id;
            $_SESSION['name'] =  $client->c_nome;
            $_SESSION['email'] = $client->c_email;
            $_SESSION['google_token'] = $client->c_id_google;

            Store::redirect();
        }

        // redirecionar para o local correto
        if(isset($_SESSION['tmp_cart'])){
            // remove a variável temporária da sessão
            unset($_SESSION['tmp_cart']);
            // redireciona para resumo da encomenda
            Store::redirect('checkout');
        }

    }

    public function login_facebook_submit()
    {
        
        $provider = new \League\OAuth2\Client\Provider\Facebook([
            'clientId' => FACEBOOK_LOGIN['FB_ID'],
            'clientSecret'      => FACEBOOK_LOGIN['FB_SECRET'],
            'redirectUri'       => FACEBOOK_LOGIN['FB_REDIRECT'],
            'graphApiVersion'   => FACEBOOK_LOGIN['FB_VERSION'],
        ]);
        
        $httpClient = new \GuzzleHttp\Client([
            'base_uri' => 'http://localhost/sistema/hamburgueria/?a=index',
            'verify' => false
        ]);
        $provider->setHttpClient($httpClient);
        
        if (!isset($_GET['code'])) {
        
            // If we don't have an authorization code then get one
            $authUrl = $provider->getAuthorizationUrl([
                'scope' => ['email'],
            ]);

            $_SESSION['oauth2state'] = $provider->getState();

            echo '<a href="'.$authUrl.'">Log in with Facebook!</a>';
            exit;
        
            // Check given state against previously stored one to mitigate CSRF attack
        }else if (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {
        
            unset($_SESSION['oauth2state']);
            echo 'Estado inválido!';
            exit;
        
        }
        
        // Try to get an access token (using the authorization code grant)
        $token = $provider->getAccessToken('authorization_code', [
            'code' => $_GET['code']
        ]);
        
        // Optional: Now you have a token you can look up a users profile data
        try {
        
            // We got an access token, let's now get the user's details
            $user = $provider->getResourceOwner($token);

            $c = new MC;
            $client = $c->db_verify_email($user->getEmail());

            if($client){
                $client = $c->search_client($user->getEmail());

                $_SESSION['client'] =  $client->c_id;
                $_SESSION['name'] =  $client->c_nome;
                $_SESSION['email'] = $client->c_email;
                $_SESSION['facebook_token'] = $client->c_id_facebook;

                Store::redirect();
            }else{
                // Use these details to create a new profile
                $_SESSION['name'] = $user->getName();
                $_SESSION['email'] = $user->getEmail();
                $_SESSION['facebook_token'] = $user->getId();

                $c->insert_client_facebook();
                $client = $c->search_client($user->getEmail());

                $_SESSION['client'] =  $client->c_id;
                $_SESSION['name'] =  $client->c_nome;
                $_SESSION['email'] = $client->c_email;
                $_SESSION['facebook_token'] = $client->c_id_facebook;
                
                Store::redirect();

            }

            // redirecionar para o local correto
            if(isset($_SESSION['tmp_cart'])){
                // remove a variável temporária da sessão
                unset($_SESSION['tmp_cart']);
                // redireciona para resumo da encomenda
                Store::redirect('checkout');
            }

            Store::redirect();
         
        } catch (\Exception $e) {
            // Failed to get user details
            exit($e->getMessage());
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