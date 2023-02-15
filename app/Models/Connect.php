<?php

namespace App\Models;

use Exception;
use PDO;
use PDOException;

class Connect {

    private $conexao;

    public function conectar(){
        $this->conexao = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_NAME.";charset=".DB_CHARSET, DB_USER, DB_PASS, array(PDO::ATTR_PERSISTENT => true));
        $this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    public function desconectar(){
        $this->conexao = null;
    }

    public function select($sql, $param = null){

        $sql = trim($sql);

        if(!preg_match('/^SELECT/i', $sql)){
            throw new Exception('Não é uma instrução SELECT');
        }

        $this->conectar();

        $results = null;

        try{
            if(!empty($param)){
                $stmt = $this->conexao->prepare($sql);
                $stmt->execute($param);
                $results =  $stmt->fetchAll(PDO::FETCH_CLASS);
            }else{
                $stmt = $this->conexao->prepare($sql);
                $stmt->execute();
                $results =  $stmt->fetchAll(PDO::FETCH_CLASS);
            }

        }catch(PDOException $e){
            return false;
        }

        $this->desconectar();

        return $results;
    }
}