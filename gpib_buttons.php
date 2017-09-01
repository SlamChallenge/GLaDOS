<div class = "buttons">
	<form method = "post" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<input type="hidden" name="gpib_device" value="<?php echo $gpib_device?>">
		<button type = "submit" name="command" value = "gpib_status">Status</button>
		<button type = "submit" name="command" value = "gpib_reset">Reset</button>
		<button type = "submit" name="command" value = "gpib_identify">Identify</button>
		<button type = "submit" name="command" value = "gpib_clear">Clear</button>
		<button type = "submit" name="command" value = "gpib_arm">Arm</button>
		<button type = "submit" name="command" value = "gpib_trigger">Trigger</button>
		<button type = "submit" name="command" value = "gpib_config">Config GPIB</button>
		<button type = "submit" name="command" value = "read_adc">Read ADC</button>
		<button type = "submit" name="command" value = "clear_logfile">Clear Log</button>
	</form>
</div>
