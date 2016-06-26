function loadDate(){
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("date").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "/php/date.php", true);
  xhttp.send();
}

function loadDoc(file){
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      parseXML(this);
    }
  };
  var file = document.getElementById("xml_select").value;
  xhttp.open("GET", file, true);
  xhttp.send();
}
function parseXML(xml) {
  var i;
  var xmlDoc = xml.responseXML;
  var table="<thead><tr><th>NAME</th><th>BIN</th><th>HEX</th><th>DEC</th><th>DEFINITION</th></tr></thead><tbody>";
  var name, width, def, bin_val, hex_val, dec_val;
  var x = xmlDoc.getElementsByTagName("REG")[0].getElementsByTagName("FIELD");
  for (i = 0; i <x.length; i++) {
    name    = x[i].getAttribute("name");
    bin_val = x[i].getAttribute("value");
    width   = x[i].getAttribute("width");
    def     = x[i].getAttribute("definition");
    
    hex_val = parseInt(bin_val, 2).toString(16);
    dec_val = parseInt(bin_val, 2).toString(10);
        
    table += "<tr>";
    table += "<td>" + name + "</td>";
    table += "<td class=\"bin_cell\"><input id=" + name + "_bin type=\"text\" name=" + name + "_bin value=" + bin_val + " oninput=cellChange('" + name + "','bin'," + width + ")></td>";
    
    table += "<td class=\"hex_cell\"><input id=" + name + "_hex type=\"text\" name=" + name + "_hex value=" + hex_val + " oninput=cellChange('" + name + "','hex'," + width + ")></td>";
    
    table += "<td class=\"dec_cell\"><input id=" + name + "_dec type=\"text\" name=" + name + "_dec value=" + dec_val + " oninput=cellChange('" + name + "','dec'," + width + ")></td>";
    
    table += "<td>" + def + "</td>";
    table += "</tr>";
  }
  table += "</tbody>";
  document.getElementById("sc_table").innerHTML = table;
};