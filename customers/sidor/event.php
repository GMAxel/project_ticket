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

            <?php 
                $event = new Events;

                if(isset($_GET['event'])){
                    $event->show_event($_GET['event']);
                    $event->display_tickets($_GET['event']);
                }
            ?>

          
            
            <form>
                <div id="event_container"></div>
                <input type="submit" name="displayRows" 
                value="Visa Raderna" onclick="display_rows()">
                
            </form>

                <?php

                if(isset($_GET['displayRows'])) {
                    echo "ja";
                    $event = new Events;
                    $event->display_event($_GET['chosen_section']);
                }
                ?>

<table id="ticket_table" style="margin:auto;">
               <tr id="table_headers"> </tr>

                
            </table>
        </main>
        
    </div>

    <script>
        function _($elementId) {
            return document.getElementById($elementId);
        }
    
        // Event info
        let event_info_json = _('event_info').value;
        var event_info = JSON.parse(event_info_json);
        console.log(event_info);

        Object.keys(event_info[0]).forEach(function(key) {
            console.log(key, event_info[0][key]);
            let p = document.createElement('p');
            p.innerHTML =key + ': ' +  event_info[0][key];
            _('event_container').appendChild(p);
        });

        
        // Biljetter
        let tickets_json =  _('event_tickets').value;
        var all_tickets = JSON.parse(tickets_json);
        console.log(all_tickets);

        let event_container = _('ticket_table');

        let tr_th = document.createElement('tr');
        event_container.appendChild(tr_th);

        Object.keys(all_tickets[0]).forEach(function(key) {
            console.log(key, all_tickets[0][key]);
            let th = document.createElement('th');
            let td_th = document.createElement('td');
            tr_th.appendChild(th);

            td_th.innerHTML = key;
            th.appendChild(td_th);
        });

        let th = document.createElement('th');

        for(let i = 0; i < all_tickets.length; i++) {
            var tr = document.createElement('tr');
            event_container.appendChild(tr);


            Object.keys(all_tickets[i]).forEach(function(key) {
                let td = document.createElement('td');
                td.innerHTML = all_tickets[i][key];
                tr.appendChild(td);

            });
            let button = document.createElement('button');
            button.innerHTML = 'Lägg till i varukorg';
            button.setAttribute('data-ticketId', i);
            tr.appendChild(button);
            button.addEventListener('click', function(event) {
                
                console.log(all_tickets);
                addToCart(all_tickets[i].id);
            });
        }   

    
    </script>

</body>
</html>