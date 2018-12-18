<?php
/**
 * Created by PhpStorm.
 * User: mrsops
 * Date: 11/12/18
 * Time: 8:52
 */

return[
    'database'=>[
        'name'=>'cursophp7',
        'username'=>'userCurso',
        'password'=>'php',
        'connection'=>'mysql:host=php7.local',
        'options'=>[
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_PERSISTENT => true
        ]

    ]
];
