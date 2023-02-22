<?php

// public function register_submit(){

//     if (Store::logged()) {
//         Store::redirect();
//         return;
//     }

//     if ($_SERVER['REQUEST_METHOD'] != 'POST') {
//         Store::redirect();
//         return;
//     }     
    
//     if(empty($_POST['c_nome'] 
//                     || $_POST['c_nome'] 
//                     || $_POST['c_email'] 
//                     || $_POST['c_telefone'] 
//                     || $_POST['c_cep']
//                     || $_POST['c_logradouro'] 
//                     || $_POST['c_bairro'] 
//                     || $_POST['c_senha'] 
//                     || $_POST['c_confirmar_senha']
//                     )){

//         $_SESSION['erro'] = 'Campos vazios';
//         Store::redirect("register");
//         return;
//     }

//     if ($_POST['c_senha'] !== $_POST['c_confirmar_senha']) {

//         $_SESSION['erro'] = 'As senhas não estão iguais.';
//         Store::redirect("register");
//         return;
//     }

    
//     // verifica na base de dados se existe cliente com mesmo email
//     $c = new MC;
//     if ($c->db_verify_email($_POST['c_email'])) {

//         $_SESSION['erro'] = 'Já existe um cliente com o mesmo email.';
//         Store::redirect("register");            
//         return;
//     }

//     // inserir novo cliente na base de dados e devolver o purl
//     $email = strtolower(trim($_POST['c_email']));
//     $c = new MC;
//     $purl = $c->register_validate();

//     // envio do email para o cliente
//     $e = new Email();
//     $results = $e->confirmation_email_new_client($email, $purl);

//     if ($results) {

//         // apresenta o layout para informar o envio do email
//         Store::Layout([
//             'layouts/html_header',
//             'layouts/header',
//             'success_new_client',
//             'layouts/footer',
//             'layouts/html_footer',
//         ]);
//         return;
//     } else {
//         echo 'Aconteceu um erro';
//     }
// }

// public function register_validate(){

//     // regista o novo cliente na base de dados
//     $db = new Connect();

//     // cria uma hash para o registo do cliente
//     $purl = Store::criarHash();

//     // parametros
//     $params = [
//         ':c_nome' => trim($_POST['c_nome']),
//         ':c_email' => strtolower(trim($_POST['c_email'])),
//         ':c_telefone' => trim($_POST['c_telefone']),
//         ':c_senha' => password_hash(trim($_POST['c_senha']), PASSWORD_DEFAULT),
//         ':c_cep' => trim($_POST['c_cep']),
//         ':c_logradouro' => trim($_POST['c_logradouro']),
//         ':c_bairro' => trim($_POST['c_bairro']),
//         ':c_purl' => $purl,
//         ':c_ativo' => 0,

//     ];

//     $db->insert("INSERT INTO clientes VALUES(
//         NULL,
//         :c_nome,
//         :c_email,
//         :c_telefone,
//         :c_senha, 
//         :c_cep,
//         :c_logradouro,
//         :c_bairro, 
//         :c_purl,
//         :c_ativo,
//         NOW(),
//         NOW(),
//         NULL
//     )", $params);

//     // retorna o purl criado
//     return $purl;
// }
