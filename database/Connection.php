<?php
/**
 * Created by PhpStorm.
 * User: mrsops
 * Date: 7/12/18
 * Time: 10:03
 */

class Connection
{

    public static function make()
    {

        try {

        $opciones = [
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_PERSISTENT => true
        ];
        $connection = new PDO('mysql:host=localhost;dbname=cursophp7;charset=utf8', 'userCurso', 'php', $opciones);
        }catch (PDOException $PDOException){
            die($PDOException->getMessage());
        }
        return $connection;
    }

}