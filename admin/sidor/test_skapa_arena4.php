<?php
    session_start();
    require_once '../include/classes/admin4.php';


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
    <!-- <link rel="stylesheet" type="text/css" media="screen" href="../include/layout/header/header.css"> -->
    <link rel="stylesheet" type="text/css" media="screen" href="../include/layout/nav/nav.css">
    <link rel="stylesheet" type="text/css" media="screen" href="../include/layout/search/search.css">
    <link rel="stylesheet" type="text/css" media="screen" href="../include/layout/logo/logo.css">


    <!-- <link rel="stylesheet" type="text/css" media="screen" href="../include/layout/main/startsida.css"> -->
    <link rel="stylesheet" type="text/css" media="screen" href="../include/layout/main/test_skapa_arena_4.css">


    <link rel="stylesheet" type="text/css" media="screen" href="../include/layout/parentgrid.css">
    <script src="../include/js/multi_step_form2.js"></script>
</head>
<body>



<div class="gridContainer"> 

<?php 
    require_once '../include/layout/nav/nav.php';
    require_once '../include/layout/footer/footer.php';
    require_once '../include/layout/search/search.php';
    require_once '../include/layout/logo/logo.php';

?>

<main class="gridItem"> 

<?php
    $user2 = new Admin4();
    $tables = array('arenas', 'arenaSections', 'arenaSectionRows', 'arenaSectionRowSeats');
    
?>           


<?php

    $i = 1;
    foreach($tables as $table) 
    { ?>
        <form action='test_skapa_arena4?lol=lol' id='multiphase' onsubmit='return false'>
            <div id='phase1'>
        <?php
        $user2->test_getColumnNames($table);
        $user2->test_showInputs();        

                    if($table == 'arenaSections') 
                    { ?>

                        <div id='sectionsContainer'>             
                            <button name='sektionerValda' onclick='chosenSections()'>
                                Get sections
                            </button>
                            <input type='hidden' name='hidden_sectionsAmount' id='hidden_sectionsAmount' value='0'>
                        </div>

                <?php } ?>

                <!-- <button onclick='processPhase$i()'>Continue</button> -->
            </div> 
            <input type="submit" value="SKICKA_<?php $i?>">

        </form>

        <?php  $i++;
    }
        ?>
    







        
    
</main>
</div>




</body>
</html>





