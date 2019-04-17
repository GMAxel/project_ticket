<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Alla events Customers</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../include/layout/header/header.css">
    <link rel="stylesheet" type="text/css" media="screen" href="../include/layout/nav/nav.css">
    <link rel="stylesheet" type="text/css" media="screen" href="../include/layout/varukorg/varukorg.css">
    <link rel="stylesheet" type="text/css" media="screen" href="../include/layout/search/search.css">
    <link rel="stylesheet" type="text/css" media="screen" href="../include/layout/logo/logo.css">
    <link rel="stylesheet" type="text/css" media="screen" href="../include/layout/main/minaSidor.css">
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
        ?>
        <main class="gridItem">  
            <h1>Mitt konto</h1>

            <ul class="subMenyMinaSidor">
                <li><a href="minaSidor.php"> Biljetter </a></li>
                <li><a href="kontoUppgifter.php"> Kontouppgifter </a> </li>
            </ul>

            <div class="myTicketsContainer"> 
                
                <form method="post">
                    <?php
                        $user = new Customers();
                        $user->myAccount();

                        if(isset($_POST['changeAcc'])) {
                            if($user->update_account()){
                                echo "<script> window.location.href = window.location.href</script>";
                                echo "<br>Konto ändrat";
                                return true;
                            }
                            else {
                                echo "<br>Något gick snett - Försök igen senare";
                            }
                        }
                        if(isset($_POST['deleteAcc'])) {
                            $user->myAccount();
                            if($user->soft_delete()) {
                                header('Location:startsida.php');
                                echo "<br>Konto Borttaget";
                            }
                            else {
                                echo "<br>Något gick snett - Försök igen senare";
                            }
                        }
                    ?>
                    <br>
                    <input type="submit" name="changeAcc" value="Ändra konto">
                    <br><br>
                    <input type="submit" name="deleteAcc" value="Ta bort konto"> 
                </form>
            </div>
        </main>
        
    </div>

</body>
</html>