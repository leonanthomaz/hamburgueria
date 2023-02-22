<?php

namespace App\Models;

use Exception;
use PDO;
use PDOException;

class Connect {

    private $conn;

    //Conexão
    public function connect()
    {
        $this->conn = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_NAME.";charset=".DB_CHARSET, DB_USER, DB_PASS, array(PDO::ATTR_PERSISTENT => true));
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    //Desconecta
    public function disconnect()
    {
        $this->conn = null;
    }

    //Instrução Select
    public function select($sql, $param = null)
    {

        $sql = trim($sql);

        if(!preg_match('/^SELECT/i', $sql)){
            throw new Exception('Não é uma instrução SELECT');
        }

        $this->connect();

        $results = null;

        try{
            if(!empty($param)){
                $stmt = $this->conn->prepare($sql);
                $stmt->execute($param);
                $results =  $stmt->fetchAll(PDO::FETCH_CLASS);
            }else{
                $stmt = $this->conn->prepare($sql);
                $stmt->execute();
                $results =  $stmt->fetchAll(PDO::FETCH_CLASS);
            }

        }catch(PDOException $e){
            return false;
        }

        $this->disconnect();

        return $results;
    }

    //Instrução Insert
    public function insert($sql, $param = null)
    {
        $sql = trim($sql);

        if(!preg_match('/^INSERT/i', $sql)){
            throw new Exception('Não é uma instrução INSERT');
            //die('Não é uma instrução SELECT');

        }

        $this->connect();

        try{
            if(!empty($param)){
                $stmt = $this->conn->prepare($sql);
                $stmt->execute($param);
            }else{
                $stmt = $this->conn->prepare($sql);
                $stmt->execute();
            }

        }catch(PDOException $e){
            return false;
        }

        $this->disconnect();
    }

    //Instrução Update
    public function update($sql, $param = null)
    {

        $sql = trim($sql);

        if(!preg_match('/^UPDATE/i', $sql)){
            throw new Exception('Não é uma instrução UPDATE');
            //die('Não é uma instrução SELECT');

        }

        $this->connect();

        try{
            if(!empty($param)){
                $stmt = $this->conn->prepare($sql);
                $stmt->execute($param);
            }else{
                $stmt = $this->conn->prepare($sql);
                $stmt->execute();
            }

        }catch(PDOException $e){
            return false;
        }

        $this->disconnect();
    }

    //Instrução Delete
    public function delete($sql, $param = null)
    {

        $sql = trim($sql);

        if(!preg_match('/^DELETE/i', $sql)){
            throw new Exception('Não é uma instrução DELETE');
            //die('Não é uma instrução SELECT');

        }

        $this->connect();

        try{
            if(!empty($param)){
                $stmt = $this->conn->prepare($sql);
                $stmt->execute($param);
            }else{
                $stmt = $this->conn->prepare($sql);
                $stmt->execute();
            }

        }catch(PDOException $e){
            return false;
        }

        $this->disconnect();
    }

    //Instrução para qualquer uma fora o CRUD
    public function statement($sql, $param = null)
    {

        $sql = trim($sql);

        if(preg_match('/^(SELECT|INSERT|UPDATE|DELETE)/i', $sql)){
            throw new Exception('Instrução inválida!');
            //die('Não é uma instrução SELECT');

        }

        $this->connect();

        try{
            if(!empty($param)){
                $stmt = $this->conn->prepare($sql);
                $stmt->execute($param);
            }else{
                $stmt = $this->conn->prepare($sql);
                $stmt->execute();
            }

        }catch(PDOException $e){
            return false;
        }

        $this->disconnect();
    }
}