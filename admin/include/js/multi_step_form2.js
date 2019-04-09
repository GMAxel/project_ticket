

function _($elementId) {
    return document.getElementById($elementId);
}

function chosenSections() 
{
    console.log('hej');
    let nrOfSections = _("nrOfSections").value;


        input_types = ['number', 'text', 'text', 'number'];
        input_names = ['arenaId', 'section_name_', 'section_entrance_', 'section_seats_'];
        input_placeholders = ['Arena Id', 'Section Name', 'Entrance', 'Seats'];
        input_id = ['arenaId_', 'sectionName_', 'entrance_', 'seats_'];
        input_class = ['arenas', 'sections', 'entrance', 'seats'];


        var table = document.createElement('table'), tr, td, row, cell, input;
            
        for (row = 0; row < nrOfSections; row++) {
            tr = document.createElement('tr');
            tr.id = "rad_" + row;


            for (cell = 0; cell <= 3; cell++) {
            td = document.createElement('td');
            tr.appendChild(td);
            
            input = document.createElement('input');
            td.appendChild(input);

            input.type        =   input_types[cell];
            input.name        =   input_names[cell];
            input.placeholder =   input_placeholders[cell];
            input.id          =   input_id[cell] + cell;
            input.className       =   input_class[cell];

            console.log(input_class[cell]);

            }
            
            table.appendChild(tr);
        }
        document.getElementById('sectionsContainer').appendChild(table);

        document.getElementById('hidden_sectionsAmount').value = nrOfSections;

}