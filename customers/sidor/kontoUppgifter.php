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



        ?>
        <main class="gridItem">  
            <h1>Mitt konto</h1>

            <ul class="subMenyMinaSidor">
                <li><a href="minaSidor.php"> Biljetter </a></li>
                <li><a href="kontoUppgifter.php"> Kontouppgifter </a> </li>
            </ul>

            <div class="myTicketsContainer"> 
                
            <form>
                <div>
                    <input type="text" name="firstname" placeholder="Firstname" class="signUpInputs">
                </div>

                <div>
                    <input type="text" name="lastname" placeholder="lastname" class="signUpInputs">
                </div>

                <div>
                    <input type="text" name="email" placeholder="email" class="signUpInputs">
                </div>

                <div>
                    <input type="text" name="phone" placeholder="Telefonnummer" class="signUpInputs">
                </div>

                <div>
                    <input type="text" placeholder="username" class="signUpInputs">
                </div>
                <div>
                    <input type="password" placeholder="password" class="signUpInputs">
                </div>
                <div>
                    <input type="submit" value="Ändra konto" class="signUpInputs">
                </div>
            
           
        </form>
            </div>
                

        </main>
        
    </div>

</body>
</html>