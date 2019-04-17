
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
    <script src="../include/js/cart.js"></script>
    <script src="../include/js/extra.js"></script>



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
        require_once '../include/classes/events.php';
        ?>

        <main class="gridItem">  

            <?php 
                $event = new Events;

                if(isset($_GET['event'])){
                    $event->show_event($_GET['event']);
                    $event->display_tickets($_GET['event']);
                }
            ?>
            <form>
                <div id="event_container"></div>
            </form>

                <?php

                if(isset($_GET['displayRows'])) {
                    $event = new Events;
                    $event->display_event($_GET['chosen_section']);
                }
                ?>

            <table id="ticket_table" style="margin:auto;">
               <tr id="table_headers"> </tr>
            </table>
        </main>
        
    </div>   
</body>
</html>