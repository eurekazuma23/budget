<table class="table table-bordered table-striped table-hover">
	<thead>
		<th>Code</th>
		<th>Description</th>
		<th>Action</th>
	</thead>
	<tbody>
		<?php
		if (count($resp_list)<1){
		?>
		<tr>
			<td colspan="10"><center><i>No Records Found.</i></center></td>
		</tr>
		<?php } else { ?>
		<?php $rcount = count($resp_list)-1; for ($x=0;$x<=$rcount;$x++){ ?>
			<tr>
				<td><?php echo $resp_list[$x]->code; ?></td>
				<td><?php echo $resp_list[$x]->resp_desc; ?></td>
				<td>
					<button onclick="resp_center('<?php echo $base_url; ?>','edit','<?php echo $resp_list[$x]->id; ?>')" class="btn btn-primary"><i class="icon-white icon-pencil"></i></button>
					<button onclick="resp_center('<?php echo $base_url; ?>','delete','<?php echo $resp_list[$x]->id; ?>')" class="btn btn-warning"><i class="icon-white icon-trash"></i></button>
				</td>
			</tr>
		<?php } ?>
		<?php } ?>
	</tbody>
</table></div>