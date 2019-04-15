function _($elementId) {
    return document.getElementById($elementId);
}

const cartTable = _('tablecart');
const CART_COOKIE_PREFIX = 'cart=';
let cartItems = [];
const events = JSON.parse(_('events').value);
const tickets = JSON.parse(_('all_tickets').value);

function getCartItems() {
    return document.cookie
        .split(';')
        .filter(cookie => cookie.indexOf('cart=') === 0)[0]
        .split('=')[1]
        .split(',')
        .filter(Boolean);
}

function storeCartItems() {
    document.cookie = CART_COOKIE_PREFIX + cartItems.join(',');
}   

function removeFromCart(seatId) {
    if (!isInCart(seatId)) return;

    cartItems = cartItems.filter(id => id !== seatId);

    const trs = _('tablecart').querySelectorAll('tr');
    const domEl = Array.from(trs).find(tr => tr.getAttribute('data-seatId') === seatId);
    if (domEl) _('tablecart').removeChild(domEl);

    storeCartItems();
}

function isInCart(seatId) {
    return cartItems.includes(seatId);
}

function appendToCartId(seatId) {
    // 1. Extract infromation about seat,
    const ticket = tickets.find(ticket => ticket.id === seatId);

    const { eventId } = ticket;

    const event = events.find(event => event.id === eventId);
    const eventName = event.name;
    const price = event.price;

    // 2. Construct DOM elements from this.
    const tr = document.createElement('tr');
    tr.setAttribute('data-seatId', seatId);

    [
        eventName,
        ticket.Sektion,
        ticket.Rad,
        ticket.Plats,
        price,
    ].forEach(value => {
        const td = document.createElement('td');
        td.innerText = value;
        tr.appendChild(td);
    });

    const buttonTd = document.createElement('td');
    const button = document.createElement('button');
    button.textContent = '🗑️';
    button.addEventListener('click', () => {
        removeFromCart(seatId);
    });
    buttonTd.appendChild(button);
    tr.appendChild(buttonTd);
    
    cartTable.appendChild(tr);
}

function addToCart(seatId) {
    if(isInCart(seatId)) return;

    console.log(seatId);

    cartItems.push(seatId);
    storeCartItems();
    appendToCartId(seatId);
}

getCartItems().forEach(addToCart);


