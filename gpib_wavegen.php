<?php
$gpib_device="wavegen";
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
					<td style="font-size:x-large; padding:2%;">Shape:</td>
					<td><select name="shape" style="float:left;font-size:large;width:90%;margin:2%">
						 <option value="SIN" <?php if($_SESSION[$gpib_device."_array"]["shape"]=="SIN"): echo " selected"; endif;?>>sinusoid</option>
						 <option value="SQU" <?php if($_SESSION[$gpib_device."_array"]["shape"]=="SQU"): echo " selected"; endif;?>>square</option>
						 <option value="TRI" <?php if($_SESSION[$gpib_device."_array"]["shape"]=="TRI"): echo " selected"; endif;?>>triangle</option>
						 <option value="RAMP" <?php if($_SESSION[$gpib_device."_array"]["shape"]=="RAMP"): echo " selected"; endif;?>>ramp</option>
						</td>
					</tr>
					<tr align="left">
						<td style="font-size:x-large; padding:2%;">Frequency:</td>
						<td><input style="font-size:x-large;width:90%;margin:5%" type="text" name="freq" value="<?php echo $_SESSION[$gpib_device."_array"]["freq"];?>"></td>
						<td style="font-size:x-large;"><input type="radio" name="freq_u" value="mHz">mHz&nbsp;&nbsp;
							 <input type="radio" name="freq_u" value="Hz" <?php if($_SESSION[$gpib_device."_array"]["freq_u"]=="Hz"): echo " checked"; endif;?>>Hz&nbsp;&nbsp;
							 <input type="radio" name="freq_u" value="kHz" <?php if($_SESSION[$gpib_device."_array"]["freq_u"]=="kHz"): echo " checked"; endif;?>>kHz&nbsp;&nbsp;
							 <input type="radio" name="freq_u" value="MHz" <?php if($_SESSION[$gpib_device."_array"]["freq_u"]=="MHz"): echo " checked"; endif;?>>Mhz
						</td>
					</tr>
					<tr align="left">
						<td style="font-size:x-large; padding:2%;">Amplitude:</td>
						<td><input style="font-size:x-large;width:90%;margin:5%" type="text" name="amp" value="<?php echo $_SESSION[$gpib_device."_array"]["amp"];?>"></td>
						<td style="font-size:x-large;">
							<input type="radio" name="amp_u" value="mV" <?php if($_SESSION[$gpib_device."_array"]["amp_u"]=="mV"): echo " checked"; endif;?>>mV&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="radio" name="amp_u" value="V" <?php if($_SESSION[$gpib_device."_array"]["amp_u"]=="V"): echo " checked"; endif;?>>V
						</td>
					</tr>
					<tr align="left">
						<td style="font-size:x-large; padding:2%;">Offset:</td>
						<td><input style="font-size:x-large;width:90%;margin:5%" type="text" name="offset" value="<?php echo $_SESSION[$gpib_device."_array"]["offset"];?>"></td>
						<td style="font-size:x-large;">
							<input type="radio" name="offset_u" value="mV" <?php if($_SESSION[$gpib_device."_array"]["offset_u"]=="mV"): echo " checked"; endif;?>>mV&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="radio" name="offset_u" value="V" <?php if($_SESSION[$gpib_device."_array"]["offset_u"]=="V"): echo " checked"; endif;?>>V
						</td>
					</tr>
					<tr>
						<td><button style="float:left;font-size:large;width:100%;margin:2%" type="submit" name ="command" value="custom_waveform">Send</button></td>
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
