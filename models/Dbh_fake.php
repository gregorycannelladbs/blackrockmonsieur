<?php

class Dbh {

    private static $server;
    private static $user;
    private static $pass;
    private static $db;

    protected static function connect() {
        self::$server = '91.216.107.185';
        self::$user = 'blabla';
        self::$pass = 'blabla';
        self::$db = 'black1920301';

        $conn = new mysqli(self::$server, self::$user, self::$pass, self::$db);
        $conn->set_charset('utf8mb4');
        return $conn;
    }
    
}