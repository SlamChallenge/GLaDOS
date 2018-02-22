function convertRegisterXmlToHtmlTable(xml) {
  var i;
  var xmlDoc = xml.responseXML;
  var table='<thead><tr><th>NAME</th><th>BIN</th><th>HEX</th><th>DEC</th><th>DEFINITION</th></tr></thead><tbody>';
  var x = xmlDoc.getElementsByTagName('REG')[0].getElementsByTagName('FIELD');
  for (i = 0; i <x.length; i++) {
    var name    = x[i].getAttribute('name');
    var bin_val = x[i].getAttribute('value');
    var width   = x[i].getAttribute('width');
    var pos   = x[i].getAttribute('pos');
    var def     = x[i].getAttribute('definition');
    
    var hex_val = parseInt(bin_val, 2).toString(16);
    var dec_val = parseInt(bin_val, 2).toString(10);
        
    table += '<tr>';
        table += '<td class="name_cell">'+name+'</td>';
        table += '<td class="width_cell">';
            table += '<input id="'+name+'_width" type="text" value="'+width+'"   oninput=highlightCell("'+name+'_width")></td>';
        table += '<td class="pos_cell">';
            table += '<input id="'+name+'_pos" type="text" value="'  +pos+'"     oninput=highlightCell("'+name+'_pos")></td>';
        table += '<td class="bin_cell">';
            table += '<input id="'+name+'_bin" type="text" value="'  +bin_val+'" oninput=checkNumCell("'+name+'","bin")></td>';
        table += '<td class="hex_cell">';
            table += '<input id="'+name+'_hex" type="text" value="'  +hex_val+'" oninput=checkNumCell("'+name+'","hex")></td>';
        table += '<td class="dec_cell">';
            table += '<input id="'+name+'_dec" type="text" value="'  +dec_val+'" oninput=checkNumCell("'+name+'","dec")></td>';
        table += '<td class="def_cell">';
            table += '<input id="'+name+'_def" type="text" value="'  +def+'"     oninput=highlightCell("'+name+'_def")></td>';
    table += '</tr>';
  }
  table += '</tbody>';
  return table;
}

function convertScriptXmlToHtmlTable(xml) {
    var xmlDoc = xml.responseXML;
    var test_name;
    var tests = xmlDoc.getElementsByTagName('tests')[0].getElementsByTagName('test');
    var test_select_dropdown = document.getElementById('test_select');
    var selected_test_name = test_select_dropdown.value;
    var test_select_table = document.getElementById('test_table');
    //var selected_xml_name = document.getElementById('xml_select').value;
    var select_string = '';
    var table_string = '';
    
    var i;
    for (i = 0; i <tests.length; i++) {
        test_name = tests[i].getElementsByTagName('name')[0].textContent;
        select_string+='<option value="'+ test_name + '"';
        if ( selected_test_name === "" ) {
            selected_test_name = test_name;
        }
        if ( test_name == selected_test_name ) {
            select_string += ' selected';
            // fill the hidden path row
            table_string += '<tr><td class="hidden">Path: </td><td class="hidden" id="test_path">';
            table_string += tests[i].getElementsByTagName('path')[0].textContent;
            table_string += '</td></tr>';
            // fill the script row
            table_string += '<tr><td>script</td><td id="test_script">';
            table_string += tests[i].getElementsByTagName('script')[0].textContent;
            table_string += '</td></tr>';
            // dynamically create params rows
            var params = tests[i].getElementsByTagName('parameters')[0].children;
            for( var j = 0; j < params.length; j++ ) {
                var tag_name = params[j].tagName;
                table_string += '<tr><td>' + tag_name + '</td><td>';
                // xml tags need to create a selection dropdown
                if ( tag_name == 'xml' ) {
                    table_string += '<select id="xml_select"></select>';
                    var default_xml_name = params[j].textContent;
                } else {
                    // if the parameter has options, make it a dropdown
                    if ( params[j].childElementCount > 0 ) {
                        table_string += '<select>';
                        var options = params[j].children;
                        for( var k = 0; k < options.length; k++ ) {
                            table_string += '<option>' + options[k].textContent + '</option>';
                        }
                        table_string += '</select>';
                    }
                    // otherwise make it an input
                    else {
                        table_string += '<input type="text">';
                    }
                }
                table_string += '</td></tr>'
            }
            // fill the description row
            table_string += '<tr><td>description</td><td id="test_description">';
            table_string += tests[i].getElementsByTagName('description')[0].textContent;
            table_string += '</td></tr>';
        }
        select_string += '>' +  test_name + '</option>';
    }
    //console.log(select_string);
    //console.log(table_string);
    test_select_dropdown.innerHTML = select_string;
    test_select_table.innerHTML = table_string;
    if ( default_xml_name != undefined ) {
        populateXmlSelect(false);
        setDropdownSelect('xml_select', default_xml_name);
    }
}