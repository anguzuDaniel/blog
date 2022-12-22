<?php

class Database
{
    protected $dbHost;
    protected $dbUser;
    protected $dbName;
    protected $dbPassword;


    public function __construct($host, $name, $user, $password)
    {
        $this->dbHost = $host;
        $this->dbName = $name;
        $this->dbUser = $user;
        $this->dbPassword = $password;
    }

    /**
     * @return [type]
     */
    public function getConn()
    {

        $dsn = 'mysql:host=' . $this->dbHost . '; dbname=' . $this->dbName . ';charset=utf8';

        try {
            $db = new PDO($dsn, $this->dbUser, $this->dbPassword);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $db;
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }
}
