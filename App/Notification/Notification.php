<?php

namespace App\Notification;

use App\MyDatabase\MyDatabase;

class Notification{

    private static $db;
    public static function unreadNotification(){
        self::$db = MyDatabase::getInstance();
        return count(self::$db->selectionner("SELECT * FROM notification WHERE lecture =? && user=?",["UNREAD",$_SESSION["user"]],false));
    }
    public static function setRead($notif){
        self::$db = MyDatabase::getInstance();
        if(self::$db->update("UPDATE notification SET lecture=? WHERE id=?",["READ",$notif])){
            return true;
        }
        return false;

    }
}