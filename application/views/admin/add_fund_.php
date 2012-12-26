<?php
if (isset($type)){
	$title = "Modify Fund Detail";	
	$tpe = $fund[0]->type;
	$fund_d = $fund[0]->fund_desc;
	$ac_type = "saveMod";
	$theid = $fund[0]->id;
} else {
	$title = "Add New Fund Detail";
	$tpe = "";
	$fund_d = "";
	$ac_type = "saveNow";
	$theid = "";
}
?>
<div class="title"><?php echo $title; ?></div><br/>
<table>
	<tr>
		<th>Fund Type</th>
		<td>
			<select id="type" class="textbox width200">
				<?php
				$a = array('General Fund','RA Fund','Special Fund');
				$x = 0;
				foreach ($a as $m){ 
					if ($tpe==$x){ ?>
						<option selected="selected" value="<?php echo $x; ?>"><?php echo $m; ?></option>
				<?php	} else { ?>
					<option value="<?php echo $x; ?>"><?php echo $m; ?></option>
				<?php } ?>
				<?php $x++; } ?>
			</select>
		</td>
	</tr>
	<tr>
		<th>Fund Name</th>
		<td>
			<input id="name" style="height:30px;" value="<?php echo $fund_d; ?>" type="text" class="textbox width200"/>
		</td>
	</tr>	
</table><br/>
<center>
	<input type="submit" value="Save Entry" onclick="add_fund('<?php echo $base_url; ?>','<?php echo $ac_type; ?>','<?php echo $theid; ?>')" class="btn btn-primary"/>
	<input type="submit" value="Close" onclick="hideMes()" class="btn btn-warning"/>
</center><br/>
<div class="error-wr" style="display:none"></div>