<?php

header('Content-Type: text/event-stream');
header('Cache-Control: no-cache'); // recommended to prevent caching of event data.

// start a session
session_start();

// reset line count if requested
if ( preg_match( '/reset/', file_get_contents('php://input') ) ) {
    file_put_contents('out.log','Resetting line count'.PHP_EOL,FILE_APPEND);
    $_SESSION['previous_num_lines'] = 0;
    exit();
}

// turn on output buffering
ob_start();

// for a new connection, start at the file's beginning
if ( !isset($_SESSION['previous_num_lines'] ) ) {
    $_SESSION['previous_num_lines'] = 0; // number of lines down
}

// read in the entire file
$lines = file('../logs/website.log');
// count the lines in the file
$num_lines = count($lines);

// if more lines have been written since last time
//file_put_contents('out.log','Num old lines '.$_SESSION['previous_num_lines'].PHP_EOL,FILE_APPEND);
//file_put_contents('out.log','Num new lines '.$num_lines.PHP_EOL,FILE_APPEND);
if ( $num_lines > $_SESSION['previous_num_lines'] ) {
    //echo 'id: log'.PHP_EOL;
    //echo 'retry: 1000'.PHP_EOL;
    echo 'event: message'.PHP_EOL;
    for( $i = $_SESSION['previous_num_lines']; $i < $num_lines; $i++ ) {
        echo 'data: '.$lines[$i].PHP_EOL;
    }
    
    $_SESSION['previous_num_lines'] = $num_lines;

} else {
    // send an event anyway to keep the connection alive
    echo 'event: message'.PHP_EOL;
    // increase the wait time
    //echo 'retry: 10000'.PHP_EOL;
    // send empty message
    echo ':'.PHP_EOL;
}

// terminate the event string with blank line
echo PHP_EOL;
// send the event
$event = ob_get_contents();
//file_put_contents('out.log','Sending '.$event.PHP_EOL,FILE_APPEND);
ob_flush();
flush();

?>