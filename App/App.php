<?php

use App\Autoloader\Autoloader;
use App\MyDatabase\MyDatabase;

class App{
    private static $instance = null;
    private $db_instance = null;
    public $title = "Mona";
    public static function getInstance()
    {
        if(self::$instance == null)
        {
            self::$instance = new App;
        }
        return self::$instance;
    }
    public static function load()
    {
        require 'Autoloader.php';
        Autoloader::register();
    }
    public function getTitle()
    {
        return $this->title;
    }
    public function get_Db()
    {
        if($this->db_instance == null)
        {
            $this->db_instance = MyDatabase::getInstance();
        }
        return $this->db_instance;
    }
}