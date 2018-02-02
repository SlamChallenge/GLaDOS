<?php 
    //file_put_contents("../xml/last_run.xml",$_POST['xml']);
    
    //system("python /path/to/send_scan_chain.py ../xml/last_run.xml", $return);
    //echo('Attempting to run a script.');
    // format as json
    //ob_start();
    //ob_capture();
    //ob_final_flush();
    //system('../test.sh', $return);
    system("dir 2>&1", $return);
    echo('Return value is '.$return);
?>