function populateXmlSelect(async_bool = true) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var xml_dropdown = document.getElementById('xml_select');
            var xml_files = this.responseText.split(',');
            var select_string = '';
            for (i = 0; i < xml_files.length; i++) {
                select_string+='<option value="' + xml_files[i] + '">' +  xml_files[i] + '</option>';
            }
            xml_dropdown.innerHTML = select_string;
        }
    };
    xhttp.open('POST', 'php/pi_functions.php', async_bool);
    xhttp.send('function=piGetXmlFiles');
}

function populateTestSelect() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            convertScriptXmlToHtmlTable(this);
        }
    };
    xhttp.open('GET', 'scripts.xml', true);
    xhttp.send();
}

function insertHTML( html_file, id, async_bool = true) { 
    var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById(id).innerHTML = this.responseText;
        }
    };
    ajax.open('GET', html_file, async_bool);
    ajax.send();
}