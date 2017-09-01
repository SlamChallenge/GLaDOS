<?php
$images_dir="gnuplot/images/";
$data_dir="gnuplot/data/";
include_once('header.php');
include_once('plot_post_handler.php');
if (!isset($_SESSION["heatmap_image"])):
	$_SESSION["heatmap_image"]="heatmap.png";
endif;
?>
<div class = "center">
	<div class = "nougat">
		<form method = "post" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<table>
		   <tbody>
				<tr align="left">
					<td style="font-size:x-large; padding:2%;">Image: </td>
					<td><select name="heatmap_image" style="float:left;font-size:large;width:90%;margin:2%">
					<?php $image_array = array_diff(scandir($images_dir), array('..', '.'));
					foreach($image_array as $image):
						if($_SESSION["heatmap_image"]==$image) $selected=" selected"; else $selected="";
						echo "<option value=\"".$image."\" ".$selected.">".$image."</option>";
					endforeach;?>
					</td>
					<td><button type = "submit" name="command" value = "view_heatmap">View</button></td>
				</tr>
				<tr align="left">
					<td style="font-size:x-large; padding:2%;">File: </td>
					<td><select name="heatmap_file" style="float:left;font-size:large;width:90%;margin:2%">
					<?php $data_array = array_diff(scandir($data_dir), array('..', '.'));
					foreach($data_array as $data):
						if($_SESSION["heatmap_file"]==$data) $selected=" selected"; else $selected="";
						echo "<option value=\"".$data."\" ".$selected.">".$data."</option>";
					endforeach;?>
					</td>
					<td><button type = "submit" name="command" value = "create_heatmap">Create</button></td>
				</tr>
			</tbody>
		</table>
		</form>
		<img src="<?php echo $images_dir.$_SESSION["heatmap_image"] ?>" alt="Heatmap">
	</div>
		
	<?php include_once('message_box.php');?>
</div>
<?php include_once('plot_buttons.php');?>
</html>
