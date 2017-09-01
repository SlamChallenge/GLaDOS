<?php
$gpib_device="dc_supply";
include_once('header.php');
include_once('gpib_post_handler.php');
?>
<div class = "center">
	<div class = "nougat">
		<form method = "post" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<input type="hidden" name="gpib_device" value="<?php echo $gpib_device?>">
		<table>
		   <tbody>
				<tr align="left">
					<td><button style="float:left;font-size:large;width:100%;margin:2%" type="submit" name ="command" value="supply_output_on">Output ON</button></td>
				</tr>
				<tr align="left">	
					<td><button style="float:left;font-size:large;width:100%;margin:2%" type="submit" name ="command" value="supply_output_off">Output OFF</button></td>
				</tr>
				<tr align="left">
					<td style="font-size:x-large; padding:2%;">Output: </td>
					<td><select name="output" style="float:left;font-size:large;width:90%;margin:2%">
						 <option value="P6V" <?php if($_SESSION[$gpib_device."_array"]["output"]=="P6V"): echo " selected"; endif;?>>+6V</option>
						 <option value="P25V" <?php if($_SESSION[$gpib_device."_array"]["output"]=="P25V"): echo " selected"; endif;?>>+25V</option>
						 <option value="N25V" <?php if($_SESSION[$gpib_device."_array"]["output"]=="N25V"): echo " selected"; endif;?>>-25V</option>
					</td>
				</tr>
				<tr align="left">
						<td style="font-size:x-large; padding:2%;">Voltage:</td>
						<td><input style="font-size:x-large;width:90%;margin:5%" type="text" name="supply_voltage" value="<?php echo $_SESSION[$gpib_device."_array"]["supply_voltage"];?>"></td>
						<td style="font-size:x-large;">
							<input type="radio" name="supply_voltage_u" value="mV" <?php if($_SESSION[$gpib_device."_array"]["supply_voltage_u"]=="mV"): echo " checked"; endif;?>>mV&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="radio" name="supply_voltage_u" value="V" <?php if($_SESSION[$gpib_device."_array"]["supply_voltage_u"]=="V"): echo " checked"; endif;?>>V
						</td>
				</tr>
				<tr align="left">
						<td style="font-size:x-large; padding:2%;">Current Limit:</td>
						<td><input style="font-size:x-large;width:90%;margin:5%" type="text" name="supply_current" value="<?php echo $_SESSION[$gpib_device."_array"]["supply_current"];?>"></td>
						<td style="font-size:x-large;">
							<input type="radio" name="supply_current_u" value="mA" <?php if($_SESSION[$gpib_device."_array"]["supply_current_u"]=="mA"): echo " checked"; endif;?>>mA&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="radio" name="supply_current_u" value="A" <?php if($_SESSION[$gpib_device."_array"]["supply_current_u"]=="A"): echo " checked"; endif;?>>A
						</td>
				</tr>
				<tr>
						<td><button style="float:left;font-size:large;width:100%;margin:2%" type="submit" name ="command" value="set_dc_supply">Send</button></td>
				</tr>
			</tbody>
		</table>
	</form>
			
			<hr>
			
	<?php include_once('gpib_custom_string.php');?>
	</div>
	<?php include_once('message_box.php');?>
</div>
<?php include_once('gpib_buttons.php');?>
</html>

