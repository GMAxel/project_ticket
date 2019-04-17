<?php
    session_start();
    require_once '../include/classes/admin5.php';
    require_once '../include/classes/arena.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Startsida</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../include/layout/nav/nav.css">
    <link rel="stylesheet" type="text/css" media="screen" href="../include/layout/search/search.css">
    <link rel="stylesheet" type="text/css" media="screen" href="../include/layout/logo/logo.css">
    <link rel="stylesheet" type="text/css" media="screen" href="../include/layout/main/test_skapa_arena_4.css">
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

    <main class="gridItem"> 
        <progress id="progressBar" value="0" max="100"></progress>
        <h3 id="status"> Fas 1 </h3>

        <!-- Flersidigt formulär. -->
        <form method="post" name="multiphase" id="multiphase"> 
            <!-- Fas 1 -->
            <div id="phase1">
                <div id="phase_1_input-container"></div>
                <br>
                <button type="button" id="processPhase1"> 
                    Continue
                </button>
                <br>
            </div>

            <!-- Fas 2 -->
            <div id="phase2">
                <input type="number" id="nrOfSections" name="nrOfSections" placeholder="Antal Sektioner"><br>
                <button type="button" name="test_getSections" id="createSections">
                    Create sections 
                </button>
                <div id="phase_2_input-container"></div>
                <br>
                <button type="button" id="phase2_continue"> 
                    Continue
                </button>
                <br>
            </div>

            <!-- Fas 3 -->
            <div id="phase3">
                <h1> fas 3 </h1>
                <div id="phase3_input_container"></div>
                <button type="button" id="processPhase3">Continue</button> 
            </div>
            
            <!-- Fas 4 -->
            <div id="phase4">
                <h1> fas 4 </h1>
            </div>

            <div id="show_all_data">    
                <table id="show_arena_table">
                </table>

                <table id="show_section_table">
                </table>

                <table id="show_row_table">
                </table>              

                <?php if(isset($_POST['skapa_arena'])){
                    $user = new Admin_test();

                    if($user->if_arena_taken()) {
                        echo "Arenaname is already in use";
                    }
                    else {
                        // Här skapar vi arenan
                        $columns = $user->test_getColumnNames('arenas');
                        $arenaId  = $user->test_createUser2();                  

                        // här skapar vi sektioner. 
                        $arena = new Arena();
                        $nrOfSections = $_POST['nrOfSections'];
                        $arena->test_getColumnNames('arenaSections');
                        $section_id_arr = $arena->insert_rows($nrOfSections, $arenaId);
                        
                        $nrOfRows = (int)$_POST['sum_rows'];
                    
                        // Här skapar vi rader
                        $arena->test_getColumnNames('arenaSectionRows');
                        $arena->insert_many_rows_2($section_id_arr);

                        // Här skapar vi seats
                        $arena->insert_seats($arenaId);
                    }
                } ?>

                <input type="submit" name="skapa_arena" value="php_skap Arena">
            </div>
        </form>        
    </main>
</div>
</body>
</html>





