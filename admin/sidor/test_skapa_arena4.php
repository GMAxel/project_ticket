<?php
    session_start();
    require_once '../include/classes/admin4.php';
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

        <progress id="progressBar" value="0" max="100"></progress>
        <h3 id="status"> Fas 1 </h3>

        <form id="multiphase" onsubmit="return false"> 

            <div id="phase1">
                Arena Name  <br>   <input type="text"   id="arenaName"  name="arenaName">  <br>
                Capacity    <br>   <input type="number" id="capacity"   name="capacity">   <br>
                Address     <br>   <input type="text"   id="address"    name="address">    <br>
                Postalcode  <br>   <input type="text"   id="postalcode" name="postalcode"> <br>
                Postalarea  <br>   <input type="text"   id="postalarea" name="postalarea"> <br>
                Region      <br>   <input type="text"   id="region"     name="region">     <br>

                <br><button type="button" onclick="processPhase1()"> 
                    Continue
                </button><br>

            </div>

            <div id="phase2">

                <input type="number" id="nrOfSections" placeholder="Antal Sektioner"><br>

                <button name="test_getSections" onclick="createSections()">
                    Create sections 
                </button><br>
                <button type="button" name="test_getSection" onclick="createSection()">
                    Create one more 
                </button><br>

                <br><button type="button" onclick="processPhase2()"> 
                    Continue
                </button><br>

            </div>


            <div id="phase3">
                <h1> fas 3 </h1>

                <!-- <input type="number" id="test_nrOfSections" placeholder="Antal Sektioner"><br>

                <button type="button" name="test_getSections" onclick="test_createSections()">
                    Create sections 
                </button><br>

                <button type="button" name="test_getSection" onclick="test_createSection()">
                    Create one more 
                </button><br> -->

                <!-- <br><button type="button" onclick="processPhase3()"> 
                    Continue
                </button><br> -->

            </div>
            <div id="phase4">
                <h1> fas 4 </h1>

                <!-- <input type="number" id="test_nrOfSections" placeholder="Antal Sektioner"><br>

                <button type="button" name="test_getSections" onclick="test_createSections()">
                    Create sections 
                </button><br>

                <button type="button" name="test_getSection" onclick="test_createSection()">
                    Create one more 
                </button><br> -->

                <!-- <br><button type="button" onclick="processPhase3()"> 
                    Continue
                </button><br> -->

            </div>
            <div id="show_all_data">

                <table>
                    <tr>
                        <th>Arena</th>
                        <th>Kapacitet</th>
                        <th>Adress</th>
                        <th>Postnummer</th>
                        <th>Postort</th>
                        <th>region</th>
                    </tr>
        
                    <tr>
                       <td id="display_arena"></td>
                       <td id="display_capacity"></td>
                       <td id="display_address"></td>
                       <td id="display_postalcode"></td>
                       <td id="display_postalarea"></td>
                       <td id="display_region"></td>
                       <td id=""></td>
                    </tr>

                </table>

                <table>
                    <tr>
                        <th>Arena</th>
                        <th>Kapacitet</th>
                        <th>Adress</th>
                        <th>Postnummer</th>
                        <th>Postort</th>
                        <th>region</th>
                    </tr>
        
                    <tr>
                       <td id="display_arena"></td>
                       <td id="display_capacity"></td>
                       <td id="display_address"></td>
                       <td id="display_postalcode"></td>
                       <td id="display_postalarea"></td>
                       <td id="display_region"></td>
                       <td id=""></td>
                    </tr>

                    <tr id="rad_data">

                    </tr>

                </table>

                
             

                <button onclick="submitForm()">Submit Data </button>
            </div>

        <form>        
    </main>
</div>




</body>
</html>





