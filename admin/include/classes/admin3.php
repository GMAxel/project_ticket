
<?php

if(isset($_POST['firstname'])) {
    echo $_POST['firstname']."<br>";
    echo $_POST['lastname']."<br>";
    echo $_POST['gender']."<br>";
    echo $_POST['country'];
}


// require_once '../../includeAll/klasser/db.php';

// class Admin2 {

//     private $_db;
//     public $is_logged_in;
//     public $columnNames;
//     public $table;
//     public $last_insert_id = 'none';



//     function __construct() 
//     {
//             $db = new DB();
//             $this->_db = $db->pdo;
//     }

    
    

    

// }