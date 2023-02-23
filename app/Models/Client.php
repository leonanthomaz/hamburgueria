<?php

namespace App\Models;

use App\Models\Connect;
use App\Factorys\Store;
use PDOException;

class Client {

    //Registrando cliente no banco
    public function register_validate(){

        // regista o novo cliente na base de dados
        $db = new Connect();

        // cria uma hash para o registo do cliente
        $purl = Store::criarHash();
        
        // parametros
        $params = [
            ':c_nome' => trim($_POST['c_nome']),
            ':c_email' => strtolower(trim($_POST['c_email'])),
            ':c_senha' => password_hash(trim($_POST['c_senha']), PASSWORD_DEFAULT),
            ':c_purl' => $purl,
            ':c_ativo' => 0,
            ':c_ofertas' => $_POST['c_ofertas'][0] === "sim" ? 1 : 0,
        ];

        $db->insert("INSERT INTO clientes VALUES(
            NULL,
            NULL,
            :c_nome,
            :c_email,
            NULL,
            :c_senha, 
            NULL,
            NULL,
            NULL, 
            :c_purl,
            :c_ativo,
            :c_ofertas,
            NOW(),
            NOW(),
            NULL
        )", $params);

        // retorna o purl criado
        return $purl;
    }
    
    //Validar Login
    public function login_validate($email, $senha)
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

            // verificar a password
            $consulta = $this->db_password_verify($usuario->c_id, $senha);
            
            // die(print_r($consulta));

            if (!$consulta){

                // password inválida
                return false;
            } else {

                // login válido
                return $usuario;
            }
        }
    }

    public function login_validate_google($email)
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
        }
    }

    //Verificar senha com o banco
    public function db_password_verify($c_id, $password)
    {

        // verifica se a senha atual está correta (de acordo com o que está na base de dados)
        $params = [
            ':c_id' => $c_id            
        ];

        $db = new Connect();

        $password_db = $db->select("SELECT c_senha 
            FROM clientes 
            WHERE c_id = :c_id
        ", $params)[0]->c_senha;

        // verificar se a senha corresponde à senha atualmente na bd
        return password_verify($password, $password_db);
        
    }

    //Verificar email com o banco
    public function db_verify_email($email)
    {

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
    public function email_validate_purl($purl)
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

    //Procurar cliente especifico no banco
    public function search_client($email_client)
    {

        $params = [
            ':c_email' => $email_client
        ];

        $db = new Connect();

        $results = $db->select("SELECT 
            c_id,
            c_nome,
            c_id_google,
            c_email,
            c_telefone,
            c_cep,
            c_logradouro,
            c_bairro 
            FROM clientes 
            WHERE c_email = :c_email
        ", $params);

        // Store::printData($results[0]);
        return $results[0];

    }

    public function update_client($id_client)
    {
        // atualiza o novo cliente na base de dados
        $db = new Connect();

        // parametros
        $params = [
            ':c_nome' => trim($_POST['c_nome']),
            ':c_email' => strtolower(trim($_POST['c_email'])),
            ':c_telefone' => trim($_POST['c_telefone']),
            ':c_cep' => trim($_POST['c_cep']),
            ':c_logradouro' => trim($_POST['c_logradouro']),
            ':c_bairro' => trim($_POST['c_bairro']),
        ];

        $db->update("UPDATE clientes SET 
        c_nome = :c_nome, 
        c_email = :c_email, 
        c_telefone = :c_telefone,
        c_cep = :c_cep,
        c_logradouro = :c_logradouro,
        c_bairro = :c_bairro,
        WHERE c_id = $id_client", $params);

        return true;

    }

    public function insert_client_google()
    {

        // regista o novo cliente na base de dados
        $db = new Connect();
        
        // parametros
        $params = [
            ':c_id_google' => intval($_SESSION['client']),
            ':c_nome' => $_SESSION['name'],
            ':c_email' => strtolower(trim($_SESSION['email'])),
            ':c_ativo' => 1,
            ':c_ofertas' => 1,
        ];

        $db->insert("INSERT INTO clientes VALUES(
            NULL,
            :c_id_google,
            :c_nome,
            :c_email,
            NULL,
            NULL,
            NULL,
            NULL,
            NULL,
            NULL,
            :c_ativo,
            :c_ofertas,
            NOW(),
            NOW(),
            NULL
        )", $params);
       
    }
    
}