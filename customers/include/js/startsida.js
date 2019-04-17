document.addEventListener("DOMContentLoaded", function() { 

    console.log('Detta händer');
    function _($elementId) {
        return document.getElementById($elementId);
    }
    // Ritar ut eventen
    function draw_events() {
        console.log('draw events funktionen körs');

        let textarea = _('events');
        if (!textarea) return null;

        let json = textarea.value;
        let obj = JSON.parse(json);

        for(i = 0; i < obj.length; i++) {
            let item = document.createElement('div');

            _('cart_container').appendChild(item);   

            let a = document.createElement('a');
            a.href = "event.php?event=" + obj[i].id;
            item.appendChild(a);  

            let eventName = document.createElement('h4');
            
            eventName.textContent = obj[i].name + ' - ' + obj[i].date.slice(0, 16);
            eventName.id = 'event_' + i;
            eventName.className = 'event'
            a.appendChild(eventName);  
        }
    }
    draw_events();
});