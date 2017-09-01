<?php
include_once('php_functions.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") :
	//TODO use escapeshellcommand() for security
	switch ($_POST["command"]) :
		case "clear_logfile":
			shell_exec("echo \"Logfile cleared.\" > ".$logfile);
			break;
		case "create_heatmap":
			$result=shell_exec("sudo /var/www/html/gnuplot/heatmap.sh ".$_POST["heatmap_file"]." >> ".$logfile);
			$_SESSION["heatmap_file"]=$_POST["heatmap_file"];
			//echo "<pre>$result</pre>";
			break;
		case "view_heatmap":
			$_SESSION["heatmap_image"]=$_POST["heatmap_image"];
			break;
		case "new_random_data":
			$result=shell_exec("sudo /var/www/html/gnuplot/create_rand_data.sh >> ".$logfile);
			//echo "<pre>$result</pre>";
			break;
		default:
			shell_exec("echo \"Command doesn't have action.\" >> ".$GLOBALS["logfile"]);
			break;
	endswitch;	
endif;
?>
