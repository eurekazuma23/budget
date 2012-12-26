<?php
	$mod_code = "";
	$mod_desc = "";
	if ($type=="add"){
		$params = "add_parentNow";
		$m = "Add New PPA Category";
	} else if ($type=="subparent"){
		$params="add_subParentNow";
		$m = "Add New PPA SUB-Category"; ?>
		<input type="hidden" id="ppa_cat_id" value="<?php echo $id; ?>"/>
<?php } else if ($type=="modify_subparent"){
	$params = "save_mod_subparent";
	$mod_code = $fields[0]->childCode;
	$mod_desc = $fields[0]->description; $m="Modify PPA Category Details"; ?>
	<input type="hidden" id="subparentID" value="<?php echo $fields[0]->id; ?>"/>
<?php } ?>
<div class="title"><?php echo $m; ?></div><br/>
<table class="ord-table">
	<tr>
		<th>Code</th>
		<td><input type="text" value="<?php echo $mod_code; ?>" style="height:30px;" class="textbox" id="ppa_code"/></td>
	</tr>
	<tr>
		<th>Description</th>
		<td><input type="text" value="<?php echo $mod_desc; ?>" style="height:30px;" class="textbox" id="ppa_desc"/></td>
	</tr>
</table>
<center>
	<input type="submit" value="Save Entry" class="btn btn-primary" onclick="ppa_action('<?php echo $params; ?>','<?php echo $base_url; ?>')"/>
	<input type="submit" value="Close" class="btn btn-warning" onclick="hideMes()"/>
</center><br/>
<div style="display:none" class="error-wr"></div>