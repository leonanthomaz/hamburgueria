<?php

namespace App\Controllers;

use App\Models\Connect;
use App\Models\Product;
use App\Models\Store;

class Client {

    // *** Páginas ****

    public function login(){

        // verifica se já existe um utilizador logado
        if ($this->logged()) {
            Store::redirect();
            return;
        }

        // apresentação do formulário de login
        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'login',
            'layouts/footer',
            'layouts/html_footer',
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

    // *** Metodos ****

    //Verificar se existe cliente logado
    public static function logged(){
        // verifica se existe um cliente com sessao
        return isset($_SESSION['logged']);
    }

    //inserindo novo cliente
    public function insert_client(){

        // die(print_r($_POST));

        if ($this->logged()) {
            Store::redirect("index");
            return;
        }


        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            Store::redirect("index");
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
        if ($this->verify_email($_POST['c_email'])) {

            $_SESSION['erro'] = 'Já existe um cliente com o mesmo email.';
            $this->register();
            return;
        }


        // inserir novo cliente na base de dados e devolver o purl
        $email = strtolower(trim($_POST['c_email']));
        $purl = $this->register_client();

        // envio do email para o cliente
        $e = new EnviarEmail();
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

    //Registrando cliente no banco
    public function register_client(){

        // regista o novo cliente na base de dados
        $db = new Connect();

        // cria uma hash para o registo do cliente
        $purl = Store::criarHash();

        // parametros
        $params = [
           ':c_nome' => trim($_POST['c_nome']),
           ':c_email' => strtolower(trim($_POST['c_email'])),
           ':c_telefone' => trim($_POST['c_telefone']),
           ':c_senha' => password_hash(trim($_POST['c_senha']), PASSWORD_BCRYPT),
           ':c_cep' => trim($_POST['c_cep']),
           ':c_logradouro' => trim($_POST['c_logradouro']),
           ':c_bairro' => trim($_POST['c_bairro']),
           ':c_purl' => $purl,
           ':c_ativo' => 0,

       ];

       $db->insert("INSERT INTO clientes VALUES(
            NULL,
            :c_nome,
            :c_email,
            :c_telefone,
            :c_senha, 
            :c_cep,
            :c_logradouro,
            :c_bairro, 
            :c_purl,
            :c_ativo,
            NOW(),
            NOW(),
            NULL
        )", $params);

       // retorna o purl criado
       return $purl;
    }

    //Confirmar email por link
    public function confirm_email()
    {

        if ($this->logged()) {
            Store::redirect("index");
            return;
        }

        // verificar se existe na query string um purl
        if (!isset($_GET['purl'])) {
            Store::redirect("index");
            return;
        }

        $purl = $_GET['purl'];

        // verifica se o purl é válido
        if (strlen($purl) != 12) {
            Store::redirect("index");
            return;
        }

        $cliente = new Client();
        $result = $cliente->validate_email($purl);

        if ($result) {

            // apresenta o layout para informar a conta foi confirmada com sucesso
            Store::Layout([
                'layouts/html_header',
                'layouts/header',
                'success_confirm_email',
                'layouts/footer',
                'layouts/html_footer',
            ]);
            return;
        } else {

            // redirecionar para a página inicial
            Store::redirect();
        }
    }

    //Verificar senha com o banco
    public function password_verify($c_id, $password){

        // verifica se a senha atual está correta (de acordo com o que está na base de dados)
        $params = [
            ':c_id' => $c_id            
        ];

        $db = new Connect();

        $password_db = $db->select("
            SELECT c_senha 
            FROM clientes 
            WHERE c_id = :c_id
        ", $params)[0]->c_senha;

        // verificar se a senha corresponde à senha atualmente na bd
        return password_verify($password, $password_db);
        
    }

    //Verificar email com o banco
    public function verify_email($email){

         // verifica se já existe outra conta com o mesmo email
         $bd = new Connect();
         $params = [
             ':c_email' => strtolower(trim($email))
         ];
         $results = $bd->select("
             SELECT c_email FROM clientes WHERE c_email = :c_email
         ", $params);
 
         // se o cliente já existe...
         if (count($results) != 0) {
             return true;
         } else {
             return false;
         }
    }

    //Validar email e resetar purl
    public function validate_email($purl)
    {

        // validar o email do novo cliente
        $db = new Connect();
        $params = [
            ':c_purl' => $purl
        ];

        $results = $db->select("SELECT * FROM clientes WHERE c_purl = :c_purl", $params);

        // verifica se foi encontrado o cliente
        if (count($results) != 1) {
            return false;
        }

        // foi encontrado este cliente com o purl indicado
        $client_id = $results[0]->c_id;

        // atualizar os dados do cliente
        $params = [
            ':c_id' => $client_id
        ];

        $db->update("UPDATE clientes SET c_purl = NULL, c_ativo = 1, c_updated_at = NOW() WHERE c_id = :c_id", $params);

        return true;
    }


    //Validar login
    public function login_submit()
    {
        if ($this->logged()) {
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
        $result = $this->validar_login($email, $senha);

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

    //Validar Login
    public function validar_login($email, $senha)
    {

        // verificar se o login é válido
        $params = [
            ':c_email' => $email
        ];

        $db = new Connect();
        $results = $db->select("SELECT * FROM clientes WHERE c_email = :c_email AND c_ativo = 1 AND c_deleted_at IS NULL", $params);
        // Store::printData($results[0]);

        if (count($results) != 1) {

            // não existe usuário
            return false;
        } else {
            // temos usuário. Vamos ver a sua password
            $usuario = $results[0];

            // die("Senha: ".$senha." Senha do banco: ".$usuario->c_senha);
            // verificar a password
            if (!password_verify($senha, $usuario->c_senha)) {

                // password inválida
                return false;
            } else {

                // login válido
                return $usuario;
            }
        }
    }

}