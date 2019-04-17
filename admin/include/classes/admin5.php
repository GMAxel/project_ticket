<?php

require_once '../../includeAll/klasser/db.php';

class Admin_test {
    private $_db;
    public $is_logged_in;
    public $columnNames;
    public $table;
    public $last_insert_id;

    function __construct() 
    {
            $db = new DB();
            $this->_db = $db->pdo;
    }

    public function test_createUser2($nrOfSections = 0, $last_arenaId = 0) 
    {
        $inputData = array();
        foreach($this->columnNames as $elem) 
        { 
            if($this->table == 'arenas') 
            {
                $inputData[] = filter_input(INPUT_POST, $elem, FILTER_SANITIZE_MAGIC_QUOTES);
            }

            if($this->table == 'arenaSections') 
            {
                if($elem == 'arenaId') 
                {
                    echo "<br>Arenans Id är följande: $last_arenaId";
                    var_dump($last_arenaId);
                    $inputData[] = $last_arenaId;                   
                }
                else 
                {
                    for($i = 0;$i < $nrOfSections; $i++) 
                    {
                        echo "<br>Elem: $elem";

                        $looped_elem = $elem . '_' . $i;

                        echo "<br>Looped Elem: $looped_elem";

                        $inputData[] = filter_input(INPUT_POST, $looped_elem, FILTER_SANITIZE_MAGIC_QUOTES);
                    }
                }
            }
        }
        
        // Här gör vi om columnNames till en sträng så vi kan använda den i $sql. 
        $columnNames = implode(', ', $this->columnNames);

        // här skapar vi en string som har lika många ? som antal kolumner vi hämtat. 
        $placeholders = rtrim(str_repeat('?, ', count($this->columnNames)), ', ');

        // här gör skapar vi en querystring som innehåller kolumnerna från db, samt lika många placeholders.
        $sql = "INSERT INTO $this->table ($columnNames) VALUES ($placeholders)";
        $stmt= $this->_db->prepare($sql);

        // Här binder vi värdet till placeholdersna
        $i = 1;
        foreach($inputData as $value) {
            $stmt->bindValue($i, $value);
            $i++;
        }
        
        $stmt->execute();   
        if($this->table == 'arenas') {
            echo "senaste id: " . $this->_db->lastInsertId();
            return $this->_db->lastInsertId();
        }
    }

    // makes sure that the arena names doesn't already exist.
    public function if_arena_taken() 
    {
        $arena = $_POST['arenaName'];
        $sql = "SELECT * FROM arenas
            WHERE arenaName = '$arena';";
        $stmt = $this->_db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_COLUMN);
        var_dump($arena);
        var_dump($result);
        echo $hmm;
        return $result;
    }

    public function test_getColumnNames($table)
        {
            $sql = "SHOW COLUMNS FROM $table";
            $stmtGetColumns = $this->_db->prepare($sql); 
            $stmtGetColumns->execute();
            $tableColumns = $stmtGetColumns -> fetchAll(PDO::FETCH_COLUMN);
            // tar bort Id elementet från vår array.
            \array_splice($tableColumns, 0, 1);

            // Lagrar db kolumnnamn och tabellens namn
            $this->columnNames = $tableColumns;   
            $this->table = $table; 
        }

    public function test_createUser() {
        $inputData = array();
        foreach($this->columnNames as $elem) {
            

            $inputData[] = filter_input(INPUT_POST, $elem, FILTER_SANITIZE_MAGIC_QUOTES);


        // Här gör vi om columnNames till en sträng så vi kan använda den i $sql. 
        $columnNames = implode(', ', $this->columnNames);

            // här skapar vi en string som har lika många ? som antal värden vi hämtat. 
            $placeholders = rtrim(str_repeat('?, ', count($inputData)), ', ');

            // här gör skapar vi en querystring som innehåller kolumnerna från db, samt lika många placeholders.
            $sql = "INSERT INTO $this->table ($columnNames) VALUES ($placeholders)";
            $stmt= $this->_db->prepare($sql);


            // Här binder vi värdet till placeholdersna
            $i = 1;

            foreach($inputData as $value) {
                $stmt->bindValue($i, $value);
                $i++;
            }
            
            $stmt->execute();        

        }
    }
}