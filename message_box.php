<div class="message" id="message_box">
	<p class="message">
<?php 
	$message_length = 20;
	$guilog_length = intval(shell_exec("wc -l < ".$logfile));
	if ($guilog_length > $message_length) $guilog_length = $message_length;
	for ($i = $guilog_length; $i > 0; $i--) :
		echo shell_exec("tail -".$i." /var/www/html/gui.log | head -1"); echo "<br>";
	endfor;
?>
<script>
var objDiv = document.getElementById("message_box");
objDiv.scrollTop = objDiv.scrollHeight;
</script>	
	</p>
</div>
