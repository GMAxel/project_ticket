document.addEventListener("DOMContentLoaded", function() { 

    function _($elementId) {
        return document.getElementById($elementId);
    }

    let cartTable = _('tablecart');
    let CART_COOKIE_PREFIX = 'cart=';
    let cartItems = [];
    let events = JSON.parse(_('events').value);
    let tickets = JSON.parse(_('all_tickets').value);

    // 
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
    getCartItems().forEach(addToCart);
});
