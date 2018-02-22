function initStream(file) {
    if(typeof(EventSource) !== "undefined") {
        var source = new EventSource(file);
        source.onmessage = function(event) { 
            document.getElementById('message').innerHTML += event.data + '\n';
            setScrollbarBottom('message_box');
        };
        source.onerror = function(event) {
            if( source.readyState == 2 ) setTimeout(initStream(file), 5000);
        };
    } else {
        document.getElementById('message').innerHTML = 'ERROR: This browser does not support server sent events.';
    }
}

function highlightCurrentPage() {
    var current_path = window.location.pathname;
    var nav_links = document.getElementsByTagName("A");
    for (var i = 0; i < nav_links.length; i++) {
        if ( nav_links[i].pathname === current_path ) {
            nav_links[i].parentElement.className = "active";
            break;
        }
        else nav_links[i].parentElement.className = "";
    }
}

function getDate() {
    var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    var days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    var d = new Date();
    var day = days[d.getDay()];
    var hr = d.getHours();
    var min = d.getMinutes();
    if (min < 10) {
        min = "0" + min;
    }
    var ampm = "am";
    if( hr > 12 ) {
        hr -= 12;
        ampm = "pm";
    }
    var date = d.getDate();
    var month = months[d.getMonth()];
    var year = d.getFullYear();
    var x = document.getElementById("time");
    return day + " " + hr + ":" + min + ampm + " " + date + " " + month + " " + year;
}

function setScrollbarBottom( id ) {
    var element = document.getElementById(id);
    element.scrollTop = element.scrollHeight;
}