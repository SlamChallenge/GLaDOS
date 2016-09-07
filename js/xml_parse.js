function parseXML(xml) {
  var i;
  var xmlDoc = xml.responseXML;
  var table='<thead><tr><th>NAME</th><th>BIN</th><th>HEX</th><th>DEC</th><th>DEFINITION</th></tr></thead><tbody>';
  var name, width, def, bin_val, hex_val, dec_val, pos;
  var x = xmlDoc.getElementsByTagName('REG')[0].getElementsByTagName('FIELD');
  for (i = 0; i <x.length; i++) {
    name    = x[i].getAttribute('name');
    bin_val = x[i].getAttribute('value');
    width   = x[i].getAttribute('width');
    pos   = x[i].getAttribute('pos');
    def     = x[i].getAttribute('definition');
    
    hex_val = parseInt(bin_val, 2).toString(16);
    dec_val = parseInt(bin_val, 2).toString(10);
        
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
  document.getElementById('sc_table').innerHTML = table;
};