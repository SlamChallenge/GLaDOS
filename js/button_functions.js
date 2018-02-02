function loadMeas(){
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById('header_table').innerHTML = this.responseText;
    }
  };
  xhttp.open('GET', '/php/get_header.php', true);
  xhttp.send();
}

function loadDate(){
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById('date').innerHTML = this.responseText;
    }
  };
  xhttp.open('GET', '/php/date.php', true);
  xhttp.send();
}

function loadDoc(file){
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      parseXML(this);
    }
  };
  var file = document.getElementById('xml_select').value;
  xhttp.open('GET', file, true);
  xhttp.send();
}

function runXML() {
    var http = new XMLHttpRequest();
    http.onreadystatechange = function() {
        document.getElementById('message').innerHTML = '<pre>' + this.responseText + '</pre>';
    }
    http.open("POST", 'php/run_xml.php', true);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('xml=' + parseTable());
}

function saveXML() {
    var filename = prompt("New XML file name", "custom.xml");
    if (filename == null || filename == "") {
        alert("No name entered.");
    } else {
        var http = new XMLHttpRequest();
        http.open("POST", 'php/save_xml.php', false);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send('newfile=' + filename + '&xml=' + parseTable());
        getXMLFiles();
    }  
}