window.onload=function() {  
    // load lefthand list of pages
    insertHTML('navigation.html', 'navigation', false);
    highlightCurrentPage();
    
    // set event to stop all regular form submission
    document.getElementsByTagName('form').onsubmit=function() {
    alert('Caught form submission');
    // return false to prevent the default form behavior
    return false;
    }
    
    // get the name of the current page
    var page = window.location.pathname.split("/").pop();
    
    // take specific actions based on the page
    switch ( page ) {
        case "": //index.html
            break;
        case "scan_chain.html":
            insertHTML('scan_chain_buttons.html', 'buttons');
            insertHTML('message_box.html', 'message_box');
            getHeaderMeasurements(); window.setInterval(getHeaderMeasurements, 30000);
            initStream('php/stream_log.php');
            populateXmlSelect();
            break;
        case "test_hub.html":
            insertHTML('test_hub_buttons.html', 'buttons');
            insertHTML('message_box.html', 'message_box');
            getHeaderMeasurements(); window.setInterval(getHeaderMeasurements, 30000);
            initStream('php/stream_log.php');
            populateTestSelect();
            break;
        default:
            break;
    }
}