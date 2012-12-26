<table class="table table-bordered table-striped table-hover">
	<thead>
	<th>Fund Type</th>
	<th>Fund Name</th>
	<th>Action</th>
	</thead>
	<tbody>
		<?php
			if (count($fund_list)<=0){
		?>
		<tr>
			<td colspan="3"><center><i>No Records Found.</i></center></td>
		</tr>
		<?php } else { 
			$xcount = count($fund_list)-1;
			$a = array('0'=>'General Fund','1'=>'RA Fund','2'=>'Special Fund');
			for ($x =0; $x<=$xcount;$x++){
		?>
			<tr>
				<td><?php echo $a[$fund_list[$x]->type]; ?></td>
				<td><?php echo $fund_list[$x]->fund_desc; ?></td>
				<td>
					<button style="margin-left:-5px;" class="btn btn-primary left" onclick="add_fund('<?php echo $base_url; ?>','modify','<?php echo $fund_list[$x]->id; ?>')"><i class="icon-white icon-pencil"></i></button>
				
					<a href="<?php echo $base_url."siteAdmin/sys_setup/fund/".$fund_list[$x]->id; ?>" name="delete" style="margin-left:5px;margin-top:5px;" class="btn btn-warning left" onclick="return confirm('Are you sure you want to Delete?')"><i class="icon-white icon-trash"></i></a>
				
				</td>
		</tr>
	<?php } } ?>
	</tbody>
</table></div>