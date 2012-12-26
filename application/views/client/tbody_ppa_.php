<table class="table table-bordered table-hover table-striped">
<thead class="fixed-top">
	<th>PPA Code</th>
	<th>Responsibility Center</th>
	<th>Object Of Expenditures</th>
	<th>Amount</th>
	<th></th>
</thead>
<tbody>
	<?php $cnt = count($list)-1; $x =0; while ($x<=$cnt) { ?>
<tr>
	<td><?=$list[$x]->ppaCode?></td>
	<td><?=$list[$x]->resp_center?></td>
	<td><?=$list[$x]->expends?></td>
	<td><?=$list[$x]->amount?></td>
	<td><button class="btn btn-warning" onclick="del_allotment('<?=$base_url?>','<?=$list[$x]->id?>','<?=$class_id?>')"><i class="icon-white icon-remove"></i></button></td>
</tr>
	<?php $x++; } ?>
</tbody>
</table>
<input type="hidden" id="status" value="<?php echo $status; ?>"/>
