document.addEventListener("DOMContentLoaded", function() { 

    function _($elementId) {
        return document.getElementById($elementId);
    }

    let cartTable = _('tablecart');
    let CART_COOKIE_PREFIX = 'cart=';
    let cartItems = [];
    let events = JSON.parse(_('events').value);
    let tickets = JSON.parse(_('all_tickets').value);

    // Visar vad som finns i våra tickets som finns i vår cookie
    function getCartItems() {
        let cartCookie = document.cookie
            .split(';')
            .find(cookie => cookie.indexOf(CART_COOKIE_PREFIX) === 0);
        
        if(!cartCookie) {
            return [];
        } 
        return cartCookie   
            .split('=')[1]
            .split(',')
            .filter(Boolean);
    }

    // Spara det som finns i carten som en cookie 
    function storeCartItems() {
        document.cookie = CART_COOKIE_PREFIX + cartItems.join(',');
    }   

    // Tar bort från cart
    function removeFromCart(seatId) {
        if (!isInCart(seatId)) return;

        cartItems = cartItems.filter(id => id !== seatId);

        let trs = _('tablecart').querySelectorAll('tr');
        let domEl = Array.from(trs).find(tr => tr.getAttribute('data-seatId') === seatId);
        if (domEl) _('tablecart').removeChild(domEl);

        storeCartItems();
    }

    // Ser om biljetten redan finns i varukorgen
    function isInCart(seatId) {
        return cartItems.includes(seatId);
    }

    // Ritar ut biljetten i carten. 
    function drawToCart(seatId) {
        // 1. Hämta information om seat.
        let ticket = tickets.find(ticket => ticket.id === seatId);
        let eventId = ticket.eventId;
        let event = events.find(event => event.id === eventId);
        let eventName = event.name;
        let price = event.price;

        // 2. Konstruera DOM element från det här
        let tr = document.createElement('tr');
        tr.setAttribute('data-seatId', seatId);

        // Skriv ut all information för biljetten
        [
            eventName,
            ticket.Sektion,
            ticket.Rad,
            ticket.Plats,
            price,
        ].forEach(value => {
            let td = document.createElement('td');
            td.innerText = value;
            tr.appendChild(td);
        });

        let buttonTd = document.createElement('td');
        let button = document.createElement('button');
        button.textContent = '🗑️';
        button.addEventListener('click', () => {
            removeFromCart(seatId);
        });
        buttonTd.appendChild(button);
        tr.appendChild(buttonTd);
        
        cartTable.appendChild(tr);
    }

    // Lägg till biljetten i cart och spara i cookie. 
    function addToCart(seatId) {
        if (isInCart(seatId)) return;

        cartItems.push(seatId);
        storeCartItems();
        drawToCart(seatId);
    }
    // Läser vår cookie och lägger in de i carten. 
    getCartItems().forEach(addToCart);
    
    window.cart = addToCart;

    // -_______________________________
    function _($elementId) {
        return document.getElementById($elementId);
    }
    
    // Extraherar information från DOM 
    var event_info = JSON.parse(_('event_info').value);
    var all_tickets = JSON.parse(_('event_tickets').value);
    
    // Skriv ut event-informationen på sidan
    Object.keys(event_info[0]).forEach(function(key) {
        let p = document.createElement('p');
        p.textContent = key + ': ' +  event_info[0][key];
        _('event_container').appendChild(p);
    });
    
    let event_container = _('ticket_table');
    let tr_th = document.createElement('tr');
    event_container.appendChild(tr_th);
    
    // Skriv ut headers för biljetterna 
    Object.keys(all_tickets[0]).forEach(function(key) {
        let th = document.createElement('th');
        let td_th = document.createElement('td');
        tr_th.appendChild(th);
    
        td_th.innerHTML = key;
        th.appendChild(td_th);
    });
    
    // Rita upp alla biljetter från eventet. 
    all_tickets.forEach(function (ticket) {
        let tr = document.createElement('tr');
        
        Object.keys(ticket).forEach(function(key) {
            let td = document.createElement('td');
            td.innerHTML = ticket[key];
            tr.appendChild(td);
        });
    
        // Knapp för att lägga till i varukorg. 
        let button = document.createElement('button');
        button.innerHTML = 'Lägg till i varukorg';
        tr.appendChild(button);

        // button.addEventListener('click', () =>  addToCart(ticket.id));
        // eventlyssnare för att läggga till i varukorgen. 
        button.addEventListener('click', function() {
            addToCart(ticket.id);
        });
        event_container.appendChild(tr);
    })


    // -_______________________________
});
