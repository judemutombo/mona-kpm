<?php 

namespace App\DbAuth;

use App;

class DbAuth{

    private static $_instance = null;
    private $name;
    private $adresse;
    private $db;
    private $connect = false;
    public static function getAuth($db)
    {
        if(is_null(self::$_instance))
        {
            $_instance = new DbAuth($db);
        }
        return $_instance;
    }
    public function __construct($db)
    {
        $this->db = $db;
    }
    public function inscription($_name, $_lname,$_address,$_mail,$_pass,$_district)
    {
        $_passeee = password_hash($_pass,PASSWORD_DEFAULT);
        $_mona_id = null;
        do{
            $mona_id = $this->generate_id();
            $reuslt = $this->db->selectionner("SELECT * FROM user WHERE mona_id=?",[$mona_id],false);
        }while(count($reuslt) > 0 );

        if($this->db->inserer("INSERT INTO user(name,surname,address,mona_id,mail,password,district) VALUES(?,?,?,?,?,?,?)",[$_name, $_lname,$_address,$mona_id,$_mail,$_passeee,$_district]))
        {
            $_SESSION['user'] = $mona_id;
            $_SESSION['username'] = $_name;
            $this->connect = true;
            App::getInstance()->title = $_SESSION['username'];
            return true;
        }
        else{
            return false;
        }
    }
    public function connexion($_mail,$_pass)
    {
        $result = $this->db->selectionner("SELECT * FROM user WHERE mail=?",[$_mail],true);
        if(is_object($result))
        {
                if(password_verify($_pass,$result->password))
                {
                    $_SESSION['user'] = $result->mona_id;
                    $_SESSION['username'] = $result->name;
                    $this->connect = true;
                    App::getInstance()->title = $_SESSION['username'];
                    return 1;
                }
                else{
                    return 3;
                }
        }
        else{
            return 2;
        }
    }
    public function generate_id()
    {
            $aleatoire = 0;
            $dec='A'; 
            $de = array();
            for ($i = 0; $i < 15; $i++)
            {
                $aleatoire = rand(0,35);
                if($aleatoire >=26)
                {
                    $aleatoire =35 - $aleatoire;
                    switch ($aleatoire)
                    {
                        case 0:
                            $de[$i]='0';
                        case 1:
                            $de[$i]='1';
                            break;
                        case 2:
                            $de[$i]='2';
                            break;
                        case 3:
                            $de[$i]='3';
                            break;
                        case 4:
                            $de[$i]='4';
                            break;
                        case 5:
                            $de[$i]='5';
                            break;
                        case 6:
                            $de[$i]='6';
                            break;
                        case 7:
                            $de[$i]='7';
                            break;
                        case 8:
                            $de[$i]='8';
                            break;
                        case 9:
                            $de[$i]='9';
                            break;
                    }
                }
                else{
                    for ($j=0; $j < $aleatoire; $j++) { 
                        $dec= ++$dec;
                    }
                    $de[$i] = $dec;
                }
                $dec='A'; 
            }

        return implode($de);
    }
    public function isConnect()
    {
        return isset($_SESSION['user']);
    }
    public function deconnexion()
    {
        unset($_SESSION['user']);
        unset($_SESSION['username']);
    }
}