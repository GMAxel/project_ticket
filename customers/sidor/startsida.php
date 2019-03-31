<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Startsida Customers</title>
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
    <div class="gridContainer">

        <?php 
        require_once '../include/layout/header/header.php';
        require_once '../include/layout/nav/nav.php';
        require_once '../include/layout/varukorg/varukorg.php';
        require_once '../include/layout/footer/footer.php';
        require_once '../include/layout/search/search.php';
        require_once '../include/layout/logo/logo.php';

        require_once '../include/classes/customer.php';

        ?>

        <main class="gridItem">  
            <!-- Event med flest köpa biljetter -->
            <h1>Populära Event</h1>
            
            <div class="flexContainerStartsida">
                <h2><a href="#"> AIK-DIF (DATUM) </a></h2>
                <!-- Skriv ut event som är inom 2 månader? -->
                <!-- Datum etc skrivs ut på eventet.  -->
                <h2><a href="#"> DIF-AIK (DATUM) </a></h2>
                <h2> <a href="#">HIF-AIK (DATUM) </a></h2>
            </div>
        </main>
        
    </div>

</body>
</html>