<?php
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
    <link rel="stylesheet" type="text/css" media="screen" href="../include/layout/main/test_skapa_arena_3.css">


    <link rel="stylesheet" type="text/css" media="screen" href="../include/layout/parentgrid.css">
    <script src="../include/js/multi_step_form.js"></script>
</head>
<body>



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
        ?>           
    <div class="creationProcess">
        <a href="test_skapa_arena3.php?table=0">Arena</a>
        <a href="test_skapa_arena3.php?table=1">Sections</a>
        <a href="test_skapa_arena3.php?table=2">Rows</a>
        <a href="test_skapa_arena3.php?table=3">Seats</a>
    </div>



    <progress id="progressBar" value="0" max="100"></progress>
    <h3 id="status"> Phase 1 of 3 </h3>

    <form id="multiphase" onsubmit="return false">
        <div id="phase1">
        First Name: <input id="firstname" name="firstname"><br>
        Last Name: <input id="lastname" name="lastname"><br>
        <button onclick="processPhase1()"> Continue </button>
        </div>

        <div id="phase2">
            Gender: 
            <select id="gender" name="gender">
                <option value=""></option>
                <option value="m">Male</option>
                <option value="f">Female</option>
            </select><br>
            <button onclick="processPhase2()">Continue</button>
        </div>

        <div id="phase3">
            Country: 
            <select id="country" name="country">
                <option value="Sweden">Sweden</option>
                <option value="Norway">Norway</option>
                <option value="Finland">Finland</option>
                <option value="Denmark">Denmark</option>
            </select><br>
            <button onclick="processPhase3()">Continue</button>
        </div>

        <div id="show_all_data">
            First Name: <span id="display_fname"></span> <br>
            Last Name: <span id="display_lname"></span> <br>
            Gender: <span id="display_gender"></span> <br>
            Country: <span id="display_country"></span> <br>
            <button onclick="submitForm()">Submit Data </button>
        </div>

    </form>
        
    
</main>
</div>




</body>
</html>





