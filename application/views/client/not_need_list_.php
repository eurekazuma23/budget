<table class="table table-bordered table-striped table-hover">
	<thead>
		<th>Date</th>
		<th>Fund</th>
		<th>Legal Basis</th>
		<th></th>
	</thead>
	<tbody>
		<?php
		$cnt = count($records)-1;
			if (count($records)<1){
		?>
		<tr>
			<td colspan="10"><center><i>No Records Found.</i></center></td>
		</tr>
		<?php } else { ?>
		<?php for ($x = 0; $x<=$cnt; $x++){ ?>
		<?php
			$fc = count($fund)-1;
			for ($f = 0; $f<=$fc; $f++){
				if ($fund[$f]->id==$records[$x]->fund_id){
					$myfund = $fund[$f]->fund_desc;
					break;
				}
			}
			$lc = count($fund)-1;
			for ($l = 0; $l<=$lc; $l++){
				if ($legal_basis[$l]->id==$records[$x]->legal_id){
					$legal = $legal_basis[$l]->legal_basis;
					break;
				}
			}
			$id[$i]->id;
		?>
		<center><tr>
			<td><?=$records[$x]->date?></td>
			<td><?=$myfund?></td>
			<td><?=$legal?></td>
		<center><td><button class="btn btn-danger" onclick="del_nnc('<?php echo $base_url; ?>')"><i class=" <icon-white icon-trash"></i></button></td></center>
		</tr></center>
		<?php } ?>
		<?php } ?>
	</tbody>
</table>