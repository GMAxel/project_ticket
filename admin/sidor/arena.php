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

    require_once '../include/classes/admin.php';
?>

    <div class="gridItem subMenu"> 
        <div class="subMenuContainer">
            <a href="arena.php" class="subMenuItem">Arenor</a>
            <a href="createArena.php" class="subMenuItem">Skapa Ny Arena</a>
            <a href="#" class="subMenuItem">Ändra Arena</a>
            <a href="#" class="subMenuItem">Ta bort arena</a>
        </div>
    
    </div>



<main class="gridItem"> main -> Arena
</main>
</div>


