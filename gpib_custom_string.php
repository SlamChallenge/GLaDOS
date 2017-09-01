<form method = "post" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<input type="hidden" name="gpib_device" value="<?php echo $gpib_device?>">
	<input style="margin:2%;width:80%;font-size:large;float:left;" type="text" name="gpib_custom_string">
		<button class="scope_cmd" type="submit" name ="command" value="custom_string">Send Custom String</button>
		<button class="scope_cmd" type="submit" name ="command" value="read_result">Read Result</button>
</form>
