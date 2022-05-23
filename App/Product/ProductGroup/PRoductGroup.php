<?php

namespace App\Product\ProductGroup;

use App\MyDatabase\MyDatabase;
use App\Product\Product\Product;
class ProductGroup{

    private static $array=[];
    private static $existingCategory = ["Electronics","Clothes and Others","Sports","Health and Beauty","Art and Collectibles","Mechanical and Electromechanical","Children and Toys","Artisan an Agriculture","Music and Others", "Decoration and Gardening"];

    public static function getAllProduct(){
        $db = MyDatabase::getInstance();
        self::$array = [];
        $results = $db->selectionner("SELECT * FROM product INNER JOIN user ON product.owner= user.mona_id ",null ,false);
        foreach($results as $result){
            $link = "product-detail/". str_replace(" ","-",$result->category."/".$result->prod_code." ".$result->name_);
            $product = new Product($result->owner,$result->name_,$result->price,$result->name,$result->category,$result->prod_code,$result->devise,$result->describe,$result->state,[$result->picture1,$result->picture2,$result->picture3,$result->picture4,$result->picture5,$result->picture6],$result->district,$result->condition,$result->surname,$link);
            array_push(self::$array,$product);
        }
        return self::$array;
    }
    public static function getProductByOwner($owner){
        self::$array = [];
        $db = MyDatabase::getInstance();
        $results = $db->selectionner("SELECT * FROM product INNER JOIN user ON product.owner= user.mona_id WHERE owner=?",[$owner],false);
        foreach($results as $result){
            $link = "product-detail/". str_replace(" ","-",$result->category."/".$result->prod_code." ".$result->name_);
            $product = new Product($result->owner,$result->name_,$result->price,$result->name,$result->category,$result->prod_code,$result->devise,$result->describe,$result->state,[$result->picture1,$result->picture2,$result->picture3,$result->picture4,$result->picture5,$result->picture6],$result->district,$result->condition,$result->surname,$link);
            array_push(self::$array,$product);
        }
        return self::$array;
    }
    public static function getProductByCategory($category){
        self::$array = [];
       if(!in_array($category,self::$existingCategory)){
            return false;
        }
        $db = MyDatabase::getInstance();
        $results = $db->selectionner("SELECT * FROM product INNER JOIN user ON product.owner= user.mona_id WHERE category =?",[$category],false);
       
        if(count($results) == 0){
            return true;
        }
        foreach($results as $result){
            $link = "product-detail/". str_replace(" ","-",$result->category."/".$result->prod_code." ".$result->name_);
            $product = new Product($result->owner,$result->name_,$result->price,$result->name,$result->category,$result->prod_code,$result->devise,$result->describe,$result->state,[$result->picture1,$result->picture2,$result->picture3,$result->picture4,$result->picture5,$result->picture6],$result->district,$result->condition,$result->surname,$link);
            array_push(self::$array,$product);
        }
        return self::$array;
    }
    public static function verifyCategory($category){
        if(!in_array($category,self::$existingCategory)){
            return false;
        }
        return true;
    }
    public static function getproductByJoker($joker){
        self::$array = [];
        $db = MyDatabase::getInstance();
        $results = $db->selectionner("SELECT * FROM product INNER JOIN user ON product.owner= user.mona_id WHERE name_ LIKE '%$joker%'",null,false);
        foreach($results as $result){
            $link = "product-detail/". str_replace(" ","-",$result->category."/".$result->prod_code." ".$result->name_);
            $product = new Product($result->owner,$result->name_,$result->price,$result->name,$result->category,$result->prod_code,$result->devise,$result->describe,$result->state,[$result->picture1,$result->picture2,$result->picture3,$result->picture4,$result->picture5,$result->picture6],$result->district,$result->condition,$result->surname,$link);
            array_push(self::$array,$product);
        }
        return self::$array;
    }
}