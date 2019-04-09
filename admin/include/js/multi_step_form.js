




    var aName, cap, address, postCode, postArea, region, theArenaId, _arenaId,_sectionName,
     _entrance, _seats, arrSections,arrArenas ;


    function _(x) {
        return document.getElementById(x);
    }
    function q_all(x) {
        return document.querySelectorAll(x);
    }

    function processPhase1() {
        aName = _("arenaName").value;
        cap = _("capacity").value;
        address = _("address").value;
        postCode = _("postalcode").value;
        postArea = _("postalarea").value;
        region = _("region").value;






        if(aName.length > 2
            //  && cap.length > 2 && address.length > 2 && postCode.length > 2
            //  && postArea.length > 2 && region.length > 2
            )
              {
            _("phase1").style.display = "none";
            _("phase2").style.display = "block";

            _("progressBar").value = 33;
            _("status").innerHTML = "Phase 2 of 3";

        } else {
            alert("Fill the form properly :)");
        }
    }

    function processPhase2() {
        
        var entire_row = document.getElementById('rad_0');
        var entire_row2 = document.getElementById('rad_1');

        console.log(entire_row);
        console.log(entire_row2);


        var allArenas = document.getElementsByClassName('arenas');
        var allSections = document.getElementsByClassName('sections');
        var allEntrance = document.getElementsByClassName('entrance');
        var allSeats = document.getElementsByClassName('seats');

        

        console.log(allArenas);
        console.log(allSections);
        console.log(allEntrance);
        console.log(allSeats);
        
        let arenas = Array.from(allArenas)
        let sections = Array.from(allSections)
        let entrance = Array.from(allEntrance)
        let seats = Array.from(allSeats)

        
        let superFly = [arenas, sections, entrance, seats];

        console.log(superFly);

        arrArenas = Array.from(allArenas)
        

        arrSections = Array.from(allSections);


        // array1.forEach(function(element) {
        //     console.log(element);
        //   });


        // if(sec.length > 0) {
            _("phase2").style.display = "none";
            _("phase3").style.display = "block";
            
            _("progressBar").value = 66;
            _("status").innerHTML = "Phase 3 of 3";

        // } else {
        //     alert("Please choose your gender");
        // }
    }

    function processPhase3() {

    
        // var table = document.createElement('table'), tr, td, row, cell, input;

        // var rowTable = document.getElementById("rowTable");
        // rowTable.insertRow();
        
        // let i = 0;
        // arr.forEach(function(element) {                    
        //     var theRow = rowTable.insertRow(i);
        //     i++
        //     var cell0 = theRow.insertCell(0);
        //     cell0.innerHTML = element.value;

        //     console.log(element.value);


        //     for (row = 1; row < arr.length; row++) {
        //         var cells = theRow.insertCell(row);
                



                
        //         cells.innerHTML = "NEW CELL";
                
        //     }
        // }
// -------------------------------------------------------------------------------------

                
      

 
    





          
        


        if(country.length > 0) {
            _("phase3").style.display = "none";
            _("show_all_data").style.display = "block";
            _("display_").innerHTML = fname;
            _("display_lname").innerHTML = fname;
            _("display_gender").innerHTML = fname;
            _("progressBar").value = 100;
            _("status").innerHTML = "Phase 3 of 3";

        } else {
            alert("Please choose your country");
        }
    }


    function submitForm() {
        _("multiphase").method = "post";
        _("multiphase").action = "../include/classes/admin3.php";
        _("multiphase").submit();
    }


// SECTIONS!!!!!!!!!!!

    function chosenSections() 
    {
        var nrOfSections = _("nrOfSections").value;

        // var arenaId = document.createElement("input");
        // arenaId.type="number";
        // arenaId.name="section_arenaId_";
        // arenaId.placeholder = "Arena Id"

        // var sectionName = document.createElement("input");
        // sectionName.type="text";
        // sectionName.name="section_name_";
        // sectionName.placeholder = "Section Name"

        // var sectionEntrance = document.createElement("input");
        // sectionEntrance.type="text";
        // sectionEntrance.name="section_entrance_";
        // sectionEntrance.placeholder = "Entrance"

        // var nrOfSeats = document.createElement("input");
        // nrOfSeats.type="number";
        // nrOfSeats.name="section_seats_";
        // nrOfSeats.placeholder = "Seats"

        // // arenaId.name+=i;
        // // sectionName.name+=i;
        // // sectionEntrance.name+=i;
        // // nrOfSeats.name+=i;

        // allCells = [arenaId, sectionName, sectionEntrance, nrOfSeats];
        
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
    }

    function rowsPerSection() {

        let input = document.createElement("input");
        input.type = "number";
        input.id = "nrOfRows";
        input.name = "nrOfRows";

        let button = document.createElement('button');
        button.onclick = chosenRows();
        button.innerHTML = "Get Rows";

        
        document.getElementById('rowContainer').appendChild(input);

        document.getElementById('rowContainer').appendChild(button);


    }

    function chosenRows () {
            
        input_types = ['', 'text', 'text'];
        input_names = ['', 'section_name_', 'section_entrance_'];
        input_placeholders = ['', 'Rad', 'Seats'];
        input_id = ['', 'sectionName_', 'entrance_'];
        input_class =['', 'sections', 'entrance'];


        
        columnLines = ['Sektion', 'Rad', 'Antal platser'];


        var rowTable = document.getElementById('rowTable'), tr, td, cell, input, button;
            
        console.log(arrSections);
        console.log(arrSections[0]);
        console.log(arrSections[1]);
       
        arrSections.forEach(function(element) {    
            console.log("ARRAY = " + element);                
            tr = document.createElement('tr');
            
            for (cell = 0; cell <= 2; cell++) {
                    
                td = document.createElement('td');
                tr.appendChild(td);
                
                input = document.createElement('input');

                if(cell == 0) {
                    td.appendChild(input);
                    input.value = element.value
                

                 }
                else 
                {
                    td.appendChild(input);

                    

                    input.type        =   input_types[cell];
                    input.name        =   input_names[cell];
                    input.placeholder =   input_placeholders[cell];
                    input.id          =   input_id[cell] + cell;
                    input.className       =   input_class[cell];

                    console.log(input_class[cell]);
                }

            }
            
            rowTable.appendChild(tr);
        });

        // button = document.createElement('button');
        // button.onclick = chosenRow();
        // button.innerHTML = "Get Rows";
        // rowTable.appendChild(button);

        document.getElementById('rowContainer').appendChild(rowTable);
        
    }

    