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

}