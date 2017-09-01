<?php
$scan_chain_type="tx";
$xml_file="XML/scan_chain_tx.xml";
include_once('header.php');
include_once('scan_chain_post_handler.php');
?>
<div class = "center">
	<?php include_once('scan_chain_table.php');?>	
	<?php include_once('message_box.php');?>
</div>
<?php include_once('scan_chain_buttons.php');?>
</html>
