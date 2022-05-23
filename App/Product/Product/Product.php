<?php

namespace App\Product\Product;

use App\MyDatabase\MyDatabase;

class Product{
    private $name_;
    private $price;
    private $owner;
    private $ownersurname;
    private $ownerCode;
    private $category;
    private $code;
    private $condition;
    private $devise;
    private $state;
    private static $db;
    private $desc;
    private $ownerdistrict;
    private $link;
    private $images = [];
    public function __construct($ownerCode =  null,$name=null,$price=null,$owner=null,$category=null,$code=null,$devise=null,$description=null,$state=null,$image,$district,$condition,$surname,$link){
        $this->ownerCode = $ownerCode;
        $this->name_ = $name;
        $this->price = $price;
        $this->owner = $owner;
        $this->category = $category;
        $this->code = $code;
        $this->devise = $devise;
        $this->desc = $description;
        $this->state = $state;
        $this->images = $image;
        $this->ownerdistrict = $district;
        $this->condition = $condition;
        $this->ownersurname = $surname;
        $this->link = $link;
    }

    public static function getproductByCode($code){
        self::$db = MyDatabase::getInstance();
        $product = false;
        $result =self::$db->selectionner("SELECT * FROM product INNER JOIN user ON product.owner= user.mona_id WHERE prod_code = ?",[$code] ,true);
        $link = "product-detail/". str_replace(" ","-",$result->category."/".$result->prod_code." ".$result->name_);
        $product = new Product($result->owner,$result->name_,$result->price,$result->name,$result->category,$result->prod_code,$result->devise,$result->describe,$result->state,[$result->picture1,$result->picture2,$result->picture3,$result->picture4,$result->picture5,$result->picture6],$result->district,$result->condition,$result->surname,$link);
        
        return $product;
    }
    
    public static function getproductByOwner($owner){
        self::$db = MyDatabase::getInstance();
        $product = false;
        $result =self::$db->selectionner("SELECT * FROM product INNER JOIN user ON product.owner= user.mona_id WHERE owner = ?",[$owner] ,true);
        if(is_object($product)){
            $link = "product-detail/". str_replace(" ","-",$result->category."/".$result->prod_code." ".$result->name_);
            $product = new Product($result->owner,$result->name_,$result->price,$result->name,$result->category,$result->prod_code,$result->devise,$result->describe,$result->state,[$result->picture1,$result->picture2,$result->picture3,$result->picture4,$result->picture5,$result->picture6],$result->district,$result->condition,$result->surname,$link);
        }
        return $product;
    }
    
    public function __get($key){
        if(property_exists($this,$key)){
            return $this->$key;
        }
    }

    public function __set($key,$value){
        if(property_exists($this,$key)){
            $this->$key=$value;
        }
        return $this; 
    }

}