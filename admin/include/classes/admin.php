
<?php
require_once '../../includeAll/klasser/db.php';

class Admin {

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

    public function test_createArena() 
    {

        $inputData = array();
        foreach($this->columnNames as $elem) {


            // echo $elem . "<br>";
            // var_dump(filter_input(INPUT_POST, $elem));

         
            if($elem == 'email') 
            {   
                // Hämtar den emial som skrevs in. 
                $original_email = $_POST["$elem"];

                // Filtrerar bort dåliga tecken. 
                $clean_email = filter_input(INPUT_POST, $elem, FILTER_SANITIZE_EMAIL);

                // Validerar att: 1. Att mailen inte förändrades när vi filtrera bort dåliga tecken.
                // 2. Att det är en giltig email.
                if($original_email == $clean_email && filter_var($clean_email, FILTER_VALIDATE_EMAIL)) 
                {   
                    $inputData [] = $clean_email;
                }
                else 
                {
                    echo "emailen suger <br>";
                }
            }

            else if($elem == 'password') 
            {
                $pass = filter_input(INPUT_POST, $elem, FILTER_SANITIZE_MAGIC_QUOTES);
                $hash = password_hash($pass, PASSWORD_DEFAULT);
                $inputData [] = $hash;
            }

            else 
            { 
                $inputData[] = filter_input(INPUT_POST, $elem, FILTER_SANITIZE_MAGIC_QUOTES);
            }


        }
        // if($elem == 'arenaId')

        $this->last_insert_id = $this->_db->lastInsertId();

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

    public function test_hämtaInputs($table) 
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
    public function test_createTableInputs() {
       // Här hämtar vi kolumnerna från angiven tabell. 
       
    //    echo  ($this->_db->lastInsertId());

        // Här skapar vi en input för varje kolumn i databasen som ska få information. 
        $columns = array();

        foreach($this->columnNames as $col) 
        {
            if($col != 'id'  && $col != 'arenaId' && $col != 'arenaSectionId') {
                echo  "<br> 1. = " . $col;

                $columns [] = $col;
                if($col[0] != 'password') {
                echo "<div class=''><input type='text' placeholder='$col' name='$col'></div>";   
                } else {
                    echo "<div class=''><input type='password' placeholder='$col' name='$col'></div>";   
                }
            }
            else if ($col == 'arenaId') {
                echo  "<br> 2. = " . $col;
                $columns [] = $col;
                $sqlArenas = "SELECT id, name FROM arenas";
                $getArenas = $this->_db->prepare($sqlArenas);
                $getArenas->execute();
                $arenas = $getArenas->fetchAll(PDO::FETCH_NUM);


                echo "<div class=''>
                        <select name='arenaId'>
                            <option> Välj $col </option>";
                foreach ($arenas as $arena) {              
                    echo $arenas;
                echo "<option value='$arena[0]'>$arena[1]</option>";
                }
                echo "</select>
                    </div>";                   
                
            }
            else if ($col == 'arenaSectionId') {
                echo  "<br> 2. = " . $col;
                $columns [] = $col;
                $sqlArenas = "SELECT s.id, s.name FROM arenaSections AS s
                            JOIN arenas AS a ON a.id = s.arenaId
                            WHERE arena = ";
                $getArenas = $this->_db->prepare($sqlArenas);
                $getArenas->execute();
                $arenas = $getArenas->fetchAll(PDO::FETCH_NUM);


                echo "<div class=''>
                        <select name='sektionId'>
                            <option> Välj Sektion </option>";
                foreach ($arenas as $arena) {              
                    echo $arenas;
                echo "<option value='$arena[0]'>$arena[1]</option>";
                }
                echo "</select>
                    </div>";                   
                
            }
        }

        // echo "<input type='submit' name='create_$table' value='Skapa $table'";
        // Här gör vi om columns från en array till en sträng som innehåller alla kolumner. 
        $columns = implode(', ', $columns);
        return $columns;
    }



    // test call procedure
    public function test_callProc($firstname){

        $sql = "SELECT name, capacity FROM arenas WHERE name = 'friends' ";

        $sql2 = "SELECT id, arenaId, section, nrOfSeats FROM arenaSections WHERE arenaId = 4 
                JOIN ";

        $sql3 = "SELECT * FROM arenaSectionRows";

        // a.nrOfSeats, a.name, s.section, s.nrOfSeats, r.row, r.nrOfSeats

        // HÄMTAR KUNDENS PLATS. 
        $sql4 = "SELECT a.name AS 'Arena', s.section AS 'Sektion', r.row AS 'Rad', rs.seat
        FROM arenaSectionRows AS r
                    JOIN arenaSections AS s ON s.id = r.arenaSectionId
                    JOIN arenas AS a ON a.id = s.arenaId
                    JOIN arenaSectionRowSeats AS rs ON rs.arenaSectionRowid = r.id;

                    WHERE a.name = 'friends'";


        // Hämtar alla rader och sektioner som tillhör specifik arena. 
        $sql5 = "SELECT r.row AS 'Rad', r.nrOfSeats, r.id
        FROM arenaSectionRows AS r
                    JOIN arenaSections AS s ON s.id = r.arenaSectionId
                    JOIN arenas AS a ON a.id = s.arenaId
                    WHERE a.name = 'friends'";




        $stmt = $this->_db->prepare($sql4);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo " <hr>";

        echo "<table>";
        echo "<tr>";
        echo "<th> __________ Arena  </th>";
        echo "<th> __________ Sektion  </th>";
        echo "<th> __________ Rad  </th>";
        echo "<th> __________ Plats __________  </th><br>";

        echo "</tr>";

        foreach($result as $row) {
            // echo $row[0];
            echo "<tr>";

            foreach($row as $val) {
                echo "<td>$val</td>";

            }
            echo "</tr>";

        }
        echo "</table>";
        echo " <hr>";

        $stmt = $this->_db->prepare($sql5);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // echo "<pre>";
        // print_r($result);
        // echo "</pre>";

        $något = array();
        foreach($result as $row){

            // echo "<pre> RAD:";
            // print_r($row['Rad']);
            // echo "</pre>";

            // echo "<pre> NrOfSeats:";
            // print_r($row['nrOfSeats']);
            // echo "</pre>";
            // echo "<br>rad (utanför Loop) = " . $row['Rad'] . " id = ".  $row['id'];

            
            for($x = 1; $x <= $row['nrOfSeats']; $x++) {
                // echo "<br>rad (I Loop) = " . $row['Rad'] . " id = ".  $row['id'];
                $något [] = "($row[id], $x)";
            }
            // echo "<pre>";
            // print_r($row);
            // echo "</pre>";
        }



        $seats = (implode(",", $något));

        // HÄR
        $insertSql = ("INSERT INTO arenaSectionRowSeats (arenaSectionRowId, seat) VALUES $seats");
        $stmt = $this->_db->prepare($insertSql);
        $stmt->execute();




        // echo "<pre>";
        // print_r($result);
        // echo "</pre>";

        // $sql = "CALL test_admin(?, ?)";
        // $stmt = $this->_db->prepare($sql);

        // $stmt->bindValue(1, $firstname);
        // $stmt->bindValue(2, $ret);



        // $stmt->execute();
        // $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // echo "<pre>";
        // print_r($result);
        // echo "</pre>";
        
    }


    // afkaksdj akjk a
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

    public function test_createInputs() {
        echo "<hr><br>";
        foreach($this->columnNames as $column) {
            
            
                
            if($column == 'email') 
            { 
                echo "<input type='text' name='email' placeholder='email'>";
            }
            else if($column == 'password') 
            {
                echo "<input type='password' name='password' placeholder='password'>";

            }
            else 
            { 
                echo "<input type='text' name='$column' placeholder='$column'>";
            }
        }
        
        echo "<br><hr>";
    }

    public function test_createUser() {
        $inputData = array();
        var_dump($this->columnNames);
        foreach($this->columnNames as $elem) {
            // echo $elem . "<br>";
            // var_dump(filter_input(INPUT_POST, $elem));

         
            if($elem == 'email') 
            {   
                // Hämtar den emial som skrevs in. 
                $original_email = $_POST["$elem"];

                // Filtrerar bort dåliga tecken. 
                $clean_email = filter_input(INPUT_POST, $elem, FILTER_SANITIZE_EMAIL);

                // Validerar att: 1. Att mailen inte förändrades när vi filtrera bort dåliga tecken.
                // 2. Att det är en giltig email.
                if($original_email == $clean_email && filter_var($clean_email, FILTER_VALIDATE_EMAIL)) 
                {   
                    $inputData [] = $clean_email;
                }
                else 
                {
                    echo "emailen suger <br>";
                }
            }

            else if($elem == 'password') 
            {
                $pass = filter_input(INPUT_POST, $elem, FILTER_SANITIZE_MAGIC_QUOTES);
                $hash = password_hash($pass, PASSWORD_DEFAULT);
                $inputData [] = $hash;
            }

            else 
            { 
                $inputData[] = filter_input(INPUT_POST, $elem, FILTER_SANITIZE_MAGIC_QUOTES);
            }


        }

        // Här gör vi om columnNames till en sträng så vi kan använda den i $sql. 
        $columnNames = implode(', ', $this->columnNames);

         // här skapar vi en string som har lika många ? som antal värden vi hämtat. 
         $placeholders = rtrim(str_repeat('?, ', count($inputData)), ', ');

         // här gör skapar vi en querystring som innehåller kolumnerna från db, samt lika många placeholders.
         $sql = "INSERT INTO $this->table ($columnNames) VALUES ($placeholders)";
         $stmt= $this->_db->prepare($sql);
 
 
         // Här binder vi värdet till placeholdersna
         $i = 1;
         var_dump($inputData);

         foreach($inputData as $value) {
             $stmt->bindValue($i, $value);
             $i++;
         }
         
         $stmt->execute();        

    }


    public function createInputs($table) 
    {
        // Här hämtar vi kolumnerna från angiven tabell. 
        $sql = "SHOW COLUMNS FROM $table";
        $stmtGetColumns = $this->_db->prepare($sql); 
        $stmtGetColumns->execute();
        $tableColumns = $stmtGetColumns -> fetchAll(PDO::FETCH_NUM);
     
        // Här skapar vi en input för varje kolumn i databasen som ska få information. 
        $columns = array();
        foreach($tableColumns as $col) 
        {
            if($col[0] != 'id'  && $col[0] != 'arenaId') {
                $columns [] = $col[0];
                if($col[0] != 'password') {
                echo "<div class=''><input type='text' placeholder='$col[0]' name='$col[0]'></div>";   
                } else {
                    echo "<div class=''><input type='password' placeholder='$col[0]' name='$col[0]'></div>";   
                }
            }
            else if ($col[0] == 'arenaId') {
                $columns [] = $col[0];
                $sqlArenas = "SELECT id, name FROM arenas";
                $getArenas = $this->_db->prepare($sqlArenas);
                $getArenas->execute();
                $arenas = $getArenas->fetchAll(PDO::FETCH_NUM);


                echo "<div class=''>
                        <select name='arenaId'>
                            <option> Välj Arena </option>";
                foreach ($arenas as $arena) {              

                echo "<option value='$arena[0]'>$arena[1]</option>";
                }
                echo "</select>
                    </div>";                   
                
            }
        }
        // echo "<input type='submit' name='create_$table' value='Skapa $table'";
        // Här gör vi om columns från en array till en sträng som innehåller alla kolumner. 
        $columns = implode(', ', $columns);
        return $columns;
    }


    public function createAccount($table, $columns)
    { 
        // Här hämtar vi kolumnerna från angiven tabell. 
        $sql = "SHOW COLUMNS FROM $table";
        $stmtGetColumns = $this->_db->prepare($sql); 
        $stmtGetColumns->execute();
        $tableColumns = $stmtGetColumns -> fetchAll(PDO::FETCH_NUM);

        // $LOL = $stmtGetColumns -> fetchAll(PDO::FETCH_COLUMN);
        // print_r($lol);

    
        // Här hämtar vi värdena som
        $inputValues = array();
        foreach($tableColumns as $value) {
            
            if($value[0] != 'id') {

                
                if($value[0] != 'password' && $value[0] != 'username') {

                    $inputValues [] = filter_input(INPUT_GET, $value[0]);
                } 
                else if($value[0] == 'username') {
                    $inputValues [] = filter_input(INPUT_GET, $value[0]);

                    $username = end($inputValues);
                    $sql = "SELECT * FROM $table WHERE username = '$username'";
                    $checkUsername = $this->_db->prepare($sql);
                    $checkUsername->execute();
                    $checkUsernameResult = $checkUsername->fetchColumn();
                    if($checkUsernameResult) {
                        echo "<br>Användarnamnet finns redan <br>";
                        return false;
                    }
                    else {
                        // Här kallar vi på logga in funktionen, så att kunden loggas in om den lyckades skapa konto. 
                    }
                    
                }
                // else if($value[0] == 'arenaId') {
                    // $sqlArenas = "SELECT name FROM arenas";
                    // $getArenas = $this->_db->prepare($sqlArenas);
                    
                // }
                

                else {

                    $pass = filter_input(INPUT_GET, $value[0]);
                    $hash = password_hash($pass, PASSWORD_DEFAULT);
                    $inputValues [] = $hash;
                }
            }
        }
            
        // här skapar vi en string som har lika många ? som antal värden vi hämtat. 
        $placeholders = rtrim(str_repeat('?, ', count($inputValues)), ', ');

        // här gör skapar vi en querystring som innehåller kolumnerna från db, samt lika många placeholders.
        $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        $stmt= $this->_db->prepare($sql);


        // Här binder vi värdet till placeholdersna
        $i = 1;
        foreach($inputValues as $value) {
            $stmt->bindValue($i, $value);
            $i++;
        }
        $stmt->execute();                
    }

    public function login($table) {
        
        $user = $_GET['logInUser'];
        $pass = $_GET['logInPass'];
        // Hämta lösenordet koppålat till användarnamnet. 

        $sql = "SELECT password FROM $table WHERE username = :user";
        $stmt = $this->_db->prepare($sql);
        $stmt->execute([':user' => $user]); 
        // Fetchcolumn hämtar ett värde istället för en array i en array. 
        $hash = $stmt->fetchColumn();


        // Verfifiera att lösenordet stämmer överens med hash.
        $this->is_logged_in = password_verify($pass, $hash);


        if($this->is_logged_in) {
            // $sql2 = "SELECT employeeNumber FROM employees WHERE username = :user";
            // $stmt2 = $this->db->prepare($sql2);
            // $stmt2->execute([':user' => $user]); 
            // $right = $stmt2->fetchColumn();

            // $_SESSION['userId'] = $right;
            $_SESSION['logged_in'] = true;
            $_SESSION['user'] = "$user";

            foreach($_SESSION as $key => $value) {
                echo "Sessionvärde: $key : $value <br>";
            }
            // $_SESSION['adminRight'] = "$right";
        }
        return $this->is_logged_in; 
    }

    

}