<?php
    session_start();
    require_once '../include/classes/customer.php';

    if (isset($_POST['login'])) {
        $user = new Customers();

        if($user->login('customers')) {
            header('Location: startsida.php');
        } 
        else {
            echo "Inloggning misslyckad";
        }


    }

    if(isset($_POST['logOut'])) {
        $_SESSION = [];
        header('Location: startsida.php');
    }


?>


<header class="gridItem headerGridItem">
    
    <section class="headerFlexContainer">
        <!-- <div class="headerFlexItem headerFlexItem1">
        <a href="#"><img src="../../includeAll/imgs/logo.png"></a>
        </div> -->
<!-- 
        <div class="headerFlexItem headerFlexItem2">
            <form>
                <input type="text" name="search" placeholder="Sökord">
                <input type="submit" name="searchBtn" value="Sök">
            </form>            
        </div> -->

                
        <div class="headerFlexItem headerFlexItem2">
        <?php
        if(isset($_SESSION['logged_in'])) { ?>
            <div class="loggedInContainer">
                <div class="logoutContainer">
                    <form method="post">
                        <button name="logOut"> Logga ut </button>
                    </form>
                </div>
                <div class="linkContainer"> 
                    <a href="minaSidor.php">Konto </a>
                </div>  
            </div>

      <?php  }    else {   ?>
            <div class="logInContainer">
                <div class="logInOption">
                    <a href="#"> LOG IN </a>
                </div>

                <div class="logInInputs">
                    <form method="post">
                        <input type="text" name="user" placeholder="username">
                        <input type="password" name="pass" placeholder="lösenord">
                        <input type="submit" name="login" value="Log in">
                        <div><a href="skapaKonto.php">Skapa Konto </a></div>
                    </form>
                </div>
            </div>
      <?php } ?>

            <!-- <div class="loggedInContainer">
                <div class="linkContainer"> 
                    <a href="minaSidor.php">Konto </a>
                </div>  
            </div> -->

        </div>
    </section>


</header>

