
<?php
require_once '../../includeAll/klasser/db.php';
class Customers 
{
    private $_db;
    public $is_logged_in = false;
    public $columnNames, $table;   


    function __construct() {
        $db = new DB();
        $this->_db = $db->pdo;
    }

    /** 
     * Här skapar vi inputfält så kund kan skapa konto.
     * Tar emot argumentet Table vilket är vilken tabell vi ska göra något med i databasen. 
     */
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
            if($col[0] != 'id') {
                $columns [] = $col[0];
                if($col[0] === 'password') {
                    echo "<div class=''><input type='password' placeholder='$col[0]' name='$col[0]'></div>";   
                }
                elseif($col[0] === 'email') {
                    echo "<div class=''><input type='email' placeholder='$col[0]' name='$col[0]'></div>";   
                }
                 else {
                    echo "<div class=''><input type='text' placeholder='$col[0]' name='$col[0]'></div>";   
                }
            }
        }
        // Här gör vi om columns från en array till en sträng som innehåller alla kolumner. 
        $columns = implode(', ', $columns);
        return $columns;
    }

    /**
     * Funktion som tar emot två argument.
     * Table är tabellen för vi ska skicka in data till. 
     * Columns är vilka kolumner i tabellen vi ska skicka in data till. 
     * Med hjälp av denna funktion skapar vi ett konto. 
     */
    public function createAccount($table, $columns)
    { 
        // Här hämtar vi kolumnerna från angiven tabell. 
        $sql = "SHOW COLUMNS FROM $table";
        $stmtGetColumns = $this->_db->prepare($sql); 
        $stmtGetColumns->execute();
        $tableColumns = $stmtGetColumns -> fetchAll(PDO::FETCH_NUM);
    
        // Här hämtar vi värdena som
        $inputValues = array();
        foreach($tableColumns as $value) {
            if($value[0] != 'id') {
                
                if($value[0] != 'password' && $value[0] != 'username') {

                    $inputValues [] = filter_input(INPUT_POST, $value[0]);
                } 
                else if($value[0] == 'username') {
                    $inputValues [] = filter_input(INPUT_POST, $value[0]);

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
                else {

                    $pass = filter_input(INPUT_POST, $value[0]);
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

        $user = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_MAGIC_QUOTES);
        $pass = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_MAGIC_QUOTES);

        if($user === 'Soft Delete') {
            echo "noice try m8";
            return false;
        }
        else {
       
            // Hämta lösenordet koppålat till användarnamnet. 
            $sql = "SELECT password, id 
                    FROM $table 
                    WHERE username = ?";
                    
            $stmt = $this->_db->prepare($sql);
            $stmt->bindValue(1, $user);
            $stmt->execute();
            // Fetchcolumn hämtar ett värde istället för en array i en array. 
            $result = $stmt->fetch(PDO::FETCH_NUM);
            $hash = $result[0];
            $customerId = $result[1];
            // Verfifiera att lösenordet stämmer överens med hash.
            $this->is_logged_in = password_verify($pass, $hash);

            if($this->is_logged_in) {
                $_SESSION['logged_in'] = true;
                $_SESSION['user'] = "$user";
                $_SESSION['user_id'] = $customerId;

                foreach($_SESSION as $key => $value) {
                    echo "Sessionvärde: $key : $value <br>";
                }
            }
            return $this->is_logged_in; 
        }
    }

    public function view($table) 
    {
        
        $user = $_SESSION['user'];
        
        $stmt2 = $this->_db->prepare("SELECT * FROM $table WHERE username = :user");
        $stmt2->execute([':user' => $user]); 
        $result = $stmt2->fetchAll(PDO::FETCH_ASSOC);     
    
        foreach($result as $col) {
            foreach($col as $col => $value) {  
                if($col != 'id') { 

                    if($col == 'password') {
                        echo "$col <br><div> <input type='password' value='' name='$col'></div>";   

                    } else {
                    echo "$col <br><div class='col-3 input-effect'> <input class='effect-19' type='text' value='$value' name='$col'></div>";   
                    }
                }
            }
        }
        echo "<input type='submit' value='Ändra' name='editUser'>";
    }




    public function myAccount() {
        $customerId = $_SESSION['user_id'];

        $sql = "SELECT * FROM customers
                WHERE id = $customerId;";
        $stmt = $this->_db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);


        foreach($result as $key => $value) {
            if($key != 'id') {

                if($key === 'email') {
                    echo "<br> $key <br><input type='email' name='$key' value='$value'>";
                }
                else if($key === 'password') {
                    echo "<br> $key <br><input type='password' name='$key' value='$value'>";
                }
                else {
                    echo "<br> $key <br><input type='text' name='$key' value='$value'>";
                }
            }
        }
    }

    public function get_db_column_names($table) 
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
    
    public function update_account() {
        $this->get_db_column_names('customers');
        $customerId = $_SESSION['user_id'];
        $inputData = array();
        foreach($this->columnNames as $elem) {         
            if($elem == 'email') 
            {   
                // Hämtar den email som skrevs in. 
                $original_email = $_POST["$elem"];
                // Filtrerar bort dåliga tecken. 
                $clean_email = filter_input(INPUT_POST, $elem, FILTER_SANITIZE_EMAIL);
                // Validerar att: 1. Att mailen inte förändrades när vi filtrera bort dåliga tecken.
                // 2. Att det är en giltig email.
                if($original_email == $clean_email && 
                filter_var($clean_email, FILTER_VALIDATE_EMAIL)) {   
                    $inputData [] = $clean_email;
                }
                else  {
                    echo "emailen suger <br>";
                    return false;
                }
            }
            else if($elem === 'username') {
                $inputData [] = filter_input(INPUT_POST, $elem, FILTER_SANITIZE_MAGIC_QUOTES);
                $username = end($inputData);

                // Här kollar vi om användarnamnet redan finns. 
                $sql = "SELECT * FROM $this->table WHERE username = '$username'";
                $checkUsername = $this->_db->prepare($sql);
                $checkUsername->execute();
                $checkUsernameResult = $checkUsername->fetchColumn();
                if($checkUsernameResult) {
                    echo "<br>Användarnamnet finns redan <br>";
                    return false;
                }
            }
            else if($elem == 'password') {
                $checkIfNew = "SELECT password FROM customers
                                WHERE id = $customerId;";
                $checkPass = $this->_db->prepare($checkIfNew);
                $checkPass->execute();
                $res = $checkPass->fetch(PDO::FETCH_COLUMN);
                $pass = filter_input(INPUT_POST, $elem, FILTER_SANITIZE_MAGIC_QUOTES);
                    if($pass !== $res) {
                        $hash = password_hash($pass, PASSWORD_DEFAULT);
                        $inputData [] = $hash;
                    } else {
                        $inputData [] = $pass;
                    }
            }
            else { 
                $inputData[] = filter_input(INPUT_POST, $elem, FILTER_SANITIZE_MAGIC_QUOTES);
            }


        }
       
        // Här lagrar vi en placeholder för varje värde vi ska skicka in.
         $placeholders = [];
         for($i = 0; $i < count($inputData); $i++) {
             if($i < (count($inputData)-1)) {
                $placeholders [] = ' ?, ';
             } else {
             $placeholders [] = ' ?';
             }
         }

        //  columnnames är tabellens kolumnnamn som vi använder.
        // Här kombinerar vi de som nyckel => värde. 

        $key_value = array_combine($this->columnNames, $placeholders);

        //  Här lagrar vi våra nyckel=>värden som en sträng.
         $update_string= '';
         foreach($key_value as $key => $value) {
            $update_string .= $key . ' = ' . $value;
         }


         $sql_update = "UPDATE customers
                        SET $update_string 
                        WHERE id = $customerId;";
          
          $stmt = $this->_db->prepare($sql_update);

        //  Här binder vi värdet till placeholdersna
         $i = 1;
         foreach($inputData as $value) {
             $stmt->bindValue($i, $value);
             $i++;
         }
         
         $stmt->execute();  
         return true;
    }

    // Om användaren tar bort sitt konto så tar vi bort känslig information, samt säger att användaren inte längre existerar. vi tar inte bort användaren.      
    public function soft_delete() {
        $this->get_db_column_names('customers');
        $customerId = $_SESSION['user_id'];
        $softDelete = 'Soft Delete';    
        
        // Här lagrar vi en placeholder för varje värde vi ska skicka in.
        $placeholders = [];
        for($i = 0; $i < count($this->columnNames); $i++) {
            if($i < (count($this->columnNames)-1)) {
               $placeholders [] = ' ?, ';
            } else {
            $placeholders [] = ' ?';
            }
        }

        //  columnnames är tabellens kolumnnamn som vi använder.
        // Här kombinerar vi de som nyckel => värde. 
        $key_value = array_combine($this->columnNames, $placeholders);
        //  Här lagrar vi våra nyckel=>värden som en sträng.
        print_r($key_value);
         $update_string= '';
         foreach($key_value as $key => $value) {
            $update_string .= $key . ' = ' . $value;
         }
         $sql_update = "UPDATE customers
                        SET $update_string 
                        WHERE id = $customerId;";
          $stmt = $this->_db->prepare($sql_update);

        //  Här binder vi värdet till placeholdersna
         $i = 1;
         for($i = 1; $i <= count($this->columnNames); $i++) {
             echo "<hr>index = $i <br>";
             echo " Värde = $softDelete <br><hr>";
             $stmt->bindValue($i, $softDelete, PDO::PARAM_STR);
         }
        $stmt->execute();
        $_SESSION = array();
        return true;
    }
}

