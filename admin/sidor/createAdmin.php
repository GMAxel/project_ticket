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
    <link rel="stylesheet" type="text/css" media="screen" href="../include/layout/main/submenu.css">
</head>
<body>
    <div class="gridContainer"> 
        <?php 
            require_once '../include/layout/nav/nav.php';
            require_once '../include/layout/footer/footer.php';
            require_once '../include/layout/search/search.php';
            require_once '../include/layout/logo/logo.php';
            require_once '../include/classes/admin.php';
        ?>
        <main class="gridItem">
            <h1> Skapa konto </h1>

            <form>
                <?php
                    $user = new Admin();
                    $columns = $user->createInputs('admin');
                    
                    if(isset($_GET['createAcc'])) {
                        if($user->createAccount('admin', $columns)) {
                            echo "Konto skapat";
                        };
                    }
                ?>
                
                <input type="submit" name="createAcc" value="Skapa konto">

            </form>
        </main>



        



    </div>


</body>
</html>
