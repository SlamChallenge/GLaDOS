<?php 
    file_put_contents("../xml/last_run.xml",$_POST['xml']);
    shell_exec("python /path/to/send_scan_chain.py ../xml/last_run.xml");
?>