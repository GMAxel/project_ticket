function _(elementId) {
    return document.getElementById(elementId);
}


var arena_sections_rows =  {

};

// används ej. 
var all_arena_sections =  [

];


var obsolete_section_input_options = 
[
    {
        type: 'text',
        name: 'section_name_',
        id: 'section_name_',
        placeholder: 'Sektionens Namn',
        className: 'sections'
    },
    {
        type: 'text',
        name: 'entrance_',
        id: 'entrance_',
        placeholder: 'Entrance',
        className: 'sections'
    },
    {
        type: 'number',
        name: 'nrOfSeats_',
        id: 'nrOfSeats_',
        placeholder: 'Available Seats',
        className: 'sections'
    }
]; 

var obsolete_input_rows_options = 
[
    {
        type: 'hidden',
        name: 'hidden_row_number_',
        id: 'hidden_row_number_',
    },
    {
        type: 'number',
        name: 'row_nrOfSeats_',
        id: 'row_nrOfSeats_',
        placeholder: 'Available Seats',
        value: '',
        className: 'row_sektion_'
    }
]; 

var obsolete_input_section_rows_option = [
    {
        type: 'hidden',
        placeholder: '',
        name: 'section_nr_',
        id: 'section_nr_',
        className: 'nr_of_rows'
    },
    {
        type: 'number',
        placeholder: 'Antal Rader',
        name: 'nr_of_rows_',
        id: 'nr_of_rows_',
        className: 'nr_of_rows'
    }
]


function createSections() {

    let nrOfSections = document.getElementById('nrOfSections').value;

    for(let i = 0; i < nrOfSections; i++) 
        {
        let container = document.createElement('div');
            container.className = 'p2_sectionsContainer';        
        document.getElementById('phase2').appendChild(container);

        


        // Skapar en input för varje 'item' i sections_inpu
        obsolete_section_input_options.forEach(function(element) 
        {   
            let input = document.createElement('input');
                input.type = element.type;
                input.name = element.name + i;
                input.placeholder = element.placeholder,
                input.id = element.id + i;
                input.className = element.className;
            container.appendChild(input);        

            // all_sections_arr_container.push(input);

       });
    }
    
}

// var all_sections_arr_container = [];


function createSection() 
{
    obsolete_section_input_options.forEach(function(element) {   
        let container = document.createElement('div');
            container.className = 'p2_sectionsContainer';    
        document.getElementById('phase2').appendChild(container);
    
        let input = document.createElement('input');
            input.type = element.type;
            input.name = element.name;
            input.placeholder = element.placeholder,
            input.id = element.id;
            input.className = element.className;
        container.appendChild(input);
        
    });
}

function createRows() 
{
    // 
    let nrOfRows = document.getElementsByClassName('nr_of_rows');

    let nrOfRowsArr = Array.from(nrOfRows);

    // det vi först vill veta, är hur många sektioner det är. Sedan välja en sektion och se hur många rader som är valda i den sektionen. 

    let class_index = 0;
    for(let sectionIndex = 0; sectionIndex <= nrOfRowsArr.length; sectionIndex++) 
    {
        // Här hämtar vi en specifik section continaer, så vi kan sätta fast rader på rätt sektion. 
        let sectionRowContainer = document.getElementById('p3_sectionContainer_' + sectionIndex);
        // let h4_innertext = _('sektion_' + sectionIndex).innerHTML;
        


        // Här hämtar vi hur många rader som ska skapas i containern
        let sectionRows  = document.getElementById('nr_of_rows_' + sectionIndex).value;

        for(let i = 1; i <= sectionRows; i++) {
            
            obsolete_input_rows_options.forEach(function(element) {   
                let new_row_container = document.createElement('div');
                new_row_container.className = 'p3_rowContainer';    

                let input = document.createElement('input');

                if(element.type != 'hidden') {
                    let span = document.createElement('span');
                    span.innerHTML = 'Rad ' + i + ' ';
                    span.id = 'Rad_' + i;                    
                    new_row_container.appendChild(span);
                    input.className = element.className + class_index;
                }

                input.type = element.type;
                input.name = element.name + i + '_' + class_index;
                console.log(input.name);
                input.id = element.id + i;
                input.placeholder = element.placeholder;

                if(element.type == 'hidden') {
                    input.value =  i;
                }

                    new_row_container.appendChild(input);

                sectionRowContainer.appendChild(new_row_container);
            });
        }
        class_index++;

    }

 

}

function createRow() 
{

}





var get_p2_sections, p2_sections;

function processPhase1() 
{

    let arena_input = _("arenaName").value
    let cap_input = _("capacity").value
    let address_input = _("address").value
    let postcode_input = _("postalcode").value
    let postarea_input = _("postalarea").value
    let region_input = _("region").value

    arena_sections_rows.arena = arena_input;
    arena_sections_rows.capacity = cap_input;
    arena_sections_rows.address = address_input;
    arena_sections_rows.postalcode = postcode_input;
    arena_sections_rows.postalarea = postarea_input;
    arena_sections_rows.region = region_input;
    arena_sections_rows.sections = [];


    console.log(arena_sections_rows);

    // arena_sections_rows.push(input);


    let arena_info = arena_input + cap_input + address_input + postcode_input + postarea_input + region_input;
    
    let p = document.createElement('p');
    p.innerHTML = arena_info;

    let phase2 =  _("phase2");
    phase2.appendChild(p);




    




    _("phase1").style.display = "none";
    _("phase2").style.display = "block";
    _("progressBar").value = 33;
    _("status").innerHTML = "Phase 2 of 3";

}


function processPhase2() 
{

    // Sektioner från Phase 2
    get_p2_sections = document.getElementsByClassName('p2_sectionsContainer');
    p2_sections = Array.from(get_p2_sections)
    console.log(p2_sections);

    for(let i = 0; i < p2_sections.length; i++) {
        let section_input = _('section_name_' + i).value;
        let entrance_input = _('entrance_' + i).value;
        let seats_input = _('nrOfSeats_' + i).value;

        let arena_section = { };

        arena_section.section = section_input;
        arena_section.entrance = entrance_input;
        arena_section.seats = seats_input;
        arena_section.rows = [];

        
        arena_sections_rows.sections.push(arena_section);
    }
    console.log(arena_sections_rows);
    console.log(arena_sections_rows.sections);
    console.log(arena_sections_rows.sections[0]);
    console.log(arena_sections_rows.sections[0].rows);




    // arena_sections_rows.sections.push(all_arena_sections);

    console.log(all_arena_sections);
    console.log(arena_sections_rows);


    // <br>.
    var br = document.createElement('br');

    // Phase 3 containern. 
    let _phase_3 = document.getElementById('phase3');

    // Loopar igenom alla sektioner som skapades i phase 2. 
    for(let i = 0; i < p2_sections.length; i++) 
    {
        // Sektionerna från Phase 2. 
        let  p2_sectionName = document.getElementById('section_name_' + i).value;


        // Skapar container för 
        let p3_section_container           = document.createElement('div');
            p3_section_container.className = 'p3_sectionContainer'; 
            p3_section_container.id        = 'p3_sectionContainer_' + i;        
        _phase_3.appendChild(p3_section_container);

        //  Skriver ut valda sektioner från phase 2 i phase 3. 
        let h4 = document.createElement('h4');
            h4.innerHTML = 'sektion' + p2_sectionName;
            h4.id = 'sektion_' + i;

            p3_section_container.appendChild(h4);

            obsolete_input_section_rows_option.forEach(function(element) 
        {   
            let input = document.createElement('input');

                if(element.type == 'hidden') {
                    input.value = 'sektion_' + i;
                }

                input.type          =   element.type;
                input.placeholder   =   element.placeholder;
                input.name          =   element.name + i;
                input.id            =   element.id + i;
                input.className     =   element.className;

            p3_section_container.appendChild(input);
        });          
    }


    _phase_3.appendChild(br);
    _phase_3.appendChild(br.cloneNode(true));


    let button_get_rows           = document.createElement('BUTTON');
        button_get_rows.innerHTML = 'Välj antal radersss';
        button_get_rows.id        = 'button_get_rows';
        button_get_rows.onclick   = createRows;
        _phase_3.appendChild(button_get_rows); 
    
    _phase_3.appendChild(br.cloneNode(true));
    _phase_3.appendChild(br.cloneNode(true));


    let phase3_button           = document.createElement('button');
        phase3_button.innerHTML = 'Continue :)';
        phase3_button.onclick   = processPhase3;
    _phase_3.appendChild(phase3_button);
   


    _("phase2").style.display = "none";
    _("phase3").style.display = "block";
    _("progressBar").value = 66;
    _("status").innerHTML = "Phase 3 of 3";
}






function processPhase3() 
{

    // Först ska ska vi hämta värden.

    // Hämta Alla sektioner från fas 3.
    let p3_sections = document.getElementsByClassName('p3_sectionContainer');
    let p3_sections_arr = Array.from(p3_sections);

    // En loop per sektion. 
    let arena_section_index = 0;
    for(let sektion_i = 1; sektion_i <= p3_sections_arr.length; sektion_i++) {
        let p3_section_rows = document.getElementsByClassName('row_sektion_'+ sektion_i);
        let p3_section_rows_arr = Array.from(p3_section_rows);

        


        // 2, 4
        console.log(p3_section_rows_arr.length);

        // En loop per rad i sektion. 
        for(let row_i = 0; row_i < p3_section_rows_arr.length; row_i++) {
            // 0, 1, 0, 
            console.log(row_i);
            let row_seats = p3_section_rows_arr[row_i]

            // let row_nr = _("hidden_row_number_" + row_i).value;
            // let row_seats = _("row_nrOfSeats_" + row_i).value;

            let each_section_rows = {
                // number: i +1,
                seats: row_seats
            };

            // 0, 0, 0
            console.log(arena_section_index);
            // rad1, rad2
            console.log(each_section_rows);


            arena_sections_rows.sections[arena_section_index].rows.push(each_section_rows);
        }
        arena_section_index++;

    }
    
    console.log(arena_sections_rows);
    console.dir(arena_sections_rows);

    // let php_obj = js_obj_to_php_obj(arena_sections_rows);

    let php_obj = js_obj_to_string(arena_sections_rows);

    console.log(php_obj);

    sayHelloWorld(php_obj);


    // let _display_arena = [
    //     arena_sections_rows.arena.value,
    //     arena_sections_rows.capacity.value,
    //     arena_sections_rows.address.value,
    //     arena_sections_rows.postalcode.value,
    //     arena_sections_rows.postalarea.value,
    //     arena_sections_rows.region.value
    // ]
    // // arena_sections_rows.sections = [];


    // _display_arena.forEach(function(element) {   
    //     let _arena_displayed = document.createElement('p');
    //         _arena_displayed.innerHTML = element;
    //         // new_row_container.className = 'p3_rowContainer';    
    //         document.getElementById('show_all_data').appendChild(_arena_displayed);       
    // });




    


    // let send_test_data = ('show_all_data');

    // arena_sections_rows.forEach(function(element) {

    //     let p = document.createElement('p');
    //     p.innerHTML = element;

    //     send_test_data.appendChild(p);

    // });




    // console.log(arena_sections_rows.sections);



    // Hämta alla rader från fas 3.
   

    // hämta alla seats i raderna från fas 3.



    // ARENA:
    // Arenans Namn:
    let arenaName = _('arenaName').value;
    let arenaCapacity = _('capacity').value;
    let address = _('address').value;
    let postalcode = _('postalcode').value;
    let postalarea = _('postalarea').value;
    let region = _('region').value;

    let arena_all = {
        name: arenaName,
        cap: arenaCapacity,
        addr: address,
        postCode: postalcode,
        postArea: postalarea,
        regi: region,
        sections: []
    }

    // SECTIONS

    let nrOfSections = document.getElementsByClassName('p2_sectionsContainer');
    let nrOfSections_arr = Array.from(nrOfSections);

    let allSections = [];
    for(let i = 0; i < nrOfSections_arr.length ; i++) 
    {
        let _section_name = _('section_name_' + i).value;
        let _entrance = _('entrance_' + i.value);
        let _nrOfSeats = _('nrOfSeats_' + i).value;

        let section = [
            {
                sectionName: _section_name,
                entrance : _entrance,
                nrOfSeats : _nrOfSeats,
                rows : []
            }
        ]
        allSections.push(section);
    }


    // Rows 
    let nrOfRows = document.getElementsByClassName('row');
    let nrOfRows_arr = Array.from(nrOfRows);

    console.log(nrOfRows_arr)
    console.log(nrOfRows_arr.length)


    let allRows = [];

    let extraIndex = 1;
    for(let sectionIndex = 0; sectionIndex < nrOfSections_arr.length ; sectionIndex++) 
    {
        let nrOfRows_section = document.getElementsByClassName('rowsektion'+extraIndex);
        let nrOfRows_section_arr = Array.from(nrOfRows_section);

        extraIndex++;

        let _section = _('section_nr_' + sectionIndex).value;
        console.log(_section)

        let row = 
            {
                section: _section,
                rowDetails: []
            };


        for(let i = 0; i < nrOfRows_section_arr.length; i++) {

            let _hidden_rownr = _('hidden_row_number_' + i).value;
            let _nrOfSeats = _('row_nrOfSeats_' + i).value;

            console.log(_hidden_rownr);
            console.log(_nrOfSeats);

            let theDetails = {
                row: _hidden_rownr,
                seats: _nrOfSeats
            }         

            row.rowDetails.push(theDetails);

        }

       
        allRows.push(row);



    }

    // var output = '';
    // for (var property in allRows) {
    //   output += property + ': ' + allRows[property]+'; ';
    // }
    // alert(output);

    // console.dir(allRows);

    








    // console.log(chosen_arenaName);

    
    // let inputs_phase_1 = _('phase1');
    // let inputs_phase_1_arr = Array.from(inputs_phase_1);

 




    _("phase3").style.display = "none";
    _("show_all_data").style.display = "block";


    // _("display_arena").innerHTML = arenaName;
    // _("display_capacity").innerHTML = arenaCapacity;
    // _("display_address").innerHTML = address;
    // _("display_postalcode").innerHTML = postalcode;
    // _("display_postalarea").innerHTML = postalarea;
    // _("display_region").innerHTML = region;
    
    // _("display_").innerHTML =
    // _("display_").innerHTML =


    _("progressBar").value = 100;
    _("status").innerHTML = "Phase 3 of 3";



    
    // for(let i = 0; i < nrOfSections; i++) 
    //     {
    
    //     var container = document.createElement('div');
    //     container.className = 'test_sectionsContainer';        
    //     document.getElementById('phase2').appendChild(container);

    //     test_sections.forEach(function(element) 
    //     {   
    //         let input = document.createElement('input');
    //         input.type = element.type;
    //         input.name = element.name + i;
    //         input.placeholder = element.placeholder,
    //         input.id = element.id + i;
    //         input.className = element.className;
    //         container.appendChild(input);
        
    //    });
    // }
}


function js_obj_to_string(object) {

    let string = JSON.stringify(object);
    return string;
}

function js_obj_to_php_obj(object) {

    var json = "{";
    for(property in object) {
        var value = object[property];
        if(typeof(value) == "string") {
            json += '"'+property+'":"' +value+ '",'
        } else {
            if(!value[0]) {
                json += '"' + property + '":' + js_obj_to_php_obj(value)+',';
            } else {
                json += '"' + property + '":[';
                for(prop in value) json += '"' + value[prop] + '",';
                json = json.substr(0, json.length-1) + "],";
            }
        }
    }
    return json.substr(0, json.length-1) + "}";
}

function sayHelloWorld(hello) {

        window.location.href = "../include/classes/admin4.php?str=" + hello;
}
    






    