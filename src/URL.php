<?php
namespace App;
use Exception;

class URL {

    public static function getInt(string $name, ?int $default = null): ?int
    {
        if(!isset($_GET[$name])) return $default;
    
        if(!filter_var($_GET[$name], FILTER_VALIDATE_INT)){
            throw new Exception("numero de page invalide !");
        }
        return (int)$_GET[$name];
    }

    public static function getPositiveInt(string $name, ?int $default = null): ?int
    {
        $param = self::getInt($name, $default);
        if($param && $param <= 0){
            throw new Exception("numero de page negatif");
        }
        return $param;
    }
}