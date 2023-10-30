<?php 
namespace App;

class Auth {

    public static function checkConnected() : bool
    {
        return (isset($_COOKIE['LOGGED_USER']) && !empty($_COOKIE['LOGGED_USER'])) ? true : false;
    }
}