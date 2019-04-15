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


    <script src="../include/js/cart.js" async></script>

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
            <h1>Thank you for your purchase!</h1>

            <?php
            // Hämta från cookien
            $ids = explode(",", $_COOKIE["cart"]);
            
            $purchase_service = new Purchaser;

            function is_sold() {
                return false; // TODO
            }

            // Se till att vi inte köper dubletter
            $purchasable_tickets = array_filter($ids, function($id) {
                return !$purchase_service->is_sold($id);
            });

            print_r($purchasable_tickets);

            // Registrera köp i databasen
            $purchase_service.register_purchase($purchasable_tickets);

            // Töm cart cookien
            ?>
            </table>
        </main>
        
    </div>


</body>
</html>