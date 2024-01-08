<?php

class Db {
    private static $instance = null; // Instance null car singleton
    
    private $host;
    private $user;
    private $pwd;
    private $db;
    private $dsn;
    private $dbh;

    private function __construct () {
        $this->host = "db.3wa.io";
        $this->user = "theobaileche";
        $this->pwd = "a1068655e06a592125596b4dee76b58f";
        $this->db = "theobaileche_we_love_food";
        $this->dsn = "mysql:dbname=".$this->db.";host=".$this->host;
        $this->dbh = new PDO($this->dsn, $this->user, $this->pwd);
    }

    public static function getDb() {
        if (is_null(self::$instance)) {
            self::$instance = new Db();
        }
        return self::$instance;
    }
    
    public static function getDbh() {
        if (is_null(self::$instance)) {
            self::$instance = new Db();
        }
        return self::$instance->dbh;
    }
}