<?php

require_once '../../includeAll/klasser/db.php';

class Purchaser {
    private $_db;

    function __construct() {
        $db = new DB();
        $this->_db = $db->pdo;
    }

    function is_sold($id) {
        $sql = "SELECT * FROM seatStatus"
    }

}