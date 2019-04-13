<?php
class Arena {

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

    public function test_getColumnNames($table)
        {
            $sql = "SHOW COLUMNS FROM $table";
            $stmtGetColumns = $this->_db->prepare($sql); 
            $stmtGetColumns->execute();
            $tableColumns = $stmtGetColumns -> fetchAll(PDO::FETCH_COLUMN);
        
            // tar bort Id elementet från vår array.
            \array_splice($tableColumns, 0, 1);

            $this->columnNames = $tableColumns;   
            $this->table = $table; 
        }


    function insert_row($nrOfSections = 0, $last_arenaId = 0) 
    {
        $inputData = array();

        foreach($this->columnNames as $elem) 
        { 
            if($this->table == 'arenas') 
            {
                $inputData[] = filter_input(INPUT_POST, $elem, FILTER_SANITIZE_MAGIC_QUOTES);
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

    function insert_many_rows ($section_id_arr, $nrOfRows) {
        echo "<hr><pre> Sektionernas Id";
        print_r($section_id_arr);
        echo "</pre> <hr>";

        echo "<hr><pre> Antal Rader: ";
        echo($nrOfRows);
        echo "</pre> <hr>";

        $many_rows = new stdClass();
        // columnNames innehåller alla kolumner. Alltså, för varje kolumnnamn...
        // foreach($this->columnNames as $elem) {
        //     if($elem != 'arenaSectionId') {
        //         // Här hämtar vi inputvärden, och lägger de separat.
        //         // Värden med namn_0 hamnar i many_inputData som 0-index.
        //         // Värden med namn 1 hamnar med 1 som index. osv. 
        //         for($i = 0; $i < $nrOfRows; $i++) {

        //             $looped_elem = $elem . '_' . $i;
  
        //             $inputData = filter_input(INPUT_POST, $looped_elem, FILTER_SANITIZE_MAGIC_QUOTES);


        //             $many_inputData->$i [] = $inputData;                    
        //         }
        //     }
        // }
    }

    function insert_rows ($nrOfSections = 0, $last_arenaId = 0) 
    {
        $many_inputData = new stdClass();
        // columnNames innehåller alla kolumner. Alltså, för varje kolumnnamn...
        foreach($this->columnNames as $elem) {
            if($elem != 'arenaId') {
                // Här hämtar vi inputvärden, och lägger de separat.
                // Värden med namn_0 hamnar i many_inputData som 0-index.
                // Värden med namn 1 hamnar med 1 som index. osv. 
                for($i = 0; $i < $nrOfSections; $i++) {

                    $looped_elem = $elem . '_' . $i;
  
                    $inputData = filter_input(INPUT_POST, $looped_elem, FILTER_SANITIZE_MAGIC_QUOTES);


                    $many_inputData->$i [] = $inputData;                    
                }
            }
        }
      

        echo "<br><br> <hr>Many input data arena: ";
        echo "<pre>";
        print_r($many_inputData);
        echo "</pre><hr>";

        
        foreach($many_inputData as $one_section) {
            foreach($one_section as $val) {
                echo "<hr> VALUES: $val <hr>";
            }
        }

        
  

        // Här gör vi om columnNames till en sträng så vi kan använda den i $sql. 
        $columnNames = implode(', ', $this->columnNames);

        echo "<hr> Kolumner att fylla: $columnNames <hr>";

        // här skapar vi en string som har lika många ? som antal värden vi hämtat. 
        $placeholders = rtrim(str_repeat('?, ', count($this->columnNames)), ', ');

        echo "<hr> placeholders att fylla: $placeholders <hr>";


        // här gör skapar vi en querystring som innehåller kolumnerna från db, samt lika många placeholders.
        $sql = "INSERT INTO $this->table ($columnNames) VALUES ($placeholders)";
        $stmt= $this->_db->prepare($sql);

        echo "<hr> Sql: $sql <hr>";

     
        $section_id = [];

        foreach($many_inputData as $one_section) {
            $i = 1;
            echo "<hr> arena Id: $last_arenaId <hr>";
            $stmt->bindValue($i, $last_arenaId);

            foreach($one_section as $value) {
                $i++;
                echo "<hr> Värde $i : $value <hr>";

                $stmt->bindValue($i, $value);
                
            }
            echo "<hr> Nu händer det </hr>";
            $stmt->execute();    
            
            $section_id [] = $this->_db->lastInsertId();   
            
           
        }
        
        echo "<hr>Sektion id <pre>";
            print_r($section_id);
            echo "</pre><hr>";
            return $section_id;
    }
}
