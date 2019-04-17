// document.addEventListener("DOMContentLoaded", function() { 
//     console.log('extra');

//     function _($elementId) {
//         return document.getElementById($elementId);
//     }

//     // Extraherar information från DOM 
//     var event_info = JSON.parse(_('event_info').value);
//     var all_tickets = JSON.parse(_('event_tickets').value);

//     // Skriv ut event-informationen på sidan
//     Object.keys(event_info[0]).forEach(function(key) {
//         let p = document.createElement('p');
//         p.textContent = key + ': ' +  event_info[0][key];
//         _('event_container').appendChild(p);
//     });
    
//     let event_container = _('ticket_table');
//     let tr_th = document.createElement('tr');
//     event_container.appendChild(tr_th);

//     // Skriv ut headers för biljetterna 
//     Object.keys(all_tickets[0]).forEach(function(key) {
//         let th = document.createElement('th');
//         let td_th = document.createElement('td');
//         tr_th.appendChild(th);

//         td_th.innerHTML = key;
//         th.appendChild(td_th);
//     });

//     // Rita upp alla biljetter från eventet. 
//     all_tickets.forEach(function (ticket) {
//         let tr = document.createElement('tr');
        
//         Object.keys(ticket).forEach(function(key) {
//             let td = document.createElement('td');
//             td.innerHTML = ticket[key];
//             tr.appendChild(td);
//         });

//         // Knapp för att lägga till i varukorg. 
//         let button = document.createElement('button');
//         button.innerHTML = 'Lägg till i varukorg';
//         tr.appendChild(button);
//         button.addEventListener('click', () =>  addToCart(ticket.id));
//         event_container.appendChild(tr);
//     })
// });