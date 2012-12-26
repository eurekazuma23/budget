<table class="table table-bordered table-hover table-striped">
	<thead>
		<tr>
			<th>Legal Basis</th>
			<th>Type</th>
			<th>Year</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
	<?php
	if (count($list)>=1){
	for ($x =0; $x<=count($list)-1;$x++){ ?>
		<tr>
			<td><?php echo $list[$x]->legal_basis; ?></td>
			<td><?php echo $list[$x]->app_type; ?></td>
			<td><?php echo $list[$x]->year; ?></td>
			<td>
				<button onclick="app_action('edit','<?php echo $list[$x]->id; ?>','<?php echo $base_url; ?>')" class="btn btn-primary"><i class="icon-white icon-pencil"></i></button>
				<button onclick="app_action('delete','<?php echo $list[$x]->id; ?>','<?php echo $base_url; ?>')" class="btn btn-warning"><i class="icon-white icon-trash"></i></button>
			</td>
		</tr>
	<?php } } else { ?>
		<tr>
			<td colspan="4"><center><i>No Records Found.</i></center></td>
		</tr>
	<?php } ?>
	</tbody>
</table>