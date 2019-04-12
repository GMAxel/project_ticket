<?php
    session_start();
    // require_once '../include/classes/admin4.php';
    // require_once '../include/classes/admin.php';
    // require_once '../include/classes/admin4.php';
        require_once '../include/classes/admin5.php';


    

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
    <script src="../include/js/multi_step_form3.js"></script>

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

        <form id="multiphase" onsubmit="return false"> 

            <div id="phase1">
                <div id="phase_1_input-container"> 
                </div>
     

                <br><button type="button" onclick="processPhase1()"> 
                    Continue
                </button><br>

                <button id="btnSetCookie"> Set cookie </button>
                <button id="btnSetCookieArray"> Set Cookie array </button>
                <button id="btnShowCookies"> Show Cookies</button>
                <button id="btnDeleteCookie"> Delete Cookie (foo) </button>

            </div>

            <div id="phase2">
                <input type="number" id="nrOfSections" placeholder="Antal Sektioner"><br>
                <button name="test_getSections" onclick="createSections()">
                    Create sections 
                </button>
                <div id="phase_2_input-container"> 
                </div>
                <!-- <button type="button" name="test_getSection" onclick="createSection()">
                    Create one more 
                </button><br> -->

                <br><button type="button" id="phase2_continue" onclick="processPhase2()"> 
                    Continue
                </button><br>

            </div>


            <div id="phase3">
                <h1> fas 3 </h1>
                <div id="phase3_input_container">
                </div>

                <button onclick="processPhase3()">Continue</button> 


            </div>
            
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

                <button onclick="submitForm()"> Skapa Arena </button>
            </div>

        <form>        
    </main>
</div>




</body>
</html>





