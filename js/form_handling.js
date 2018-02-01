window.onload=function() {
    //loadDoc();
    var current_path = window.location.pathname;
    var nav_links = document.getElementsByTagName("A");
    for (var i = 0; i < nav_links.length; i++) {
        console.log(nav_links[i].pathname);
        if ( nav_links[i].pathname === current_path ) {
            nav_links[i].parentElement.className = "active";
            break;
        }
        else nav_links[i].parentElement.className = "";
    }
    document.getElementById('sc_form').onsubmit=function() {
    /* do what you want with the form */
    
    // Should be triggered on form submit
    alert('Caught form submission');
    // You must return false to prevent the default form behavior
    return false;
  }
}

function highlightCell(cell_id) {
    document.getElementById(cell_id).style.backgroundColor = "yellow";
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
        bin_cell.style.backgroundColor = "tomato";
        hex_cell.style.backgroundColor = "tomato";
        dec_cell.style.backgroundColor = "tomato";
    }
    else {
        highlightCell(bin_id);
        highlightCell(hex_id);
        highlightCell(dec_id);
    }
}

function parseTable() {
    var table_rows = document.getElementById("sc_table").getElementsByTagName("tr");
    var xmlstring = '<REGISTERS>\n\t<REG name="pll" address="28" length="256">\n'
    for (i = 1; i < table_rows.length; i++) {
        var data_tags = table_rows[i].getElementsByTagName("td");
        xmlstring +='\t\t<FIELD';
        xmlstring +=' name="' + data_tags[0].innerHTML + '"';
        xmlstring +=' width="' + data_tags[1].getElementsByTagName('input')[0].value + '"';
        xmlstring +=' pos="' + data_tags[2].getElementsByTagName('input')[0].value + '"';
        xmlstring +=' value="' +  data_tags[5].getElementsByTagName('input')[0].value + '"';
        xmlstring +=' definition="' + data_tags[6].getElementsByTagName('input')[0].value + '"';
        xmlstring +='/>\n';
    }
    xmlstring +='\t</REG>\n</REGISTERS>'
    console.log(xmlstring);
    return xmlstring;
}

function sendXML(php_file, string) {
    var http = new XMLHttpRequest();
    http.open("POST", 'php/'+php_file, true);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send(string);
}

function runXML() {
    sendXML('run_xml.php', 'xml=' + parseTable());
}

function saveXML() {
    var filename = prompt("New XML file name", "custom.xml");
    if (filename == null || filename == "") {
        alert("No name entered.");
    } else {
        sendXML('save_xml.php', 'newfile=' + filename + '&xml=' + parseTable());
    }   
}