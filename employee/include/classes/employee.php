
<?php
require_once '../../includeAll/klasser/db.php';

class Employee {

    private $_db;
    public $is_logged_in;
    public $columnNames;
    public $table = 'employees';
    public $last_insert_id;

    function __construct() 
    {
            $db = new DB();
            $this->_db = $db->pdo;
    }

    function checkIfExist() {
        $ticket_id = $_GET['ticket_id'];

        $sql = "SELECT * FROM seatStatus
            WHERE id = $ticket_id;";
        $stmt = $this->_db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_COLUMN);
        return $result;

    }

    function checkIfBought() {
        $ticket_id = $_GET['ticket_id'];

        $sql = "SELECT * FROM seatStatus
            WHERE id = $ticket_id
            AND sold = 1;";
        $stmt = $this->_db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_COLUMN);
        return $result;

    }
    function checkIfScanned() {
        $ticket_id = $_GET['ticket_id'];

        $sql = "SELECT * FROM seatStatus
            WHERE id = $ticket_id
            AND scanned = 0;";
        $stmt = $this->_db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_COLUMN);
        return $result;

    }
    function scanTicket(){
        $ticket_id = $_GET['ticket_id'];

        $sql = "UPDATE seatStatus
                SET scanned = 1 
                WHERE id = $ticket_id;";

        $stmt = $this->_db->prepare($sql);
        $stmt->execute();
        
        $sql = "SELECT * FROM seatStatus
            WHERE id = $ticket_id
            AND scanned = 1;";
        $stmt = $this->_db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_COLUMN);
        return $result;
    }
    
}