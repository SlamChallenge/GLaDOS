<?php
	$xml=simplexml_load_file($xml_file) or die("Error: Cannot create object");
	
	if (!isset($_SESSION["sc_array_".$scan_chain_type])) : //if the scan chain array has not been created
		foreach ($xml->FIELD as $section) : //fill it with default xml values
				$_SESSION["sc_array_".$scan_chain_type][trim($section->NAME->__toString(), '"')] = bindec(intval(trim($section->VALUE->__toString(), '"')));
		endforeach;
	endif;
?>
<script>
function updateCols(name, type) {
	var dec_col = document.getElementsByName(name);
	var hex_name = name.concat('_hex');
	var hex_col = document.getElementsByName(hex_name);
	var bin_name = name.concat('_bin');
	var bin_col = document.getElementsByName(bin_name);
	
	if ( type == 0) {
		console.log(dec_col["0"].value)
		console.log(bin_col["0"].value)
		hex_col["0"].value = parseInt(dec_col["0"].value, 10).toString(16);
		bin_col["0"].value = parseInt(dec_col["0"].value, 10).toString(2);
	}
	else if ( type == 1) {
		dec_col["0"].value = parseInt(hex_col["0"].value, 16).toString(10)
		bin_col["0"].value = parseInt(hex_col["0"].value, 16).toString(2)
	}
	else if ( type == 2) {
		dec_col["0"].value = parseInt(bin_col["0"].value, 2).toString(10)
		hex_col["0"].value = parseInt(bin_col["0"].value, 2).toString(16)
	}
}
</script>

<div class = "nougat">
	<form method = "post" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<input type="hidden" name="scan_chain_type" value="<?php echo $scan_chain_type; ?>">
		<table class = "scan_chain">
		   <thead>
			  <tr>
				<th style="text-align:left">NAME</th><th>DEC</th><th>HEX</th><th>BIN</th><th style="text-align:left">DEFINITION</th>
			  </tr>
		   </thead>
		   <tbody>
<?php 
				foreach ($xml->FIELD as $section) :
					echo "<tr>";
					foreach ( $section->children() as $element) :
						if($element->getName() == "VALUE") {
							echo "<td class=\"val_col\">"."<input type=\"number\" min=0 max=".((2**intval(trim($section->WIDTH->__toString(), '"')))-1)." name=".$section->NAME->__toString()." value=".($_SESSION["sc_array_".$scan_chain_type][trim($section->NAME->__toString(), '"')])." onchange=\"updateCols('".trim($section->NAME->__toString(), '"')."', 0)\"></td>\n";
							echo "<td id=\"hex_col\" class=\"val_col\">"."<input type=\"text\" name=\"".trim($section->NAME->__toString(), '"')."_hex\" value=".dechex(intval(($_SESSION["sc_array_".$scan_chain_type][trim($section->NAME->__toString(), '"')])))." onchange=\"updateCols('".trim($section->NAME->__toString(), '"')."', 1)\"></td>\n";
							echo "<td id=\"bin_col\" class=\"val_col\">"."<input type=\"text\" name=\"".trim($section->NAME->__toString(), '"')."_bin\" value=".decbin(intval(($_SESSION["sc_array_".$scan_chain_type][trim($section->NAME->__toString(), '"')])))." onchange=\"updateCols('".trim($section->NAME->__toString(), '"')."', 2)\"></td>\n";
						}
						else if ($element->getName() == "NAME")
							echo "<td class=\"name_col\">".trim($element->__toString(), '"')."</td>\n";
						else if ($element->getName() == "DEF")
							echo "<td class=\"def_col\">".trim($element->__toString(), '"')."</td>\n";
					endforeach;
					echo "</tr>";
				endforeach; 
?>
				
			</tbody>
		</table>
		<button style="float:left; width: 50%; margin: 5px 5px; font-size: 20px" type="submit" name ="command" value="send_sc">Send Scan Chain</button>
		<select style="float:left; width: 10%; margin: 5px 5px; font-size: 20px" name="comm_type" style="margin:auto;">
			<option value="SPI" <?php if($_SESSION["sc_array_".$scan_chain_type]["comm_type"]=="SPI"): echo " selected"; endif;?>>SPI</option>
			<option value="legacy" <?php if($_SESSION["sc_array_".$scan_chain_type]["comm_type"]=="legacy"): echo " selected"; endif;?>>SBB</option>
		</select>
	</form>
</div>
