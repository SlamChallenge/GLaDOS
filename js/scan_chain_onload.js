window.onload=function() {  
    // load lefthand list of pages
    getNavigation('navigation.html');
    
    // load righthand set of buttons
    getButtons('scan_chain_buttons.html');
    
    // populate the dropdown of xml files
    getXMLFiles();
    
    // set event to stop regular form submission
    document.getElementById('sc_form').onsubmit=function() {
    alert('Caught form submission');
    runXML();
    // return false to prevent the default form behavior
    return false;
    }
}