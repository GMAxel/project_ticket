<?php

/**
 * Databas Objekt
 */
class DB 
{
    private $_host = 'my33b.sqlserver.se';
    private $_dbName = '236972-tickets';
    private $_user = '236972_yf56592';
    private $_pass = 'XT6xyYWbc7Gw99V';
    private $_charset = 'utf8mb4';
    public $pdo;

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