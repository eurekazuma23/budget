<table class="table table-bordered table-hover table-striped">
	<thead>
	<th>Code</th>
	<th>Description</th>
	<th></th>
	</thead>
	<tbody>
	<?php if (count($mres)<=0){ ?>
		<tr>
			<td colspan="3"></center><i>No Records Found.</i></center></td>
		</tr>
	<?php } else { 
	for ($rx =0;$rx<=count($mres)-1;$rx++){
	?>
		<tr>
			<td><?php echo $mres[$rx]->childCode; ?></td>
			<td><?php echo $mres[$rx]->description; ?></td>
			<td>
				<button style="margin-left:-5px;" class="btn btn-primary" onclick="ppa_sub_parent('modify','<?php echo $mres[$rx]->id; ?>','<?php echo $base_url; ?>')"><i class="icon-white icon-pencil"></i></button>
				<button style="margin-left:-2px;" class="btn btn-warning" onclick="ppa_sub_parent('delete','<?php echo $mres[$rx]->id; ?>','<?php echo $base_url; ?>');"><i class="icon-white icon-trash"></i></button>
			</td>
		</tr>
	<?php } } ?>
	</tbody>
</table>
