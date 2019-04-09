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

    <script src="main.js"></script>
</head>
<body>
    





    <div class="gridContainer"> 

        <?php 
        

            require_once '../include/classes/admin.php';

            $user = new Admin();
            
            if(isset($_GET['login'])) {
                if($user->login('admin')) {
                    header('Location: startsida.php');
                }
                else {
                    echo "Fel användarnamn eller lösenord";
                };


            }
            


            
        ?>

           
        <main>
            
            <form>
                
                <input type="text" name="logInUser" placeholder="Username">
                <input type="text" name="logInPass" placeholder="Password">
                <input type="submit" name="login" value="Logga in">
            </forM>
        </main>

        





</body>
</html>
