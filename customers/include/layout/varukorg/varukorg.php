<aside class="gridItem varukorg">

    <div class="cartGridContainer">
        <a href="#" class="cartGridItem imgContainer"> <img src="../imgs/cart_bigger.png"> </a>    
        
        <p class="cartGridItem cartStatus">CART</p>

        <?php
            require_once '../include/classes/events.php';

            $event = new Events;

            $event->show_events_json();
            $event->display_all_tickets();
    
        ?>


        <div class="tablecart">
            <table id="tablecart">
                <tr>
                    <th>Event</th>
                    <th>Section</th>
                    <th>Row</th>
                    <th>Seat</th>
                    <th>Pris </th>
                </tr>
            </table>
            <a href="purchase.php"><button>BUY</button></a>
        </div>
        
    </div>


</aside>

