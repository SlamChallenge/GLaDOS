function highlightCell(cell_id) {
    document.getElementById(cell_id).setAttribute('style', 'background: yellow;');
}

function checkNumCell(name, radix) {

    var bin_id = name+"_bin";
    var hex_id = name+"_hex";
    var dec_id = name+"_dec";
    
    var bin_cell = document.getElementById(bin_id);
    var hex_cell = document.getElementById(hex_id);
    var dec_cell = document.getElementById(dec_id);
    
    var width    = document.getElementById(name+"_width").value;   
    
    // Update the peer cell values
    switch(radix) {
        case "bin":
            dec_cell.value = parseInt(bin_cell.value, 2).toString(10);
            hex_cell.value = parseInt(bin_cell.value, 2).toString(16);
            break;
        case "hex":
            dec_cell.value = parseInt(hex_cell.value, 16).toString(10);
            bin_cell.value = parseInt(hex_cell.value, 16).toString(2);
            break;
        case "dec":
            hex_cell.value = parseInt(dec_cell.value, 10).toString(16);
            bin_cell.value = parseInt(dec_cell.value, 10).toString(2);
            break;
        default:
            console.log("Radix not identified");
            return false;
    }

    // Check that new values are in bounds   
    var dec_cell_val = dec_cell.value;
    var dec_cell_max = Math.pow(2,width) - 1;
    
    if ( dec_cell_val < 0  || dec_cell_val > dec_cell_max ) {
        bin_cell.setAttribute('style', 'background: tomato');
        hex_cell.setAttribute('style', 'background: tomato');
        dec_cell.setAttribute('style', 'background: tomato');
    }
    else {
        highlightCell(bin_id);
        highlightCell(hex_id);
        highlightCell(dec_id);
    }
}

function convertHtmlTabletoRegisterXml() {
    var table_rows = document.getElementById("sc_table").getElementsByTagName("tr");
    //TODO: Retain this from the original xml retrieval
    var xmlstring = '<REGISTERS>\n\t<REG name="pll" address="28" length="256">\n'
    for (i = 1; i < table_rows.length; i++) {
        var data_tags = table_rows[i].getElementsByTagName("td");
        xmlstring +='\t\t<FIELD';
        xmlstring +=' name="' + data_tags[0].innerHTML + '"';
        xmlstring +=' pos="' + data_tags[2].getElementsByTagName('input')[0].value + '"';
        xmlstring +=' width="' + data_tags[1].getElementsByTagName('input')[0].value + '"';
        xmlstring +=' value="' +  data_tags[3].getElementsByTagName('input')[0].value + '"';
        xmlstring +=' definition="' + data_tags[6].getElementsByTagName('input')[0].value + '"';
        xmlstring +='/>\n';
    }
    xmlstring +='\t</REG>\n</REGISTERS>'
    return xmlstring;
}

function setDropdownSelect(dropdown_id, selection) {
    var dropdown_obj = document.getElementById(dropdown_id);
    for ( var i = 0; i < dropdown_obj.options.length; i++ ) {
        if ( dropdown_obj.options[i].value === selection ) {
            dropdown_obj.options[i].setAttribute('selected','');
            break;
        }
    }
}