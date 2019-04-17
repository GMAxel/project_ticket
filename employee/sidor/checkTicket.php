<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Startsida</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../include/layout/employee.css">
</head>
<body>
    
<div class="gridItem logoGridItem">
    <div class="logoContainer">
            <a href="../../../../index.php"><img src="../../includeAll/imgs/logo.png"></a>
    </div>
</div>
    <div class="gridContainer"> 
        <p class="info">
        <?php 
        require_once '../include/classes/employee.php';
        $user = new Employee();
        if(isset($_GET['action'])) {
            $ticket = $_GET['ticket_id'];
            if($user->checkIfExist()) {
                echo "Biljett: $ticket finns";
                if($user->checkIfBought('employees')) {
                    echo "<br>biljett är köpt";

                    if($user->checkIfScanned()) {
                        echo "<br>biljett är inte redan skannad";

                        if($user->scanTicket()) {
                            echo "<br><strong style='color:green;'>OK</strong>";
                        }
                        else {
                            echo "<br>Biljetten skannades inte, försök igen.";
                        }
                    }
                    else {
                        echo "<br>OBS! Biljett är redan skannad.";
                    }
                }
                else {
                    echo "<br>OBS! Biljett ej köpt";
                }
            }
            else {
                echo "<br>OBS! Biljett $ticket finns ej.";
            }
        }
        ?>
        </p>
        <main>
            <form class="log_in_form">
                <input type="text" name="ticket_id" placeholder="Ticket Id">
                <input type="submit" name="action" value="Skanna">
            </forM>
        </main>   
</body>
</html>
