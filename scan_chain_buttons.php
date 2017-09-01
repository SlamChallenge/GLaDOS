<div class = "buttons">
	<form method = "post" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<button type = "submit" name="command" value = "reset_sc">Reset Chain</button>
		<button type = "submit" name="command" value = "scan_chain_retrieve">Recieve Chain</button>
		<button type = "submit" name="command" value = "init_calblock">Init Calblock</button>
		<button type = "submit" name="command" value = "cal_request">Cal Request</button>
		<button type = "submit" name="command" value = "read_serial_data">Read Serial Data</button>
		<button type = "submit" name="command" value = "impedance_cal">Impedance Cal</button>
		<button type = "submit" name="command" value = "eye_diagram">Eye Diagram</button>
		<button type = "submit" name="command" value = "reset_pll">Reset PLL</button>
		<button type = "submit" name="command" value = "clear_logfile">Clear Log</button>
	</form>
</div>
