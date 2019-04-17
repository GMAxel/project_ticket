<?php

/**
 * Databas Objekt
 */
class DB 
{
   
    /** 
     * Anslutning DB 
     * */
    public function __construct() 
    {
        $dsn = "mysql:host=$this->_host;dbname=$this->_dbName;charset=$this->_charset";
        try {
            $this->pdo = new PDO($dsn, $this->_user, $this->_pass);
        } catch (\PDOexception $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
}