<?php include_once('header.php'); ?>
<div style="center">
	<h2> Welcome to the SWEET Interface </h2>
	<p style="padding:5px;">
		The Speedy Wafer End-to-End Testing (SWEET) project is an initiative by SDSU electrical engineering seniors
		to create an all-inclusive platform for controlling a bare metal microprocessor testing laboratory remotely.
		<br><br>
	</p>
	<h3> Scan Chain Editor </h3>
	<p style="padding:5px;">
		The bit fields of a particular scan chain are listed in a table. Identify the field's purpose by refering to
		the listed name and definition, or with an outside source. After editing the scan chain, send it by pressing
		ENTER in one of the fields or pressing the "Send Scan Chain" button below the table. The scan chain is
		communicated on the protocol selected at the bottom of the table. To restore the default scan chain values,
		click the associated button on the right hand panel. To change default values, the associated XML needs to be
		edited outside of the GUI.
		<br><br>
	</p>
	<h3> GPIB </h3>
	<p style="padding:5px;">
		Pages are custom made to reflect and support each GPIB device. Often times, the buttons shown in the GUI have
		the same function as the buttons on the front panel of the device. Many of the universial commands are listed
		on the left hand panel. "Config GPIB" initializes the USB-GPIB controller. To use a GPIB command not provided 
		by the GUI buttons, type the plain GPIB command sring in the box above the "Send Custom String" button. If the
		custom command is a query, the "Read Result" button retrieves the answer and displays it in the message box. 
		If the buttons stop working, the GPIB address may have changed. To correct this, refer to additional documentation.
		<br><br>
	</p>
	<h3> Contact Check </h3>
	<p style="padding:5px;">
		To determine if the probes are contacting the padcage, this page displays the following values:
			1) ADC voltage measurements
			2) Power supply voltage and current
		<br><br>
	</p>
	<h3> Results </h3>
	<p style="padding:5px;">
		[BETA] This page provides the eye diagram CSV files in a dropdown. Select a CSV and click "Create" to make a PNG
		eye diagram. Select the PNG and click "View" to display it in the GUI. Files are timestamped this way:
		(year)(month)(day)_(hour)(min)(sec)(ms).
		<br>
	</p>
</div>
</html>

