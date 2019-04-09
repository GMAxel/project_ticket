<?php
    session_start();
    require_once '../include/classes/admin.php';
    require_once '../include/classes/admin2.php';


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
    <link rel="stylesheet" type="text/css" media="screen" href="../include/layout/main/test_skapa_arena_2.css">


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
<div class="gridItem subMenu"> 
        <div class="subMenuContainer">
            <a href="arena.php" class="subMenuItem">Arenor</a>
            <a href="createArena.php" class="subMenuItem">Skapa Ny Arena</a>
            <a href="#" class="subMenuItem">Ändra Arena</a>
            <a href="#" class="subMenuItem">Ta bort arena</a>
        </div>
    
    </div>

<main class="gridItem"> 
    <?php
        $user2 = new Admin2();

        $tables = array('arenas', 'arenaSections', 'arenaSectionRows', 'arenaSectionRowSeats');

        if(isset($_POST['action'])){
            $arenaId = $user2->test_insertToDb();
            // echo "<input type='hidden' name='arenaId' value='$arenaId'>";
        }    
    
    
       
        ?>
        
        
        


    <div class="creationProcess">
    <?php 
        
        for($x = 0; $x < count($tables); $x++) {
    ?>
        <!-- <a href="test_skapa_arena2.php?table= -->
                                            <?php
                                            // echo $x 
                                            ?>
                                            <!-- " class=""> Skapa ny  -->
                                            <?php 
                                            // echo $tables[$x] 
                                            ?> 
                                        <!-- </a> -->
        <?php } ?>

        <a href="test_skapa_arena2.php?table=0">Arena</a>
        <a href="test_skapa_arena2.php?table=1">Sections</a>
        <a href="test_skapa_arena2.php?table=2">Rows</a>
        <a href="test_skapa_arena2.php?table=3">Seats</a>


    </div>



    <div class="test_inputsContainer">
        <form method="POST">
    <?php


 
    if(isset($_GET['table'])) {  

        $x;

        if($_GET['table'] == 0) {
            echo "<h2> Arena </h2>";
            $user2->test_getColumnNames('arenas');
            $user2->test_showInputs();
            
            echo "<input type='hidden' name='action' value='Nästa'>";
            echo "<input type='hidden' name='nextTable' value='1'>";
            echo "<input type='submit' name='action' value='Nästa'>";

            if(isset($_POST['action'])){
                $arenaId = $user2->test_insertToDb();
                // echo "<input type='hidden' name='arenaId' value='$arenaId'>";
            }    
        }

        else if($_GET['table'] == 1) {
            echo "<h2> Sections </h2>";
            $user2->test_getColumnNames('arenaSections');
            $arenaId = $_POST['arenaId'];
            $user2->test_showInputs($arenaId);
            
            echo "<input type='submit' name='action' value='Nästa'>";
        }

        else if($_GET['table'] == 2) {
            echo "<h2> Rows </h2>";
            $user2->test_getColumnNames($tables[2]);
            $user2->test_showInputs();
            
            echo "<input type='submit' name='action' value='Nästa'>";
        }

        else if($_GET['table'] == 3) {
            echo "<h2> Seats </h2>";
            $user2->test_getColumnNames($tables[3]);
            $user2->test_showInputs();

            echo "<input type='submit' name='action' value='Nästa'>";
        }
        
        // $processIndex = $_GET['table'];
        // $table = $tables[$processIndex];      
    }
    ?>






    

</form>
    </div>


   



    


    
</main>
</div>


