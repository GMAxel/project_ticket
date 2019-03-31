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

        // $user = new Customers();
        // $user->registerTest('customers');


        ?>
        <main class="gridItem">  
            <h1>Skapa konto</h1>


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

                <!-- <div>
                    <input type="text" name="gata" placeholder="Gatunamn" class="signUpInputs">
                </div>

                <div>
                    <input type="text" name="gatuNr" placeholder="Gatunr" class="signUpInputs">
                </div> -->

                <div>
                    <input type="text" name="phone" placeholder="Telefonnummer" class="signUpInputs">
                </div>

                <!-- <div>
                    <input type="text" name="postnummer" placeholder="Postnummer" class="signUpInputs">
                </div>

                <div>
                    <input type="text" name="postort" placeholder="Postort" class="signUpInputs">
                </div> -->

                <div>
                    <input type="text" placeholder="username" class="signUpInputs">
                </div>
                <div>
                    <input type="password" placeholder="password" class="signUpInputs">
                </div>
                <div>
                    <input type="submit" value="Skapa konto" class="signUpInputs">
                </div>
            
           
        </form>
    </main>
        
</div>

</body>
</html>