<?php
function dispcmd($cmd_string) {
	shell_exec("echo \"import Gpib; Gpib.Gpib('".$_POST["gpib_device"]."').write('".$cmd_string."')\" >> ".$GLOBALS["logfile"]);
}

function pycmd($cmd_string) {
	//dispcmd($cmd_string);
	shell_exec("/usr/bin/python -c \"import Gpib; Gpib.Gpib('".$_POST["gpib_device"]."').write('".$cmd_string."')\"");
}

function pyrd() {
	shell_exec("/usr/bin/python -c \"import Gpib; print(Gpib.Gpib('".$_POST["gpib_device"]."').read(100));\" >> ".$GLOBALS["logfile"]);	
}

function pyqry($cmd_string) {
	pycmd($cmd_string);
	if($_POST["command"] == "scope_measure")
		shell_exec("echo \"".$_POST["channel"]." ".$_POST["measurement"].": \" >> ".$GLOBALS["logfile"]);
	pyrd();
}
?>
