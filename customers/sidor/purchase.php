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
        require_once '../include/classes/purchaser.php';
        ?>

        <main class="gridItem">

            <?php
            // Ids of tickets requsetd by customer (string).
            $cart = $_COOKIE["cart"];
            // Turn into array.
            $cart_arr = explode(',', $cart);

            print_r($cart);
            $purchase_service = new Purchaser;
            $orderId = $purchase_service->register_purchase($cart_arr);
            ?>
            </table>
        </main>
    </div>
    <script src="../include/js/cart.js"></script>
</body>
</html>