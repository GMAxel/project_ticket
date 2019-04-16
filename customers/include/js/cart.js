function _($elementId) {
    return document.getElementById($elementId);
}

const cartTable = _('tablecart');
const CART_COOKIE_PREFIX = 'cart=';
let cartItems = [];
const events = JSON.parse(_('events').value);
const tickets = JSON.parse(_('all_tickets').value);

// 
function getCartItems() {
    console.log('GetCartItems Körs')
    // Hela cookie strängen.
    // 1. Split - Delar hela strängen till en array/lista med strängar. 
    // Alltså alla cookies med values. 

    // 2. Alla som inte börjar på cart skiter vi i. 
    // 3
    const cartCookie = document.cookie
        .split(';')
        .find(cookie => cookie.indexOf('cart=') === 0);
    
    if(!cartCookie) {
        return [];
    } 
    // Cartcookie är en sträng med 
    // 
    // split1 = hämta värdena, inte nycklarna.
    // Split2 = (som explode) gör om till en lista. 
    console.log('CROOKIE: ' + cartCookie);
    return cartCookie   
        .split('=')[1]
        .split(',')
        .filter(Boolean);
}

function storeCartItems() {
    console.log('storeCartItems Körs')

    document.cookie = CART_COOKIE_PREFIX + cartItems.join(',');
}   

function removeFromCart(seatId) {
    console.log('removeFromCart Körs')

    if (!isInCart(seatId)) return;

    cartItems = cartItems.filter(id => id !== seatId);

    const trs = _('tablecart').querySelectorAll('tr');
    const domEl = Array.from(trs).find(tr => tr.getAttribute('data-seatId') === seatId);
    if (domEl) _('tablecart').removeChild(domEl);

    storeCartItems();
}

function isInCart(seatId) {
    console.log('isInCart Körs')

    return cartItems.includes(seatId);
}

function appendToCartId(seatId) {
    console.log('appendToCartId Körs')

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
    console.log('addToCart Körs')

    if(isInCart(seatId)) return;

    console.log(seatId);

    cartItems.push(seatId);
    storeCartItems();
    appendToCartId(seatId);
}

getCartItems().forEach(addToCart);


