<?php
$gpib_device="scope";
include_once('header.php');
include_once('gpib_post_handler.php');
?>
<div class = "center">
	<div class = "nougat">
		<form method = "post" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<input type="hidden" name="gpib_device" value="<?php echo $gpib_device?>">
			<select style="float:left;font-size:large;width:44%;margin:2%" name="channel">
				<option value="CHAN1">CHAN1</option>
				<option value="CHAN2">CHAN2</option>
				<option value="CHAN3">CHAN3</option>
				<option value="CHAN4">CHAN4</option>
			</select>
										
			<select style="float:left;font-size:large;width:44%;margin:2%" name="measurement">
				<option value="FREQ">FREQUENCY</option>
				<option value="DUTY">DUTY CYCLE</option>
				<option value="PER">PERIOD</option>
				<option value="VAMP">AMPLITUDE</option>
				<option value="VAV">AVG VOLTAGE</option>
				<option value="VMIN">MIN VOLTAGE</option>
				<option value="VMAX">MAX VOLTAGE</option>
				<option value="VPP">P2P VOLTAGE</option>
			</select>
			
			<button class="scope_cmd" type="submit" name ="command" value="scope_measure">Measure</button>
			
			<button class="scope_cmd" type="submit" name ="command" value="clear_scope_measure">Clear Measurements</button>
			
			<hr>

			<button class="scope_cmd" type="submit" name ="command" value="autoscale">Autoscale</button>
			<button class="scope_cmd" type="submit" name ="command" value="run">Run</button>
			<button class="scope_cmd" type="submit" name ="command" value="single">Single</button>
			<button class="scope_cmd" type="submit" name ="command" value="clear_disp">Clear Display</button>
		</form>
		
		<hr>
		
		<?php include_once('gpib_custom_string.php');?>
	</div>
	<?php include_once('message_box.php');?>
</div>
<?php include_once('gpib_buttons.php');?>
</body>
</html>
