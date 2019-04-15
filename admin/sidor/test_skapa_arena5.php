<?php
    session_start();
    // require_once '../include/classes/admin4.php';
    // require_once '../include/classes/admin.php';
    // require_once '../include/classes/admin4.php';
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
        <h1> tjo </h1>     

        <form name="skapa_platser">
            <?php 
                  
                
            ?>
            <input type="submit" name="create_seats" value="Se seats bro">
        </form>
    </main>
</div>

<?php
                if(isset($_GET['create_seats'])) {
                echo "hej"; 
            }




    ?>




</body>
</html>





