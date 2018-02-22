function getHeaderMeasurements() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('header_table').innerHTML = this.responseText;
        }
    };
    xhttp.open('POST', '/php/pi_functions.php', true);
    xhttp.send('function=piGetHeaderMeasurements');
}

function loadXmlToHtmlTable() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            writeLog('Processing xml file ' + this.responseURL);
            var html_table = convertRegisterXmlToHtmlTable(this);
            document.getElementById('sc_table').innerHTML = html_table;
        }
    };
    var file = '/xml/' + document.getElementById('xml_select').value;
    writeLog('Loading xml file ' + file);
    xhttp.open('GET', file, true);
    xhttp.send();
}

function sendXML() {
    writeLog('Saving and running quick_run.xml');
    saveHtmlTableToFile('quick_run.xml');
    var http = new XMLHttpRequest();
    http.open("POST", 'php/pi_functions.php', true);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('function=piRunPythonScript&script=../rch-wafer-lab/14nm_dd2_kerf_pi/iowrite.py&args=xml/quick_run.xml');
}

function saveHtmlTableToFile(filename) {
    //Check than an xml has been loaded
    if( document.getElementById('sc_table').childElementCount == 0 ) return;
    if ( filename == undefined ) {
      var filename = prompt("New XML file name", "custom.xml");
    }
    if ( filename == null || filename == "" ) {
        alert("No name entered.");
    } else if ( filename.search(/\s/) != -1 ) {
        alert('Cannot contain spaces');
    } 
    else if ( filename.search('\.xml$') == -1 ) {
        alert('Must be an .xml file');
    }
    else {
        var http = new XMLHttpRequest();
        http.open("POST", 'php/pi_functions.php', false);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        writeLog('Saving new xml ' + filename);
        http.send('function=piWriteFile&file=/xml/' + filename + '&string=' + convertHtmlTabletoRegisterXml());
        populateXmlSelect(false);
        setDropdownSelect('xml_select', filename);
    }
}

function writeLog(string, mode = 'append') {
    if ( string === undefined ) {
        string = document.getElementById('message_input').value;
    }
    var http = new XMLHttpRequest();
    http.open("POST", 'php/pi_functions.php', true);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('function=piWriteFile&file=/logs/website.log&mode=' + mode + '&string=' + string + '\n');
}

function resetStream() {
    document.getElementById('message').innerHTML = '';
    var xhr = new XMLHttpRequest();
    xhr.open("POST", 'php/stream_log.php', true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send('reset');
}

function clearLog(string) {
    if ( string === undefined ) {
        string = "Log cleared on " + getDate();
    }
    writeLog(string, 'overwrite');
    resetStream();
}

function runTest() {
    var http = new XMLHttpRequest();
    http.open("POST", 'php/pi_functions.php', true);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    var path = document.getElementById('test_path').innerHTML;
    var script = document.getElementById('test_script').innerHTML;
    var table_rows = document.getElementById('test_table').getElementsByTagName('tr');
    var args = '';
    // start after the path and script. Quit before the description
    for ( var i = 2; i < table_rows.length - 1; i++ ) {
        var row_cells = table_rows[i].getElementsByTagName('td');
        args += row_cells[1].firstChild.value + ' ';
    }
    http.send('function=piRunPythonScript&script=' + path + script + '&args=' + args );
}