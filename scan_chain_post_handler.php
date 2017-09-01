<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") :
	//TODO use escapeshellcommand() for security
	switch ($_POST["command"]) :
		// CLEAR LOGFILE
		case "clear_logfile":
			shell_exec("echo \"Logfile cleared.\" > ".$logfile);
			break;
		// EDITING SCAN CHAIN
		case "send_sc":
			$_SESSION["sc_array_".$scan_chain_type] = $_POST;
			unset($_SESSION["sc_array_".$scan_chain_type]["command"]);
			unset($_SESSION["sc_array_".$scan_chain_type]["scan_chain_type"]);
			shell_exec("echo \"Scan chain sent.\" >> ".$logfile);
			if($_SESSION["sc_array_".$scan_chain_type]["comm_type"]=="legacy") {
				shell_exec("sudo /var/www/html/txsc legacy ".implode("",array_map("decbin",$_SESSION["sc_array_".$scan_chain_type])));
			} else {
				shell_exec("sudo /var/www/html/txsc spi ".implode("",array_map("decbin",$_SESSION["sc_array_".$scan_chain_type])));
			}
			break;
		case "reset_sc":
			unset($_SESSION["sc_array_".$scan_chain_type]);
			break;
		// SCAN CHAIN BUTTONS
		case "init_calblock":
			shell_exec("echo \"Initialized calibration block.\" >> ".$logfile);
			break;
		case "scan_chain_retrieve":
			shell_exec("echo \"Retrieved scan chain.\" >> ".$logfile);
			break;
		case "cal_request":
			//set cal request bit
			$_SESSION["sc_array_".$scan_chain_type]["calreq"] = 1;
			//send scan chain
			shell_exec("echo \"".implode("",array_map("decbin",$_SESSION["sc_array_".$scan_chain_type]))."\" >> ".$logfile);
			//unset cal request bit
			$_SESSION["sc_array_".$scan_chain_type]["calreq"] = 0;
			//send scan chain again
			shell_exec("echo \"".implode("",array_map("decbin",$_SESSION["sc_array_".$scan_chain_type]))."\" >> ".$logfile);
			break;
		case "read_serial_data":
			shell_exec("echo \"Serial data read into file.\" >> ".$logfile);
			break;
		case "impedance_cal":
			shell_exec("echo \"Performed impedance calibration.\" >> ".$logfile);
			break;
		case "eye_diagram":
			shell_exec("echo \"Gathered eye diagram data.\" >> ".$logfile);
			break;
		case "reset_pll":
			//set cal request bit
			//$_SESSION["sc_array_".$scan_chain_type]["calreq"] = 1;
			//send scan chain
			//shell_exec("echo \"".implode("",array_map("decbin",$_SESSION["sc_array_".$scan_chain_type]))."\" >> ".$logfile);
			//unset cal request bit
			//$_SESSION["sc_array_".$scan_chain_type]["calreq"] = 0;
			//send scan chain again
			//shell_exec("echo \"".implode("",array_map("decbin",$_SESSION["sc_array_".$scan_chain_type]))."\" >> ".$logfile);
			shell_exec("echo \"PLL reset.\" >> ".$logfile);
			break;
	endswitch;
endif;

include_once('php_functions.php');
?>
