<?php
    session_start();
    require_once '../include/classes/admin.php';


// if(isset($_GET['showSections'])) {
//     $user = new Admin();

//     $user->test_createArena();
// }


    ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Startsida</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../include/layout/header/header.css">
    <link rel="stylesheet" type="text/css" media="screen" href="../include/layout/nav/nav.css">
    <link rel="stylesheet" type="text/css" media="screen" href="../include/layout/varukorg/varukorg.css">
    <link rel="stylesheet" type="text/css" media="screen" href="../include/layout/search/search.css">
    <link rel="stylesheet" type="text/css" media="screen" href="../include/layout/logo/logo.css">


    <link rel="stylesheet" type="text/css" media="screen" href="../include/layout/main/startsida.css">


    <link rel="stylesheet" type="text/css" media="screen" href="../include/layout/parentgrid.css">
    <script src="main.js"></script>
</head>
<body>
    
</body>
</html>





<div class="gridContainer"> 

<?php 
    require_once '../include/layout/nav/nav.php';
    require_once '../include/layout/footer/footer.php';
    require_once '../include/layout/search/search.php';
    require_once '../include/layout/logo/logo.php';

?>

<main class="gridItem"> 
    <?php


    $user = new Admin();
    // $user->test_callProc('test');

    // if(!isset($_GET['showSections']) ) {

        echo "<h2> Arena </h2>
        <form method='post'>";
            $user->test_hämtaInputs('arenas');
            $user->test_createTableInputs();
        echo "<input type='submit' name='showSections' value='Spara'>
        </form>";

        if(isset($_GET['showSections'])) {
                $user->test_createUser();

        }
    // }

    // if(isset($_GET['showSections']) && !isset($_GET['showRows'])) {
        // Om den är satt så kallar vi op en funktion som skapar en ny arena, samt returnerar det senast inskickade ID. 
        // $user->createAccount('arenas');

        echo "<h2> Sektioner </h2> 
        <form>";
            $user->test_hämtaInputs('arenaSections');
            $user->test_createTableInputs();
        echo "<input type='submit' name='showRows' value='spara'>
        </form>";
    // }
    // if(isset($_GET['showRows'])) {
        echo "<h2> Rader </h2>";
        $user->test_hämtaInputs('arenaSectionRows');
        $user->test_createTableInputs();
    // }
    // echo "<h2> Platser </h2>";
    // $user->test_hämtaInputs('arenaSectionRowSeats');
    // $user->test_createTableInputs();


    // Först ska vi skapa en arena. Sen ska vi skapa sektioner för den arenan, sen ska vi välja sektion och skapa rader för den arenan, sen utifrån det skapas det automatiskt platser. 



    ?>
</main>
</div>


