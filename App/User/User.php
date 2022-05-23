<?php

namespace App\User;
use App;
class User
{
    private static  $instance =null;
    private $db;
    public static function getInstance($db)
    {
        if(is_null(self::$instance))
        {
            self::$instance = new  User($db);
        }
        return self::$instance;
    }
    public function __construct($db)
    {
        $this->db = $db;
    }
    public function numberOfproduct()
    {
        $result = $this->db->selectionner("SELECT * FROM product WHERE owner = ?",[$_SESSION['user']],false);
        return count($result);
    }
    public function getfullidentity()
    {
        $result = $this->db->selectionner("SELECT * FROM user WHERE mona_id = ?",[$_SESSION['user']],true);
        return $result;
    }
    public function numberOfOrder()
    {
        $result = $this->db->selectionner("SELECT * FROM orders WHERE sellerInfo=? or buyerInfo=?",[$_SESSION['user'],$_SESSION['user']],false);
        return count($result);
    }

    public function checkUser($id)
    {
        $user = $this->db->selectionner("SELECT * FROM user WHERE mona_id = ?",[$id],true);
        if(is_object($user))
        {
            return  true;
        }
        return false;
    }
    public function getUserById($id){
        $result = $this->db->selectionner("SELECT * FROM user WHERE mona_id = ?",[$id],true);
        return $result;
    }
}
