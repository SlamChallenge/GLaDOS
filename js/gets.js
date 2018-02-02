function getXMLFiles() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var xml_dropdown = document.getElementById('xml_select');
            var xml_files = this.responseText.split(',');
            var select_string = '';
            for (i = 0; i < xml_files.length; i++) {
                select_string+='<option value="/xml/' + xml_files[i] + '">' +  xml_files[i] + '</option>';
            }
            xml_dropdown.innerHTML = select_string;
        }
    };
    xhttp.open('GET', 'php/get_xml_files.php', true);
    xhttp.send();
}

function getNavigation(html_file) {
    var nav_request = new XMLHttpRequest();
    nav_request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('navigation').innerHTML = this.responseText;
            hightlightCurrentPage();
        }
    };
    nav_request.open('GET', html_file, true);
    nav_request.send();    
}

function getButtons(html_file) {
    var buttons_request = new XMLHttpRequest();
    buttons_request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('buttons').innerHTML = this.responseText;
        }
    };
    buttons_request.open('GET', html_file, true);
    buttons_request.send();
}