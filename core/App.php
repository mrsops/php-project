<?php
/**
 * Created by PhpStorm.
 * User: mrsops
 * Date: 11/12/18
 * Time: 9:24
 */
require_once __DIR__. '/../exception/AppException.php';

class App
{
    private static $container=[];

    public static function bind(string $key, $value){
        static::$container[$key]=$value;
    }

    public static function get(string $key){
        if(!array_key_exists($key, static::$container)){
            throw new AppException("No se ha encontrado la clave $key en el contenedor");
        }
        return static::$container[$key];
    }

    public static function getConnection(){
        if(!array_key_exists('connection', static::$container)){
            static::$container['connection']=Connection::make();
        }

        return static::$container['connection'];
    }
}