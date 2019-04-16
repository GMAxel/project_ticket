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
            array_splice($tableColumns, 0, 1);

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
        foreach($this->columnNames as $elem) {
            if($elem != 'arenaSectionId') {
                // Här hämtar vi inputvärden, och lägger de separat.
                // Värden med namn_0 hamnar i many_inputData som 0-index.
                // Värden med namn 1 hamnar med 1 som index. osv. 
                for($i = 0; $i < $nrOfRows; $i++) {

                    $looped_elem = $elem . '_' . $i;
  
                    $inputData = filter_input(INPUT_POST, $looped_elem, FILTER_SANITIZE_MAGIC_QUOTES);


                    $many_rows->$i [] = $inputData;                    
                }
            }
        }
      

        echo "<br><br> <hr>Many input data arena: ";
        echo "<pre>";
        print_r($many_rows);
        echo "</pre><hr>";

        
        foreach($many_rows as $one_section) {
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

     

        foreach($many_rows as $one_section) {
            $i = 1;
            echo "<hr> arena Id: $last_arenaId <hr>";
            $stmt->bindValue($i, $last_arenaId);

            foreach($one_section as $value) {
                $i++;
                echo "<hr> Värde $i : $value <hr>";

                $stmt->bindValue($i, $value);
                
            }
            // echo "<hr> Nu händer det </hr>";
            $stmt->execute();    
            if($this->table == 'arenaSections') {
            }

        }
    }
    

    function insert_rows ($nrOfSections = 0, $last_arenaId = 0) 
    {
        $many_inputData = new stdClass();
        // columnNames innehåller alla kolumner. Alltså, för varje kolumnnamn...
        foreach($this->columnNames as $elem) {
            if($elem != 'arenaId') {
                
                for($i = 0; $i < $nrOfSections; $i++) {

                    $looped_elem = $elem . '_' . $i;
  
                    $inputData = filter_input(INPUT_POST, $looped_elem, FILTER_SANITIZE_MAGIC_QUOTES);


                    $many_inputData->$i [] = $inputData;                    
                }
            }
        }
      

        // echo "<br><br> <hr>Many input data arena: ";
        // echo "<pre>";
        // print_r($many_inputData);
        // echo "</pre><hr>";


        
        foreach($many_inputData as $one_section) {
            foreach($one_section as $val) {
                // echo "<hr> VALUES: $val <hr>";
            }
        }

        
  

        // Här gör vi om columnNames till en sträng så vi kan använda den i $sql. 
        $columnNames = implode(', ', $this->columnNames);

        // echo "<hr> Kolumner att fylla: $columnNames <hr>";

        // här skapar vi en string som har lika många ? som antal värden vi hämtat. 
        $placeholders = rtrim(str_repeat('?, ', count($this->columnNames)), ', ');

        // echo "<hr> placeholders att fylla: $placeholders <hr>";


        // här gör skapar vi en querystring som innehåller kolumnerna från db, samt lika många placeholders.
        $sql = "INSERT INTO $this->table ($columnNames) VALUES ($placeholders)";
        $stmt= $this->_db->prepare($sql);

        // echo "<hr> Sql: $sql <hr>";

     
        $section_id = [];

        foreach($many_inputData as $one_section) {
            $i = 1;
            // echo "<hr> arena Id: $last_arenaId <hr>";
            $stmt->bindValue($i, $last_arenaId);

            foreach($one_section as $value) {
                $i++;
                // echo "<hr> Värde $i : $value <hr>";

                $stmt->bindValue($i, $value);
                
            }
            // echo "<hr> Nu händer det </hr>";
            $stmt->execute();    
            
            $section_id [] = $this->_db->lastInsertId();   
            
           
        }
        
        // echo "<hr>Sektion id <pre>";
        //     print_r($section_id);
        //     echo "</pre><hr>";
            return $section_id;
    }
    
    function insert_many_rows_2($section_id_arr) {

        echo "<hr>Sektion ids <pre>";
        print_r($section_id_arr);
        echo "</pre><hr>";

       
        // för varje sektion id vill vi hämta hur många rader som skapades i den sektionen. 


                // för varje kolumn i databasen.
                // alltså: arenaSectionId, row_number, nrOfSeats. 

                // vi vill loopa igenom att kolumner i db.
                // vi vill loopa igenom alla sektion ids. 
                // vi vill loopa igenom alla rader som ska skapas. 

        $many_rows = new stdClass();
        $index = 0;
        foreach($section_id_arr as $section_id) {
            // section_id_arr innehåller alla sektioner som skapats. 
            // Här skickar vi in section_id som en array. 
            // $many_rows->$section_id [] = $section_id; kanske även ska skicka in värdetr?

            $many_rows->$section_id = new stdClass();

            foreach($this->columnNames as $elem) {
                if($elem != 'arenaSectionId') {
                    $nrOfRowsVar = 'nr_of_rows_' . $index;
                    $nrOfRows = filter_input(INPUT_POST, $nrOfRowsVar, FILTER_SANITIZE_MAGIC_QUOTES);

                    for($i = 0; $i < $nrOfRows; $i++) {
                        if(!$many_rows->$section_id->$i) {
                            $many_rows->$section_id->$i [] = $section_id;  
                        }  
                        $looped_elem = $elem . '_' . $i . '_' . $index;

                        $inputData = filter_input(INPUT_POST, $looped_elem, FILTER_SANITIZE_MAGIC_QUOTES);

                        $many_rows->$section_id->$i [] = $inputData;  
                          
                    }
                    
                }
            }

            $index++;
        }
       

        
        echo "<br><br> <hr>Many rows: ";
        echo "<pre>";
        print_r($many_rows);
        echo "</pre><hr>";

    



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


        foreach($many_rows as $section) {
            echo "<pre>";
            print_r($section);
            echo "</pre><hr>";
            

            foreach($section as $one_row) {
                echo "<pre>";
                print_r($one_row);
                echo "</pre><hr>";
                $i = 1;
                foreach($one_row as $value) {
                    echo "<pre>";
                    print_r($value);
                    echo "</pre><hr>";

                    
                    echo "<hr> Värde $i : $value <hr>";

                    $stmt->bindValue($i, $value);
                    $i++;
                }

                echo "<hr> Nu händer det </hr>";
                $stmt->execute();        
            }
           
            
        }
    }

    function prnt($item) {
        echo "<pre>";
        print_r($item);
        echo "</pre>";
    }


        //  Kalla på funktionen som hämtar kolumner med 'arena' som argument, sen: 
    function insert_seats($arenaId) {


        // Här hämtar vi antal platser på varje rad som tillhör angiven arena. 
        $sql_get = "SELECT a_rows.id, a_rows.row_nrOfSeats FROM arenaSectionRows as a_rows
                JOIN arenaSections AS sections ON sections.id = a_rows.arenaSectionId
                JOIN arenas AS a ON a.id = sections.arenaId
                WHERE a.id = $arenaId;";

        $stmt_get = $this->_db->prepare($sql_get);
        $stmt_get->execute();
        $result = $stmt_get->fetchAll(PDO::FETCH_ASSOC);



        // Här skickar vi in många värden. 


        echo "<hr>Result Count = " . count($result) . "<hr>";
        $seats_arr = [];
        foreach($result as $section) {

            // echo " <hr> Sektion : " . $section['arenaSectionId'];
            // echo " Antal säten: " . $section['row_nrOfSeats'];
            // echo "<br><hr>  ";
            $sectionId = $section['id'];
        
            for($i = 1; $i <= $section['row_nrOfSeats']; $i++) {
                echo "<hr>Rad: " . $section['id'] . "<br>";
                echo "Plats: " . $i . "<hr>";
                $seats_arr [] = "($sectionId, $i)";



            }


            // for($i = 0; $i < count)

            
        }
        $this->prnt($seats_arr);

        $seats_string = implode(',', $seats_arr);

        echo $seats_string;

        $sql_insert = ("INSERT INTO arenaSectionRowSeats (arenaSectionRowId, seat) 
        VALUES $seats_string");
        $stmt_insert = $this->_db->prepare($sql_insert);
        $stmt_insert->execute();

    }

}





/**
 * Alltså: 
 * För varje sektion, vill vi:
 * 
 * För varje kolumnnamn vill vi:
 *  - Hämta antalet rader som ska skapas för kolumnen, 
 */





