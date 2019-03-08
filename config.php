<?php
namespace htl3r\rps;

/**
 * Created by PhpStorm.
 * User: Max-Game
 * Date: 04.03.2019
 * Time: 13:20
 */

class config {
    public static function getConnectionParams(){
        return array(
            'dbname' => 'rockpaperscissors',
            'user' => 'root',
            'password' => '',
            'host' => 'localhost',
            'driver' => 'pdo_mysql',
        );
    }
}
