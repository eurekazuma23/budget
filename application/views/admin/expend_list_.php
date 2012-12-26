<table class="table table-bordered table-striped table-hover">
	<thead>
		<th>Code</th>
		<th>Description</th>
		<th>Action</th>
	</thead>
	<tbody>
		<?php
		if (count($exp_list)<1){
		?>
		<tr>
			<td colspan="10"><center><i>No Records Found.</i></center></td>
		</tr>
		<?php } else { ?>
		<?php $rcount = count($exp_list)-1; for ($x=0;$x<=$rcount;$x++){ ?>
			<tr>
				<td><?php echo $exp_list[$x]->code; ?></td>
				<td><?php echo $exp_list[$x]->exp_desc; ?></td>
				<td>
					<button onclick="exp_control('<?php echo $base_url; ?>','edit','<?php echo $exp_list[$x]->id; ?>')" class="btn btn-primary"><i class="icon-white icon-pencil"></i></button>
					<button onclick="exp_control('<?php echo $base_url; ?>','delete','<?php echo $exp_list[$x]->id; ?>')" class="btn btn-warning"><i class="icon-white icon-trash"></i></button>
				</td>
			</tr>
		<?php } ?>
		<?php } ?>
	</tbody>
</table></div>