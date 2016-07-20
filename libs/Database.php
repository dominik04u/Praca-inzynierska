<?php


class Database extends PDO
{
    private $hostname, $username, $password, $database, $type;

    function __construct()
    {
        $this->hostname = DB_HOST;
        $this->username = DB_USER;
        $this->password = DB_PASS;
        $this->database = DB_NAME;
        $this->type = DB_TYPE;

        parent::__construct($this->type . ':host=' . $this->hostname . ';dbname=' . $this->database, $this->username, $this->password);
        $this->query('SET NAMES utf8');

    }

}

