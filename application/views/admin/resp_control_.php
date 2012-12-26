<?php
if ($type!="delete"){
	if ($type=="add"){
		$title = "Add New Responsibility Center";
		$r_code = "";
		$r_desc = "";
		$type = "addNow";
		$id = "";
	} else if ($type=="edit"){
		$r_code = $selected[0]->code;
		$r_desc = $selected[0]->resp_desc;
		$id = $selected[0]->id;
		$title = "Modify Responsibility Center";
		$type = "saveMod";
	}
?>
<div class="title"><?php echo $title; ?></div><br/>
<table>
	<tr>
		<th>Code</th>
		<td><input id="resp_code" value="<?php echo $r_code; ?>" type="text" class="textbox" style="height:30px;"/></td>
	</tr>
	<tr>
		<th>Description</th>
		<td><input id="resp_desc" value="<?php echo $r_desc; ?>" type="text" class="textbox" style="height:30px;";/></td>
	</tr>
</table>
<center>
	<input type="submit" class="btn btn-primary" value="Save" onclick="resp_center('<?php echo $base_url; ?>','<?php echo $type; ?>','<?php echo $id; ?>')"/>
	<input type="submit" class="btn btn-warning" onclick="hideMes()" value="Cancel"/>
</center>
<br/>
<div class="error-wr" style="display:none"></div>
<?php } else { ?>
<div class="title">Confirm Delete</div><br/>
<center>
Are you sure you want to Delete?<br/>
<input type="submit" value="Yes" class="btn btn-warning" onclick="resp_center('<?php echo $base_url; ?>','deleteNow','<?php echo $theId; ?>')"/>
<input type="submit" value="No" class="btn btn-primary" onclick="hideMes()"/>
</center>
<?php } ?>