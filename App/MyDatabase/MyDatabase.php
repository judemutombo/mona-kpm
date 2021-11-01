<?php

namespace App\MyDatabase;

use PDO;
use PDOStatement;

class MyDatabase{
    private $host;
    private $username;
    private $dbname;
    private $password;
    private $pdo = null;

    private static $instance = null;

    public static function getInstance()
    {
        if(self::$instance == null)
        {
            self::$instance = new MyDatabase("sql304.epizy.com","epiz_29584072","epiz_29584072_kpm","Mutombo0");
        }
        return self::$instance;
    }

    public function __construct($hostname, $uname,$dname,$pword="")
    {
        $this->host = $hostname;
        $this->username = $uname;
        $this->dbname = $dname;
        $this->passowrd = $pword;
    }
    private function getPDO()
    {
        if($this->pdo == null)
        {
            $this->pdo = new PDO("mysql:host=sql304.epizy.com;dbname=epiz_29584072_kpm","epiz_29584072","Mutombo0");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
        }
        return $this->pdo;

    }
    public function selectionner($requete,$parametres = null,$tableau = false)
    {
        $result = null;
        if($parametres == null)
        {
            $result= $this->getPDO()->query($requete);
            $datas = $result->fetchAll(PDO::FETCH_OBJ);
            return $datas;
        }
        else{
            $result = $this->getPDO()->prepare($requete);
            $result->setFetchMode(PDO::FETCH_OBJ);
            $result->execute($parametres);
            if($tableau)
            {
                $datas = $result->fetchObject();
                return $datas;
            }
            $datas = $result->fetchAll();
            return $datas;
        }
    }
    public function inserer($requete,$parametres=null)
    {
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
        if(!is_null($parametres))
        {
            $result = $this->getPDO()->prepare($requete);
            return $result->execute($parametres);

        }
        else{
            $res = $this->getPDO()->exec($requete);
            if($res)
            {
                return true;
            }
            else{
                return false;
            }
        }
        
    }
    public function update($requete,$parametres)
    {
        $result = $this->getPDO()->prepare($requete);
        return $result->execute($parametres);
    }
    public function nbrElement($query,$parametres)
    {
        $result = $this->getPDO()->prepare($query);
        $result->execute($parametres);
        $datas = $result->fetch(PDO::FETCH_NUM);
        return (int) $datas[0];
    }
    public function delete($requete,$parametres = null)
    {
        if(is_null($parametres))
        {
            return $this->getPDO()->exec($requete);
        }
        else{
            $result = $this->getPDO()->prepare($requete);
            return $result->execute($parametres);
        }
    }
    public function  lastError()
    {
        return $this->pdo->errorInfo();
    }
}