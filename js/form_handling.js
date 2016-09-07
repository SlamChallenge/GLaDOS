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

function cellChange(name, radix, width) {

    var bin_cell = document.getElementById(name + "_bin");
    var hex_cell = document.getElementById(name + "_hex");
    var dec_cell = document.getElementById(name + "_dec");
    
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
        bin_cell.style = undefined;
        hex_cell.style = undefined;
        dec_cell.style = undefined;
    }
}