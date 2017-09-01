<?php
include_once('php_functions.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") :
	//TODO use escapeshellcommand() for security
	switch ($_POST["command"]) :
		// GPIB COMMANDS: DC SUPPLY
		case "set_dc_supply":
			$_SESSION[$_POST["gpib_device"]."_array"] = $_POST;
			pycmd("APPL ".$_POST["output"].", ".$_POST["supply_voltage"].$_POST["supply_voltage_u"].", ".$_POST["supply_current"].$_POST["supply_current_u"]);
			break;
		case "supply_output_on":
			pycmd("OUTPUT ON");
			break;
		case "supply_output_off":
			pycmd("OUTPUT OFF");
			break;
		// CLEAR LOGFILE
		case "clear_logfile":
			shell_exec("echo \"Logfile cleared.\" > ".$logfile);
			break;
		// CUSTOM WAVEFORM
		case "custom_string":
			pycmd($_POST["gpib_custom_string"]);
			break;
		// GPIB COMMANDS: SCOPE
		case "scope_measure":
			$_SESSION[$_POST["gpib_device"]."_array"] = $_POST;
			pyqry(":MEAS:".$_POST["measurement"]." ".$_POST["channel"].";".$_POST["measurement"]."? ".$_POST["channel"]);
			break;
		case "clear_scope_measure":
			pycmd(":MEAS:CLE");
			break;
		case "read_result":
			pyrd();
			break;
		case "autoscale":
			pycmd(":AUTOSCALE");
			break;
		case "run":
			pycmd(":RUN");
			break;
		case "single":
			pycmd(":SINGLE");
			break;
		case "stop":
			pycmd(":STOP");	
			break;	
		case "clear_disp":
			pycmd(":DISP:CLE");
			break;
		// GPIB COMMANDS: WAVEGEN	
		case "custom_waveform":
			$_SESSION[$_POST["gpib_device"]."_array"] = $_POST;
			pycmd("APPL:".$_POST["shape"]." ".$_POST["freq"].$_POST["freq_u"].", ".$_POST["amp"].$_POST["amp_u"].", ".$_POST["offset"].$_POST["offset_u"]);
			break;
		// GPIB COMMANDS: GENERAL
		case "gpib_config":
			shell_exec("sudo /usr/local/sbin/gpib_config");
			shell_exec("echo \"Configured GPIB controller.\" >> ".$GLOBALS["logfile"]);
			break;
		case "read_adc":
			shell_exec("echo -n \"ADC Voltage:\" >> ".$GLOBALS["logfile"]);
			shell_exec("/var/www/html/read_adc >> ".$GLOBALS["logfile"]);
			break;
		case "gpib_reset":
			pycmd("*RST");
			break;
		case "gpib_identify":
			pyqry("*IDN?");
			break;
		case "gpib_clear":
			pycmd("*CLS");
			break;
		case "gpib_status":
			pyqry("*STB?");
			break;
		case "gpib_arm":
			pycmd("*ARM");
			break;
		case "gpib_trigger":
			pycmd("*TRIG");
			break;
		default:
			shell_exec("echo \"Command doesn't have action.\" >> ".$GLOBALS["logfile"]);
			break;
	endswitch;	
endif;
?>
