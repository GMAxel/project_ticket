<?php
require_once '../../includeAll/klasser/db.php';
class Events 
{
    private $_db;
    public $is_logged_in = false;

    function __construct() {
        $db = new DB();
        $this->_db = $db->pdo;
    }

    function show_events() {
        $sql = "SELECT name, date, price FROM events";
        $stmt = $this->_db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $event) {
            echo "<h2> <a href='#'> $event[name] </a></h2>";
            echo "<span> <a href='#'> $event[date] </a></span>";
        }
    }
    function show_event($event) {
        $sql = "SELECT e.id, e.name AS 'Event', a.arenaName AS 'Arena', date AS 'Datum', 
        price AS 'Pris', a.capacity AS 'Kapacitet', a.address AS 'Adress', 
        a.postalcode AS 'Postkod', a.postalarea AS 'Postort' 
        FROM events AS e
        JOIN arenas AS a on e.arenaId = a.id

        JOIN seatStatus as ss on ss.eventId = e.id

        WHERE e.id = $event AND ss.sold = 0;";
        $stmt = $this->_db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($result);
        echo "<textarea id='event_info' hidden>$json </textarea> ";

        // 13	293	459	69	316	1	0	1
    }

    function display_tickets($event) {
        $sql = "SELECT e.id AS 'eventId', a.id AS 'arenaId', 
                sections.id AS 'sectionId', a_rows.id AS 'rowId', 
                seats.id, sections.section AS 'Sektion', 
                a_rows.row_number 'Rad', seats.seat AS 'Plats' 
        FROM seatStatus as ss
        JOIN events AS e ON ss.eventId = e.id
        JOIN arenas AS a ON e.arenaId = a.id
        JOIN arenaSections AS sections ON sections.arenaId = a.id
        JOIN arenaSectionRows AS a_rows ON a_rows.arenaSectionId = sections.id
        JOIN arenaSectionRowSeats AS seats ON seats.arenaSectionRowId = a_rows.id
        WHERE e.id = $event AND ss.sold = 0
        GROUP BY seats.id;
        ";
        $stmt = $this->_db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($result);
        echo "<textarea id='event_tickets' hidden>$json </textarea> ";
    }

    // Hämtar alla biljetter som finns till min cart,
    // Så att vi sedan kan visas relevant data i carten. 
    function display_all_tickets() {
        $sql = "SELECT e.id AS 'eventId', a.id AS 'arenaId', 
                sections.id AS 'sectionId', a_rows.id AS 'rowId', 
                seats.id, sections.section AS 'Sektion', 
                a_rows.row_number AS 'Rad', 
                seats.seat AS 'Plats' 
        FROM seatStatus as ss
        JOIN events AS e ON ss.eventId = e.id
        JOIN arenas AS a ON e.arenaId = a.id
        JOIN arenaSections AS sections ON sections.arenaId = a.id
        JOIN arenaSectionRows AS a_rows ON a_rows.arenaSectionId = sections.id
        JOIN arenaSectionRowSeats AS seats ON seats.arenaSectionRowId = a_rows.id
        GROUP BY seats.id;

        
        ";
        $stmt = $this->_db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($result);
        echo "<textarea id='all_tickets' hidden>$json</textarea>";
    }

    function show_events_json() {
        $sql = "SELECT name, date, price, id FROM events";
        $stmt = $this->_db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($result);
        echo "<textarea id='events' hidden>$json </textarea> ";
    }

    function display_event($eventId) {
        $sql = "SELECT a.arenaName, a.capacity, a.address, a.postalcode, a.postalarea, 
            e.date, e.price, e.id, sections.section,  a_rows.row_number FROM events AS e
                LEFT JOIN arenas AS a ON e.arenaId = a.id
                LEFT JOIN arenaSections AS sections ON sections.arenaId = a.id
                LEFT JOIN arenaSectionRows AS a_rows ON a_rows.arenaSectionId = sections.id
                WHERE e.id = $eventId  
                GROUP BY a_rows.id;
        ";
        $stmt = $this->_db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($result);
        echo "<textarea id='event' hidden>$json </textarea> ";

    }

    function display_rows($columnId) {
        $sql = "SELECT sections.section, a_rows.row_number, a_rows.row_nrOfSeats FROM arenaSections AS sections
                        LEFT JOIN arenaSectionRows AS a_rows ON a_rows.arenaSectionId = sections.id
                        WHERE sections.section = $columnId
                        GROUP BY a_rows.row_number;
        ";
        $stmt = $this->_db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($result);
        echo "<textarea id='event' hidden>$json </textarea> ";
    }
}