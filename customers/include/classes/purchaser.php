<?php

require_once '../../includeAll/klasser/db.php';

class Purchaser {
    private $_db;

    function __construct() {
        $db = new DB();
        $this->_db = $db->pdo;
    }

    function is_buyable($cart_item) {
        // foreach ticket, send to DB. 
        // echo $item . "<br>";
        $sql = "SELECT * FROM seatStatus
                WHERE arenaSectionRowSeatId = $cart_item
                AND sold = 0;";

        $stmt = $this->_db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_COLUMN);

        if($result) {
            echo "Biljett $cart_item tillgänglig <br>";
            return true;
        }
        else {
            echo "Biljett $cart_item ej tillgänglig <br>";
            return false;
        }
    }
         
    function register_order($cart_items) {
        // foreach ticket, send to DB. 
        if(isset($_SESSION['logged_in'])) {

            $totalCost = 0; 
            foreach($cart_items as $item) {
            // echo $item . "<br>";
                if($this->is_buyable($item)) {

                    $sql_select = "SELECT SUM(e.price) 
                    FROM seatStatus AS ss
                    JOIN events AS e ON ss.eventId = e.Id
                    WHERE arenaSectionRowSeatId = $item;";
                    $cost_stmt = $this->_db->prepare($sql_select);
                    $cost_stmt->execute();
                    $result = $cost_stmt->fetchColumn();
                    $totalCost += $result;
                }
                else {
                    echo "falsk";
                    return false;
                }
            }
            echo "<hr> TOTAL KOSTNAD: $totalCost <hr>";
 
            $date = date('Y/m/d H:i:s');
            $customerId = $_SESSION['user_id'];

            echo "<hr> DATE = $date <br> CustomerId = $customerId <br> 
            TotalCost = $totalCost <hr><br>";

            $sql_insert = "INSERT INTO orders(customerId, date, totalCost)
                VALUES($customerId, '$date', $totalCost)
                ;";
            $order_stmt = $this->_db->prepare($sql_insert);
            $order_stmt->execute();

            echo "senaste id: " . $this->_db->lastInsertId();
            return $this->_db->lastInsertId();
        }
        else {
            echo "<p>Du måste logga in först<p>";
        }
    }

    function register_purchase($cart_items) 
    {               
        print_r($cart_items);
        $order_id = $this->register_order($cart_items);

        if(isset($order_id)) {
            foreach($cart_items as $item) {
                $sql_update = "UPDATE seatStatus
                SET sold = 1, orderId = $order_id
                WHERE arenaSectionRowSeatId = $item;";
                $stmt = $this->_db->prepare($sql_update);
                $stmt->execute();      
                
            } 
            // setcookie("cart", "", time()-3600);
            return true;
        }
    }

    function my_purchases() {
        $customerId = $_SESSION['user_id'];
        $sql_select = "SELECT 
                            e.name AS 'Event', 
                            e.date AS 'Datum',
                            a.arenaName AS 'Arena', 
                            -- a.address AS 'Adress', 
                            -- a.postalcode AS 'Postnummer',
                            -- a.postalarea AS 'Postort', 
                            sec.section AS 'Sektion', 
                            r.row_number AS 'Rad', 
                            seat.seat AS 'Plats', 
                            sec.entrance AS 'Entré',
                            ss.arenaSectionRowSeatId AS 'BiljettID',
                            o.date AS 'Köptes',
                            e.price AS 'Pris'
                FROM orders AS o
                JOIN seatStatus AS ss ON ss.orderId = o.id
                JOIN events AS e ON ss.eventId = e.id
                JOIN arenas AS a ON e.arenaId = a.id
                JOIN arenaSections AS sec ON sec.arenaId = a.id
                JOIN arenaSectionRows AS r ON r.arenaSectionId = sec.id
                JOIN arenaSectionRowSeats AS seat ON ss.arenaSectionRowSeatId = seat.id
                WHERE o.customerId = $customerId
                GROUP BY ss.id;
                ";
        $stmt = $this->_db->prepare($sql_select);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Här skapar jag headers för tabellen. 
        echo "<tr>";
        foreach($result[0] as $key => $value) {
            echo "<th> $key </th>";
        }
        echo "</tr>";

        // Här skickar jag in värdena in i tabellen. 
        foreach($result as $ticket) {
            echo "<tr>";
            foreach($ticket as $key => $value) {
                echo "<td> $value </td> ";
            }
            echo "</tr>";
        }

    }
}