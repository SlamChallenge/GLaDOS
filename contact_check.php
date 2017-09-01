<?php
$gpib_device="dc_supply"; 
include_once('header.php');
include_once('gpib_post_handler.php');
//query power supply
shell_exec("/usr/bin/python -c \"import Gpib; Gpib.Gpib('".$gpib_device."').write('APPL?')\"");
//read query result
$dc_supply_reading = shell_exec("/usr/bin/python -c \"import Gpib; print(Gpib.Gpib('".$gpib_device."').read(100));\" &>2");
//$dc_supply_reading = shell_exec("/usr/bin/python -c \"import datetime; print(datetime.datetime.now());\"");
//get ADC reading
$adc_voltage = shell_exec("/var/www/html/read_adc");
?>
<div class = "center">
	<div class = "nougat">
		<div style="border-style: outset; border-width: 6px; background-color: limegreen; margin: auto; margin-top: 5%; width: 50%; padding: 10%">
			<table style="font-size: 30px; margin: auto">
				<tr><td style="text-align: center">Supply Voltage (V), Current (A)</td></tr>
				<tr><td style="text-align: center"><?php echo str_replace('"', "", $dc_supply_reading); ?></td></tr>
				<tr><td style="text-align: center">--------------------</td></tr>
				<tr><td style="text-align: center">ADC Reading (V)</td></tr>
				<tr><td style="text-align: center"><?php echo $adc_voltage; ?></td></tr>
			</table>
		</div>		
	</div>
	<?php include_once('message_box.php');?>
</div>
<div class = "buttons">
	<form method = "post" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<input type="hidden" name="gpib_device" value="<?php echo $gpib_device?>">
		<button type = "submit" name="command" value = "clear_logfile">Clear Log</button>
	</form>
</div></body>
</html>

