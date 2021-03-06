document.addEventListener("DOMContentLoaded", function() { 

  function _(elementId) {
    return document.getElementById(elementId);
  }

  let obsolete_section_input_options = [
    {
      type: 'text',
      name: 'section_name_',
      id: 'section_name_',
      placeholder: 'Sektionens Namn',
      className: 'sections',
    },
    {
      type: 'text',
      name: 'entrance_',
      id: 'entrance_',
      placeholder: 'Entrance',
      className: 'sections',
    },
    {
      type: 'number',
      name: 'nrOfSeats_',
      id: 'nrOfSeats_',
      placeholder: 'Available Seats',
      className: 'sections',
    },
  ];

  let obsolete_input_rows_options = [
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
      className: 'row_sektion_',
    },
  ];

  let obsolete_input_section_rows_option = [
    {
      type: 'hidden',
      placeholder: '',
      name: 'section_nr_',
      id: 'section_nr_',
      className: 'nr_of_rows',
    },
    {
      type: 'number',
      placeholder: 'Antal Rader',
      name: 'nr_of_rows_',
      id: 'nr_of_rows_',
      className: 'nr_of_rows',
    },
  ];

  function createSection() {
    obsolete_section_input_options.forEach(function(element) {
      let container = document.createElement('div');
      container.className = 'p2_sectionsContainer';
      document.getElementById('phase2').appendChild(container);

      let input = document.createElement('input');
      input.type = element.type;
      input.name = element.name;
      (input.placeholder = element.placeholder), (input.id = element.id);
      input.className = element.className;
      container.appendChild(input);
    });
  }

  function createRows() {
    let nrOfRows = document.getElementsByClassName('nr_of_rows');

    let nrOfRowsArr = Array.from(nrOfRows);

    // det vi först vill veta är hur många sektioner det är.
    // Sedan välja en sektion och se hur många rader som är valda i den sektionen.

    let class_index = 0;
    for (
      let sectionIndex = 0;
      sectionIndex <= nrOfRowsArr.length;
      sectionIndex++
    ) {
      // Här hämtar vi en specifik section continaer, så vi kan sätta fast rader på rätt sektion.
      let sectionRowContainer = document.getElementById(
        'p3_sectionContainer_' + sectionIndex
      );

      // Här hämtar vi hur många rader som ska skapas i containern
      let sectionRows = document.getElementById('nr_of_rows_' + sectionIndex).value;

      for (let i = 1; i <= sectionRows; i++) {
        obsolete_input_rows_options.forEach(function(element) {
          let new_row_container = document.createElement('div');
          new_row_container.className = 'p3_rowContainer';

          let input = document.createElement('input');

          if (element.type != 'hidden') {
            let span = document.createElement('span');
            span.innerHTML = 'Rad ' + i + ' ';
            span.id = 'Rad_' + i;
            new_row_container.appendChild(span);
            input.className = element.className + class_index;
          }

          input.type = element.type;
          input.name = element.name + i + '_' + class_index;
          input.id = element.id + i;
          input.placeholder = element.placeholder;

          if (element.type == 'hidden') {
            input.value = i;
          }

          new_row_container.appendChild(input);

          sectionRowContainer.appendChild(new_row_container);
        });
      }
      class_index++;
    }
  }

  let get_p2_sections, p2_sections;

  let arena_input_options = [
    {
      type: 'text',
      name: 'arenaName',
      id: 'arenaName',
      placeholder: 'Arenans Namn',
    },
    {
      type: 'number',
      name: 'capacity',
      id: 'capacity',
      placeholder: 'Antal Platser',
    },
    {
      type: 'text',
      name: 'address',
      id: 'address',
      placeholder: 'Adress',
    },
    {
      type: 'text',
      name: 'postalcode',
      id: 'postalcode',
      placeholder: 'Postkod',
    },
    {
      type: 'text',
      name: 'postalarea',
      id: 'postalarea',
      placeholder: 'Postort',
    },
    {
      type: 'text',
      name: 'region',
      id: 'region',
      placeholder: 'Region',
    },
  ];

  let section_input_options = [
    {
      type: 'text',
      name: 'section_',
      id: 'section_',
      placeholder: 'Sektionens Namn',
      className: 'sections',
    },
    {
      type: 'text',
      name: 'entrance_',
      id: 'entrance_',
      placeholder: 'Entrance',
      className: 'sections',
    },
    {
      type: 'number',
      name: 'nrOfSeats_',
      id: 'nrOfSeats_',
      placeholder: 'Available Seats',
      className: 'sections',
    },
  ];

  let input_choose_rows_options = [
    {
      type: 'hidden',
      name: 'row_number_',
      id: 'hidden_row_number_',
    },
    {
      type: 'number',
      name: 'row_nrOfSeats_',
      id: 'row_nrOfSeats_',
      placeholder: 'Available Seats',
      className: 'row_sektion_',
    },
  ];

  function createArena() {
    // Hämtar platsen vi ska lägga in all data på.
    let container = _('phase_1_input-container');

    // Skapar en input för letje objekt i arenaoptions.
    arena_input_options.forEach(function(element) {
    let div = document.createElement('div');

      let input = document.createElement('input');
      input.type = element.type;
      input.name = element.name;
      input.placeholder = element.placeholder;
      input.id = element.id;
      input.className = element.className;

      div.appendChild(input);
      container.appendChild(div);
    });
  }

  _('createSections').addEventListener('click', createSections);
  function createSections() {
    let nrOfSections = _('nrOfSections').value;

    for (let i = 0; i < nrOfSections; i++) {
      let container = document.createElement('div');
      container.className = 'p2_sectionsContainer';
      _('phase_2_input-container').appendChild(container);

      // Skapar en input för letje 'item' i sections_inpu
      section_input_options.forEach(function(element) {
        let input = document.createElement('input');
        input.type = element.type;
        input.name = element.name + i;
        (input.placeholder = element.placeholder), (input.id = element.id + i);
        input.className = element.className;
        container.appendChild(input);
      });
    }
  }
  // Körs i fas 3.
  function createRows() {
    // Här hämtar vi alla inputs som säger hur många rader som ska skapas.
    let nrOfSections = document.getElementsByClassName('p3_sectionContainer');
    let nrOfSectionsArr = Array.from(nrOfSections);

    // det vi först vill veta, är hur många sektioner det är.
    // Sedan välja en sektion och se hur många rader som är valda i den sektionen.
    let $countingRows = [];
    let class_index = 0;
    for (
      let sectionIndex = 0;
      sectionIndex < nrOfSectionsArr.length;
      sectionIndex++
    ) {
      // Här hämtar vi en specifik section continaer, så vi kan sätta fast rader på rätt sektion.
      let sectionRowContainer = document.getElementById(
        'p3_sectionContainer_' + sectionIndex
      );

      // Här hämtar vi hur många rader som ska skapas i containern
      let sectionRows = document.getElementById('nr_of_rows_' + sectionIndex)
        .value;
      let parsedSectionRows = parseFloat(sectionRows);
      $countingRows.push(parsedSectionRows);

      for (let i = 0; i < sectionRows; i++) {
        input_choose_rows_options.forEach(function(element) {
          let new_row_container = document.createElement('div');
          new_row_container.className = 'p3_rowContainer';

          let input = document.createElement('input');

          if (element.type != 'hidden') {
            let span = document.createElement('span');
            span.innerHTML = 'Rad ' + i + ' ';
            span.id = 'Rad_' + i;
            new_row_container.appendChild(span);
            input.className = element.className + sectionIndex;
          }

          input.type = element.type;
          input.name = element.name + i + '_' + class_index;
          input.id = element.id + i;
          input.placeholder = element.placeholder;

          if (element.type == 'hidden') {
            input.value = i;
          }

          new_row_container.appendChild(input);

          sectionRowContainer.appendChild(new_row_container);
        });
      }
      class_index++;
    }
    let nrOfAllRows = document.createElement('input');
    nrOfAllRows.type = 'hidden';
    nrOfAllRows.name = 'sum_rows';

    nrOfAllRows.value = $countingRows;
    _('phase3').appendChild(nrOfAllRows);
  }

  function chooseNrOfRows() {
    get_p2_sections = document.getElementsByClassName('p2_sectionsContainer');
    p2_sections = Array.from(get_p2_sections);

    // Phase 3 containern.
    let _phase_3 = document.getElementById('phase3_input_container');

    let br = document.createElement('br');

    // Loopar igenom alla sektioner som skapades i phase 2.
    for (let i = 0; i < p2_sections.length; i++) {
      // Sektionerna från Phase 2.
      let p2_sectionName = document.getElementById('section_' + i).value;

      // Skapar container för
      let p3_section_container = document.createElement('div');
      p3_section_container.className = 'p3_sectionContainer';
      p3_section_container.id = 'p3_sectionContainer_' + i;
      _phase_3.appendChild(p3_section_container);

      //  Skriver ut valda sektioner från phase 2 i phase 3.
      let h4 = document.createElement('h4');
      h4.innerHTML = 'sektion' + p2_sectionName;
      h4.id = 'sektion_' + i;

      p3_section_container.appendChild(h4);

      obsolete_input_section_rows_option.forEach(function(element) {
        let input = document.createElement('input');

        if (element.type == 'hidden') {
          input.value = 'sektion_' + i;
        }

        input.type = element.type;
        input.placeholder = element.placeholder;
        input.name = element.name + i;
        input.id = element.id + i;
        input.className = element.className;

        p3_section_container.appendChild(input);
      });
    }

    _phase_3.appendChild(br);
    _phase_3.appendChild(br.cloneNode(true));

    let button_get_rows = document.createElement('BUTTON');
    button_get_rows.innerHTML = 'Välj antal rader';
    button_get_rows.id = 'button_get_rows';
    button_get_rows.onclick = createRows;
    button_get_rows.type = 'button';

    _phase_3.appendChild(button_get_rows);

    _phase_3.appendChild(br.cloneNode(true));
    _phase_3.appendChild(br.cloneNode(true));
  }

  let arena_data;

  _('processPhase1').addEventListener('click', processPhase1);
  function processPhase1() {
    let arena_input = _('arenaName').value;
    let cap_input = _('capacity').value;
    let address_input = _('address').value;
    let postcode_input = _('postalcode').value;
    let postarea_input = _('postalarea').value;
    let region_input = _('region').value;

    arena_data = {
      arena: arena_input,
      capacity: cap_input,
      address: address_input,
      postalcode: postcode_input,
      postalarea: postarea_input,
      region: region_input,
    };

    _('phase1').style.display = 'none';
    _('phase2').style.display = 'block';
    _('progressBar').value = 33;
    _('status').innerHTML = 'Phase 2 of 3';
  }

  let section_data = [];
  let section_data_values = [];

  _('phase2_continue').addEventListener('click', processPhase2);
  function processPhase2() {
    // Hämtar alla sektioner som skapades.
    get_p2_sections = document.getElementsByClassName('p2_sectionsContainer');
    p2_sections = Array.from(get_p2_sections);

    for (let i = 0; i < p2_sections.length; i++) {
      let section_input = _('section_' + i).value;
      let entrance_input = _('entrance_' + i).value;
      let seats_input = _('nrOfSeats_' + i).value;

      let section = {
        section: section_input,
        entrance: entrance_input,
        seats: seats_input,
      };
      let section_values = [section_input, entrance_input, seats_input];
      section_data.push(section);
      section_data_values.push(section_values);
    }

    _('phase2').style.display = 'none';
    _('phase3').style.display = 'block';
    _('progressBar').value = 66;
    _('status').innerHTML = 'Phase 3 of 3';

    chooseNrOfRows();
  }

  let row_data = [];
  let row_data_values = [];

  _('processPhase3').addEventListener('click', processPhase3);
  function processPhase3() {
    // Get all sections from Phase3
    let p3_sections = document.getElementsByClassName('p3_sectionContainer');
    let p3_sections_arr = Array.from(p3_sections);

    for (let sektion_i = 0; sektion_i < p3_sections_arr.length; sektion_i++) {
      let p3_section_rows = document.getElementsByClassName(
        'row_sektion_' + sektion_i
      );
      let p3_section_rows_arr = Array.from(p3_section_rows);

      for (let row_i = 0; row_i < p3_section_rows_arr.length; row_i++) {
        let row_seats = p3_section_rows_arr[row_i];

        let row = {
          sektion: sektion_i + 1,
          rad: row_i + 1,
          seats: row_seats.value,
        };
        let row_values = [sektion_i + 1, row_i + 1, row_seats.value];

        row_data.push(row);
        row_data_values.push(row_values);
      }
    }

    _('phase3').style.display = 'none';
    _('show_all_data').style.display = 'block';
    _('progressBar').value = 100;
    _('status').innerHTML = 'Phase 3 of 3';

    show_arena();
    show_rows();
    show_sections();
  }

  function show_arena() {
    let showArena = _('show_arena_table');
    let header_row = document.createElement('tr');
    showArena.appendChild(header_row);
    let arena_keys = Object.keys(arena_data);

    let data_row = document.createElement('tr');
    showArena.appendChild(data_row);
    let arena_values = Object.values(arena_data);

    for (let i = 0; i < arena_values.length; i++) {
      let th = document.createElement('th');
      th.innerHTML = arena_keys[i];
      header_row.appendChild(th);

      let td = document.createElement('td');
      td.innerHTML = arena_values[i];
      data_row.appendChild(td);
    }
  }

  function show_sections() {
    let show_sections = _('show_section_table');
    let header_row = document.createElement('tr');
    show_sections.appendChild(header_row);
    let section_keys = Object.keys(section_data[0]);

    // Loopar igenom nycklarna för att skapa header.
    for (let i = 0; i < section_keys.length; i++) {
      let th = document.createElement('th');
      th.innerHTML = section_keys[i];
      header_row.appendChild(th);
    }

    // Loopar igenom alla raders värden.
    for (let obj_i = 0; obj_i < section_data.length; obj_i++) {
      let section_values = Object.values(section_data[obj_i]);
      let data_section = document.createElement('tr');
      show_sections.appendChild(data_section);

      // Hämtar värdena.
      for (let i = 0; i < section_values.length; i++) {
        let td = document.createElement('td');
        td.innerHTML = section_values[i];
        data_section.appendChild(td);
      }
    }
  }

  function show_rows() {
    let show_rows = _('show_row_table');
    let header_row = document.createElement('tr');
    show_rows.appendChild(header_row);
    let row_keys = Object.keys(row_data[0]);

    // Loopar igenom nycklarna för att skapa header.
    for (let i = 0; i < row_keys.length; i++) {
      let th = document.createElement('th');
      th.innerHTML = row_keys[i];
      header_row.appendChild(th);
    }

    // Loopar igenom alla raders värden.
    for (let obj_i = 0; obj_i < row_data.length; obj_i++) {
      // hämtar raderna.
      let row_values = Object.values(row_data[obj_i]);
      let data_row = document.createElement('tr');
      show_rows.appendChild(data_row);

      // Hämtar värdena.
      for (let i = 0; i < row_values.length; i++) {
        let td = document.createElement('td');
        td.innerHTML = row_values[i];
        data_row.appendChild(td);
      }
    }
  }

  createArena();
});