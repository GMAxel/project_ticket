
<?php
require_once '../../includeAll/klasser/db.php';
class Customers 
{
    private $_db;
    public $is_logged_in = false;

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
                if($col[0] != 'password') {
                echo "<div class=''><input type='text' placeholder='$col[0]' name='$col[0]'></div>";   
                } else {
                    echo "<div class=''><input type='password' placeholder='$col[0]' name='$col[0]'></div>";   
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
                if($value[0] != 'password') {
                    $inputValues [] = filter_input(INPUT_GET, $value[0]);
                }
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
    
}   












// funktion för att skapa konto.
// funktion för att logga in + logga ut. 
// funktion för att ta bort detaljer som kan identifiera en kund.
// Funktion för att uppdetare kontouppgifter.
// Funktion för att se köpta biljetter. 



// Hämta kolumnerna från angiven tabell.
// Visa kolumnerna i input fält.
// hämta värdena från inputfälten genom att köra en foreach med kolumnnamnen som vi satte in i inputsen.
// 
