<!DOCTYPE html>
<html lang="en-US">
<?php
// Start a session if one hasn't already started
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

// Populate a key=>value array of url's and page names
	$pages = array();
	$pages["index.php"] = "Home";
	$pages["gpib_dcsupply.php"] = "GPIB: Supply";
	$pages["gpib_wavegen.php"] = "GPIB: Wavegen";
	$pages["gpib_scope.php"] = "GPIB: Scope";
	$pages["contact_check.php"] = "Contact Check";
	$pages["scan_chain_tx.php"] = "SC: TX";
	$pages["scan_chain_pll.php"] = "SC: PLL"; 
	$pages["plotting.php"] = "Results (Beta)";
	//$pages["form_practice.php"] = "Form Practice";
	//$pages["xml_practice.php"] = "XML Practice";
	
	$activePage = basename($_SERVER['PHP_SELF']);
	$logfile = "/var/www/html/gui.log";

?>
<head>
	<title>SWEET <?php echo $pages[$activePage]?></title>
    <meta charset="UTF-8">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="CSS/generic.css">
    <link rel="stylesheet" href="CSS/nav.css">
    <link rel="stylesheet" href="CSS/center.css">
    <link rel="stylesheet" href="CSS/buttons.css">
</head>
<script>
	<!--TODO get this working-->
	//document.getElementsByTagName("input").setAttribute("autocomplete","off");
</script>
<div class = "navigation">
	<ul class = "navigation">
<?php foreach($pages as $url=>$title): ?>
		<li class = "navigation">
			<a <?php if($url == $activePage): echo "class=\"active\""; endif; echo "href=\"$url\">"; echo $title ?></a>
		</li>
<?php endforeach; ?>
	</ul>
</div>
